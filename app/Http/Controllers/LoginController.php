<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use App\Mail\VerifyAccount;
use App\Models\PasswordToken;
use Illuminate\Http\Request;
use App\Models\User;  // Để sử dụng model User
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Mail;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(Request $req)
    {

        // if(Auth::attempt(['email' => $req-> email, 'password' => $req->password])){
        //     return redirect()->route('home-page') ;
        // }
        // return redirect()->back()->with('error','Incorrect email address or password');
        // dd($req->all());
        $data = $req->only('email', 'password');

        // Kiểm tra đăng nhập với guard mặc định
        $check = Auth::attempt($data);

        if ($check) {
            // Kiểm tra xác thực email (nếu có trường email_verify_email_at)
            if (Auth::user()->email_verified_at == null) {
                Auth::logout();
                return redirect()->back()->with('no', 'Your account is not verified. Please check your email again.');
            }
            return redirect()->route('home-page')->with('ok', 'Welcome back!');
        }

        return redirect()->back()->with('no', 'Your account or password is invalid.');
    }

    public function getRegister()
    {
        return view('register');
    }

    public function postRegister(Request $req)
    {

        // $req->merge(['password'=>Hash::make($req->password)]);

        // try {
        //     User::insert([ 'name' => $req->name,
        //     'email' => $req->email,
        //     'password' => $req->password,
        //     'authority' => 2
        // ]);
        // } catch (\Throwable $th) {
        //     dd($th);
        // }
        //  return redirect()->route('login-page');

        //new
        // dd($req->all());
        $req->validate([
            'name' => 'required|min:6|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password',
        ],);
        
        $data = $req->only('name', 'email');
        $data['password'] = bcrypt($req->password);
        $data['authority'] = 2;

        if ($acc = User::create($data)) {
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('login-page')->with('ok', 'Register successfully, please check your email to verify your account.');
        }
        return redirect()->back()->with('no', 'Something eror, please try again');
    }
    public function verify($email)
    {
        $acc = User::where('email', $email)->whereNull('email_verified_at')->firstOrFail();
        User::where('email', $email)->update(['email_verified_at' => date('Y-m-d')]);
        return redirect()->route('login-page')->with('ok', 'Verify successfully, please check your email to verify your account.');
    }


    public function getLogout()
    {

        Auth::logout();
        return redirect()->route('home-page');
    }
    public function getLoginAdmin()
    {
        return view('Admins.admin.loginAdmin');
    }
    public function postLoginAdmin(Request $req)
    {
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password, 'authority' => 1])) {
            return redirect()->route('admin-dashboard-page');
        }
        return redirect()->back()->with('error', 'Incorrect email address or password');
    }
    //new
    public function change_password()
    {
        return view('change_password');
    }
    public function check_change_password() {}

    public function forgot_password()
    {
        return view('forgot_password');
    }
    public function check_forgot_password(Request $req)
    {
        $req->validate([
            'email' => 'required|exists:users,email',
        ]);

        $user = User::where('email', $req->email)->first();

        $token = \Str::random(40);
        $tokenData = [
            'email' => $req->email,
            'token' => $token
        ];
        try {
            if (PasswordToken::create($tokenData)) {
                Mail::to($req->email)->send(new ForgotPassword($user, $token));
                return redirect()->back()->with('ok', 'Send email successfully, please check email to continue');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('no', 'Something eror, please try again');
        }
        return redirect()->back()->with('no', 'Something eror, please try again');
    }
    public function reset_password($token)
    {

        $tokenData = PasswordToken::checkToken($token);
        // $user = User::where('email',$tokenData->email)->firstOrFail();
        $user = $tokenData->user;
        return view('reset_password');
    }
    public function check_reset_password($token)
    {
        request()->validate([
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password'
        ]);
        $tokenData = PasswordToken::checkToken($token);
        // $user = User::where('email',$tokenData->email)->firstOrFail();
        $user = $tokenData->user;
        $data = [
            'password' => bcrypt(request(('password')))
        ];
        $check = $user->update($data);
        if ($check) {
            return redirect()->route('login-page')->with('ok', 'Update your password successfully');
        }
        return redirect()->back()->with('no', 'Something eror, please try again');
    }
}
