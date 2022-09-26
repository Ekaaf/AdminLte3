<?php

namespace App\Http\Controllers;

use App\Models\UserAccess;
use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Session;

class LoginController extends Controller
{
    public function login(){
        if(Auth::user()){
            return redirect()->intended('admin/dashboard');
        }
        return view('admin.login');
    }

    public function postlogin(Request $request)
    {   
        $email = $request->input('email');
        $password = $request->input('password');
        $menuAccess = [];
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->intended('admin/dashboard');
        }
        else{
            $request->session()->flash('error', "Email or password do not match");
            return redirect('admin/login');
        }

        
    }

    public function logout(){
        \Session::flush();
        Auth::logout();
        return redirect()->intended('admin/login');
    }

    public function passwordReset(Request $request){
        return view('student.auth.email');
    }

    public function sendPassword(Request $request){
        $to_email = $request->email;
        $user = User::where('email', '=', $to_email)->orderBy('id', 'desc')->first();
        if(is_null($user)){
            return redirect()->back()->with("error", "We can't find a user with that e-mail address.")->withInput();
        }
        else{
            $data['name'] = $user->name;
            $data['password'] = $user->password;
            Mail::mailer('reset-pass')->send('student.auth.email_password', $data, function($message) use ($to_email) {
                $message->to($to_email)
                        ->subject('Forget Password');
                $message->from('no-reply1@northsouth.edu','NSU IT');
            });
            return redirect()->back()->with("success", "Password is sent to your email address.");
        }
    }

    public function loginWithGmail($value=''){
        $client = new \Google_Client();
        $client->setClientId("609011195836-mr9ee75t6u60pqjnl6v3o5vu0oc61djn.apps.googleusercontent.com");
        $client->setClientSecret("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");
        $client->setAccessToken("ya29.a0ARrdaM_rcNnZQUx8mma5Znk9YNyeFIRCW53MH1Jvgcdwa2s4DR5_Ik2zBBW5YXR9CqG5qmQhCkhfeTIwiCqx7n9-Xyctgd0EL1k99hqn5uESz8AqqGhlK0HYhfLBAUuy74GaR0EQU0qb_YMt_8fR8DKiTN3N");
        $client->addScope("email");
        $client->addScope("profile");

        $google_oauth = new \Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
    }
}