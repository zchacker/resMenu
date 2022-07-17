<?php

namespace App\Http\Controllers;

use App\Models\RestrantsModel;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthClient extends Controller
{
    
    public function register(Request $request)
    {
        return view('home.register');
    }

    public function requestRegister(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phone',                
            'password' => 'required',                            
        );

        $messages = [
            'name.required' => __('name_required'),
            'email.required' => __('email_required'),
            'email.unique' => __('email_unique'),
            'phone.required' => __('phone_required'),
            'phone.unique' => __('phone_unique'),
            'password.required' => __('password_required'),           
        ];

        $validator = Validator::make($request->all() , $rules, $messages); 

        if($validator->fails() == false)
        {
            
            $password = $request->password;

            // update password set it as hashed one
            $request['password'] = Hash::make($request->password);

            $user = UsersModel::create($request->all());
            $restrants = RestrantsModel::create([
                'name' => '',
                'message' => '',
                'address' => '',
                'phone' => '',
                'latitude' => 0.0,
                'longitude' => 0.0,
                'user_id' => $user->id
            ]);

            if($user && $restrants){

                if(Auth::guard('user')->attempt(['email' => $request->email, 'password' => $password]))
                {

                    return redirect()->intended(route('dashboard.home'));

                    /*if(Auth::user()->role == 'user')
                    {                    
                        return redirect()->intended(route('dashboard.home'));
                    }
                    else{                    
                        return redirect()->intended(route('engineer.home'));
                    }*/
                    
                    // return "account created";  

                }else{

                    return "error account created";

                }
                   
            }else{
                return "error account created"; 
            }

        }else{

            $error     = $validator->errors();
            $allErrors = "";

            foreach($error->all() as $err){                
                $allErrors .= $err . " <br/>";
            }

            return back()
            ->withErrors( ['register_error' => $allErrors ] )
            ->withInput($request->all());

        }
    }

    public function loginView(Request $request)
    {
        return view('home.login');
    }

    public function login(Request $request)
    {

        $rules = array(            
            'email' => 'required',                          
            'password' => 'required',                            
        );

        $messages = [            
            'email.required' => __('email_required'),
            'password.required' => __('password_required'),           
        ];

        $validator = Validator::make($request->all() , $rules, $messages); 

        if($validator->fails() == false)
        {

            if(Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password]))
            {
                
                return redirect()->intended(route('dashboard.home'));

            }else{

                return back()
                ->withErrors( ['login_error' => __('worng_password') ] )
                ->withInput($request->email);

            }
        
        }else{

            $error     = $validator->errors();
            $allErrors = "";

            foreach($error->all() as $err){                
                $allErrors .= $err . " <br/>";
            }

            return back()
            ->withErrors( ['login_error' => $allErrors ] )
            ->withInput($request->email);

        }

    }

    public function logout(Request $request) 
    {
        if(Auth::guard('user')->check()) // this means that the admin was logged in.
        {
            Auth::guard('user')->logout();
            return redirect()->route('home');
        }

        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');

        // Auth::logout();
        // return redirect('/');
    }


}
