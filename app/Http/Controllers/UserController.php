<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public  function index(){
        return view('user.index');
    }
    public function create(request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required','confirmed']
        ]);
        $user = User::create($request->all());
        event(new Registered($user));
        Auth::login($user);
        return redirect()->route('verification.notice');
    }
    public function login(request $request){
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required']
        ]);
         if (Auth::attempt($credentials)) {
             return redirect()->intended('/home');
         }
        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }
    public function verify(EmailVerificationRequest $request){
       $request->fulfill();
       return redirect()->route('home');
    }
    public function logout(){
       Auth::logout();
        return redirect()->route('login');
    }
    public function send_verify(request $request){
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
}
