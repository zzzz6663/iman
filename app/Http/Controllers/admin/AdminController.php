<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use RealRashid\SweetAlert\Facades\Alert;
use TimeHunter\LaravelGoogleReCaptchaV2\Validations\GoogleReCaptchaV2ValidationRule;

use function Termwind\render;

class AdminController extends Controller
{



    // public function agents_all(Request $request){
    //     $agents=User::query();
    //     $agents->where('role','agent');
    //     if($request->search){
    //         $search=$request->search;
    //         $agents->where(function($query) use ($search){
    //             $query->where('name','LIKE',"%{$search}%")
    //             ->orWhere('family','LIKE',"%{$search}%")
    //             ->orWhere('mobile','LIKE',"%{$search}%");
    //         });
    //     }
    //     $agents=$agents->latest()->paginate(10);
    //     return view('admin.agent.all',compact('agents'));
    // }


   public function clear(){
    Artisan::call('optimize');

    // $invitedUser->notify(new SendKaveCode( '09373699317','login','2121','','','',''));
Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    return 30;
   }
   public function login(){

    // Auth::loginUsingId(1);
    $user=auth()->user();
    if($user){
        alert()->success('ورود با موفقیت نجام شد ');

        switch($user->role){
            case 'admin':
                return redirect()->route('branch.index');
                break;
            case 'client':
                return redirect()->route('order.index');
                break;
            case 'branch':
                return redirect()->route('client.index');
                break;
           }

    }
       return view('admin.login');
   }
   public function check_login(Request $request){

       $data = $request->validate([
           'username' => 'required',
           'password' => 'required',
        //    'captcha' => 'required|captcha',

        //    'g-recaptcha-response' => [new GoogleReCaptchaV2ValidationRule()]
       ]);
       $user=User::whereUsername($request->username)->whereIn('role',['admin','branch','client'])->first();
    //    $user->assignRole('admin');

       if(!$user){
        alert()->error('    wrong info');
           return back();
       }
       if($user && $user->password == $request->password){
        Auth::login($user,true);
        alert()->success('       welcome');
       switch($user->role){
        case 'admin':
            return redirect()->route('branch.index');
            break;
        case 'client':
            return redirect()->route('order.index');
            break;
        case 'branch':
            return redirect()->route('client.index');
            break;
       }

       }else{
        alert()->error('    wrong info');
        return back();
       }



   }




   public function remove_product(User $user ,Request $request)
   {
    $product=Product::find($request->product);
    $user->branch_products()->updateExistingPivot($product->id, array('show' => '0'), false);
    return response()->json([
        'all' => $request->all(),
        'status' => 1
    ]);
   }
   public function add_product(User $user ,Request $request)
   {
    $html='';
    $product=Product::find($request->product);
    if(!$product){
        $status=0;
    }else{
        if( in_array($product->id,$user->branch_products()->wherePivot('show','1')->pluck('id')->toArray())){
            $status=2;
        }else{
            if(in_array($product->id,$user->branch_products()->wherePivot('show','0')->pluck('id')->toArray())){
                $user->branch_products()->updateExistingPivot($product->id, array('show' => '1'), false);
            }else{
                $user->branch_products()->attach($product->id,['show'=>1]);
            }
            $status=1;
            $html=  view('admin.product.product_row',compact(['product','user']))->render();
        }
    }


      return response()->json([
               'all' => $request->all(),
               'status' => $status,
               'html' => $html,
           ]);
   }
   public function pass_products(User $user ,Request $request)
   {



       if($user->role!='branch'){
           alert()->error('target is not branch');
           return redirect()->route('branch.index');
       }
       if($request->method()=='POST'){

         $is_exist=  $user->branch_products()->where('product_id', $request->product)->first();
         if( $is_exist){
           if($is_exist->pivot->show){
               $show=0;
           }else{
               $show=1;
           }
           $user->branch_products()->updateExistingPivot($request->product, array('show' => $show), false);
           return response()->json([
               'show' =>  $show,
           ]);
         }else{
           $user->branch_products()->attach($request->product,['product_id'=>$request->product,'show'=>1]);
           return response()->json([
               'show' =>  1,
           ]);
         }


           // return response()->json([
           //     'all' => $request->all(),
           //     'status' => 'ok',
           //     'exist' =>  $is_exist,
           //     'show' =>  $is_exist,
           // ]);
       }

       $products = Product::query();
       $user_products =$user->branch_products()->wherePivot('show','1')->paginate(10);
    //    if ($request->search) {
    //        $search = $request->search;
    //       $products->where(function ($query) use ($search, $products) {
    //            $products->where('barcode', 'LIKE', "%{$search}%")
    //            ->orWhere('traffic_code', 'LIKE', "%{$search}%")
    //            ->orWhere('width', 'LIKE', "%{$search}%")
    //            ->orWhere('price', 'LIKE', "%{$search}%")
    //            ->orWhereHas('brand', function ($query) use ($search) {
    //                $query->where('name', 'LIKE', "%{$search}%");
    //            })
    //            ->orWhereHas('supplier', function ($query) use ($search) {
    //                $query->where('name', 'LIKE', "%{$search}%");
    //            });
    //       });
    // //       whereHas('branches', function ($query) use($user) {
    // //        $query->where('branch_id', $user->id);
    // //    });;
    //    }
       $products = $products->latest()->get();
       return view('admin.product.pass_products',compact(['user','products','user_products']));
   }
}
