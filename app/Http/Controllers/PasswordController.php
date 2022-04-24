<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Password;
use Session;
use Carbon\Carbon;

class PasswordController extends Controller
{
  
    function getSendResetLinkEmail() {
        return view('auth.password.email');
    }

    function showResetForm() {
        return view('auth.password.reset');
    }

    function resetPassword(Request $request) {
    
        $this->validate($request , [
            'email' => 'required|email|exists:users,email'
        ]);

        $token = \Str::random(64);
        \DB::table('password_reset')->insert ([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()

        ]);

        return redirect()->route('password.reset');
    }

 }
