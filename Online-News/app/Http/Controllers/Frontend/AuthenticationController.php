<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function singup(){
        return view('frontend.auth.singup');
    }
    public function singup_post(Request $request){
        $request->validate([
            '*' => 'required',
             'g-recaptcha-response' => 'required|captcha',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
        ]);
        return redirect()->route('auth.login')->with('success','Account Created Successfully.!');
    }
    public function login(){
        return view('frontend.auth.login');
    }
    public function login_post(Request $request){
        $request->validate([
            '*' => 'required',
        ]);
        if(Auth::attempt(['email' => $request->email,'password' => $request->password])){
            return redirect()->route('home');
        }else{
            return back()->withErrors(["email" => "Can't Match With Any User "])->withInput();
        }
    }
}
