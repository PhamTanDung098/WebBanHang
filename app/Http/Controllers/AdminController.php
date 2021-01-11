<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Login;
use App\Models\Social;
use Socialite;
use Illuminate\Support\Facades\Redirect;
use Session;
\session_start();
class AdminController extends Controller
{
    public function login_facebook(){

        return Socialite::driver('facebook')->redirect();
    }
    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        // dd($provider);
        $accout = Social::where('provider','=','facebook')->where('provider_user_id',$provider->id)->first();
        // dd($accout->all());
        if($accout)
        {
            $accout_name = Login::where('id',$accout->user)->first();
            Session::put('admin_login',$accout_name->admin_name);
            Session::put('admin_id',$accout_name->id);
            return redirect('/dashboard')->with('message','Đăng nhập thành công');
        }
        else
        {
           
            $dung = new Social;
            $dung->provider_user_id = $provider->id;
            $dung->provider = 'facebook';
            $orang = Login::where('admin_email',$provider->email)->first();
            if($orang==null){
                $admin =new Login;
                $admin->admin_name = $provider->name;
                $admin->admin_email = $provider->email;
                $admin->admin_password = '';
                $admin->admin_phone = '';
                $admin->save();   
            }
            // dd($admin);
            $dung->user = (Login::where('admin_email',$provider->email)->orderBy('id','desc')->first())->id;
            $dung->save();
            $accout_name = Login::where('id',$dung->user)->first();
            dd($accout_name);
            Session::put('admin_name',$accout_name->admin_name);
            return \redirect()->route('categoryproduct.add');
        }
    }
    public function AuthLogin(){
        $user = Session::has('user');
        if($user){
            return Redirect::to('dashboard');
            
        }
        else{
            return Redirect::to('login');
        }
    }
    public function index(){
        return view('admin.admin_login');
    }
    
    // public function login(Request $req){
    //     $email = $req->email;
    //     $password = md5($req->password);
    //     $result = Admin::where('admin_email',$email)->where('admin_password',$password)->first();
    //     dd($result->all());
    //     if($result){
    //         Session::put('user',$result);
    //         return redirect()->route('dashboard');
    //     }
    //     else{
    //         Session::put('message',"Mật khẩu và tài khoản bị sai. Vui lòng nhập lại");
    //         return redirect()->route('login');
    //     }

    // }
    public function logout(){
        if(\session()->has('user')){
            session()->forget('user');
            return \redirect()->route('login');
        }
    }
    public function dashboard(Request $req){
        $email = $req->email;
        $password = md5($req->password);
        $login  = Login::where ('admin_email',$email)->where('admin_password',$password)->first();
        if($login){
            Session::put('user',$login);
            Session::save();
            // Session::put('admin_name',$login->admin_name);
            // Session::put('admin_id',$login->id);
            return redirect()->route('content');
        }
        else{
            Session::put('message','Username or Password không tồn tại. Vui lòng đăng nhập lại.');
            return redirect()->route('login');
        }
    }
    public function content(){
        return view('admin.dashboard');
    }
}
