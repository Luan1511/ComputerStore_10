<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;  // Để sử dụng model User
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin(){
        return view('login');
    }

    public function postLogin(Request $req){

        if(Auth::attempt(['email' => $req-> email, 'password' => $req->password])){
            return redirect()->route('home-page');
        }
        return redirect()->back()->with('error','Incorrect email address or password');


        }

        public function getRegister()
        {
            return view('register');  // Trả về view đăng ký
        }

        public function postRegister(Request $req){

        $req->merge(['password'=>Hash::make($req->password)]);

        try {
            User::insert([ 'name' => $req->name,
            'email' => $req->email,
            'password' => $req->password,]);
        } catch (\Throwable $th) {
            dd($th);
        }
         return redirect()->route('login-page');
        }
        public function getLogout(){

            Auth::logout();
            return redirect()->back();
        }
        public function getLoginAdmin(){
            return view('Admins.admin.loginAdmin');
        }
        public function postLoginAdmin(Request $req){
            if(Auth::attempt(['email'=> $req->email, 'password' => $req ->password, 'authority' => 1])){
                return redirect()->route('admin-dashboard-page');

            }
            return redirect()->back()->with('error','Incorrect email address or password');
        }

}
