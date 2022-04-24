<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Hash;
use Auth;
use Str;
use Laravel\Socialite\Facades\Socialite;



class AuthController extends Controller
{
    public function getLogin() {
        return view('auth.login') ;
    }

    public function postLogin(Request $request) {

      $attributes = $this->validate($request , [
            'email' => 'required|email|exists:users',
            'password' => 'required|max:30|min:5',
       ]);

       if ( auth()->attempt($attributes) ) {

        session()->regenerate();

        return redirect()->route('pages.welcome')->with('success' , 'welcome back...You are logged in');

       }

        return back()
        ->withInput()
        ->withErrors(['email' => 'Your Provided credentials could not be verfied']);

    }

    // Google Login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $this->_registerOrLoginUser($user);
        return redirect()->route('pages.welcome');
    }

    // Facebook Login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $this->_registerOrLoginUser($user);
        return redirect()->route('pages.welcome');
    }

     // Github login
     public function redirectToGithub()
     {
         return Socialite::driver('github')->redirect();
     }

     public function handleGithubCallback()
     {
         $user = Socialite::driver('github')->user();
         $this->_registerOrLoginUser($user);
        return redirect()->route('pages.welcome');
     }

     protected function _registerOrLoginUser($data)
     {
         $user = User::where('email' , '=' , $data->email)->first();

         if(!$user) {
             $user = new User();
             $uuid = Str::uuid()->toString();
             $user->name = $data->name;
             $user->email = $data->email;
             $user->password = Hash::make($uuid.now());
             $user->provider_id = $data->id;
             $user->avatar = $data->avatar;
             $user->save();
         }

         Auth::login($user);
     }

    public function getLogout() {
        
        auth()->Logout();
        return redirect()->route('pages.welcome')->with('success' , 'Goodbye');
    }

    public function getRegister() {
        return view('auth.register');
    }

    public function postRegister(Request $request){
         $this->validate($request , [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:30|min:5',
       ]);


       $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        Session::flash('success' , 'Your account has been created');

        auth()->login($user);

        return redirect()->route('pages.welcome');
    }

}



