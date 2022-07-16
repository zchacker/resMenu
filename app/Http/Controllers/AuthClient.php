<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthClient extends Controller
{
    
    public function register(Request $request)
    {

        return view('home.register');
    }

    public function requestRegister(Request $request)
    {
        
        return back()->withErrors(['used_email_err' => [__('used_email')]]);
    }


}
