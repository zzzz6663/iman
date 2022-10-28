<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use RealRashid\SweetAlert\Facades\Alert;
use TimeHunter\LaravelGoogleReCaptchaV2\Validations\GoogleReCaptchaV2ValidationRule;

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
}
