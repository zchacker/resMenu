<?php

namespace App\Http\Controllers;

use App\Models\MenusModel;
use App\Models\RestrantsModel;
use App\Models\UsersModel;
use Barryvdh\Debugbar\SymfonyHttpDriver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


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

                $menu = MenusModel::create([
                    'restrant_id' => $restrants->id ,
                    'templete_id' => 1
                ]);

                //if(Auth::guard('user')->attempt(['email' => $request->email, 'password' => $password] , 1))
                if(Auth::guard('user')->attempt(['email' => $request->email, 'password' => $password] , TRUE))
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
                ->withInput($request->all());

            }
        
        }else{

            $error     = $validator->errors();
            $allErrors = "";

            foreach($error->all() as $err){                
                $allErrors .= $err . " <br/>";
            }

            return back()
            ->withErrors( ['login_error' => $allErrors ] )
            ->withInput($request->all());

        }

    }

    public function forgotPassword(Request $request)
    {
        return view('home.forgot_password.forgot');
    }

    public function forgotPasswordSubmit(Request $request)
    {

        $validator = $request->validate([
            'email' => 'required|email|exists:users',
        ]);       

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $user_id = DB::getPdo()->lastInsertId();

        Mail::send('email.resetpassword', ['token' => $token, 'user_id' => $user_id], function($message) use($request){
            $message->to($request->email);
            $message->subject(' طلب استعادة كلمة المرور ');
        });

        
        return back()->with(['success' => __('forgot_pass_sent')]);

    }

    public function restPassword(Request $request)
    {

        if($request->get('id')){
            print 'has id';
        }

        if(strlen($request->id) > 0 && strlen($request->token) > 0)
        {
            
            $id      = $request->id;
            $token   = $request->token;
            $isFound =  DB::table('password_resets')
            ->where(['id' => $id, 'token' => $token])
            // ->where('id'    , '=' , $id)
            // ->where('token' , '=' , $token)
            ->count();
            
            if($isFound == 0)
            {
                return abort(Response::HTTP_NOT_FOUND , "Not found");
            }
            
            return view( 'home.forgot_password.reset_password' , compact( 'id' , 'token') );

        }else{
            
            return abort(Response::HTTP_NOT_FOUND , "Not found");

        }

    }

    public function restPasswordSubmit(Request $request)
    {

        if(strlen($request->id) > 0 && strlen($request->token) > 0)
        {
            
            $id      = $request->id;
            $token   = $request->token;
            $isFound =  DB::table('password_resets')
            ->where(['id' => $id, 'token' => $token])            
            ->count();
            
            if($isFound == 0)
            {
                return abort(Response::HTTP_NOT_FOUND , "Not found");
            }else{



            }
            
            return view( 'home.forgot_password.reset_password' , compact( 'id' , 'token') );

        }else{
            
            return abort(Response::HTTP_NOT_FOUND , "Not found");

        }

    }

    public function logout(Request $request) 
    {
        if(Auth::guard('user')->check()) // this means that the user was logged in.
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
