<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Chat;
use App\Models\City;
use App\Models\User;
use App\Models\Travel;
use App\Models\Category;
use App\Models\Province;
use App\Mail\MessageMail;
use App\Models\Adventure;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Morilog\Jalali\CalendarUtils;
use App\Notifications\SendKaveCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class HomeController extends Controller
{
    public  function  clear()
    {
        Artisan::call('optimize');

        $user=auth()->user();;

//    Artisan::call('cache:clear');
//         Artisan::call('config:cache');
//         Artisan::call('view:clear');
//         Artisan::call('optimize:clear');
//         Artisan::call('config:clear');

return 20;
    }




    public  function  logout()
    {
        alert()->success('خروج با موفقیت انجام شد ');
        Auth::logout();
        return redirect()->route('login');
    }
    public function reload_captcha() {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function index (){
        $invitedUser = new User;
        // $invitedUser->notify(new SendKaveCode( '09373699317','login','2121','','','',''));
        $main_category=Category::where('parent_id',null)->get();
        $user= auth()->user();
        return view('home.index',compact(['main_category','user']));
    }




    public function send_verify_code (Request $request){
        //            ارسال پیامک
        $digits = 4;
        $rand= rand(pow(10, $digits-1), pow(10, $digits)-1);
        session()->put('mobile',$request->mobile);
        $invitedUser = new User;
        $invitedUser->notify(new SendKaveCode( $request->mobile,'login',$rand,'','','',''));
        return response()->json([
            'status'=>'ok',
            'code'=>$rand,
            'mobile'=>$request->mobile
        ]);
    }
    public function auth_login (Request $request){
        $mobile= session()->get('mobile');
        $user=User::whereMobile($mobile)->first();
        if(!$user){

            $user=User::create(['mobile'=>$mobile,'level'=>'customer']);
            $user->assignRole( 'customer');

        }
        Auth::login($user,true);
        return response()->json([
            'status'=>$user->complete_register,
        ]);
    }


    public function update_password(Request $request){
        $user=auth()->user();
        $user->update(['password'=>$request->pass]);
        return response()->json([
            'status' =>1,
            'all' =>$request->all(),

        ]);
    }

    public function check_password(Request $request){
        $user=User::whereMobile($request->mobile)->first();
        if($user->password==$request->password){
            Auth::loginUsingId($user->id,true);;
            return response()->json([
                'status' => 1,
                'all' =>$request->all(),
            ]);
        }
        return response()->json([
            'status' => 0,
            'all' =>$request->all(),
        ]);
    }
    public function check_code(Request $request){
        $user=User::whereMobile($request->mobile)->first();
        if(session()->get('rnd',0)==$request->code){
            Auth::loginUsingId($user->id,true);;
        }
        return response()->json([
            'status' => session()->get('rnd',0)==$request->code,
            'all' =>$request->all(),
            'password' =>$user->password?1:0,
        ]);
    }
    public function resend_code(Request $request){
        $rand=rand ( 1000 , 9999 );
        session()->put('rnd',$rand);
        return response()->json([
            'status' =>1,
            'rand' => $rand,
        ]);
    }

    public function check_user_exist(Request $request){
        $user=User::whereMobile($request->mobile)->where('password','!=',null)->first();
        if($user){
            return response()->json([
                'status' =>1
            ]);
        }else{
            $check=User::whereMobile($request->mobile)->first();
            if($check){  $check->delete();}
            $user= User::Create(['mobile'=>$request->mobile,'role'=>'user']);
            $user->assignRole( 'user');
            $rand=rand ( 1000 , 9999 );
            session()->put('rnd',$rand);
            return response()->json([
                'status' =>0,
                // 'id' =>$user->id,
                'rand' => $rand,
            ]);
        }
    }

    public function get_city(Province $province){
        return response()->json([
            'body' => view('home.parts.get_city',compact('province'))->render(),
        ]);
    }



}
