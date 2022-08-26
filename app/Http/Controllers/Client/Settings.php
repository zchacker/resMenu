<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\FuncCall;

class Settings extends Controller
{
    
    
    public function show_settings(Request $request)
    {

        $user_id   = $request->user()->id;
        $user_info = UsersModel::where(['id' => $user_id])->first();
        
        return view( 'client_dashboard.settings.information' , compact('user_info') );

    }

    public function password_form(Request $request)
    {
        return view( 'client_dashboard.settings.password'  ); 
    }

    public function update_profile(Request $request)
    {
        $user_id  = $request->user()->id;
        $profile_data = UsersModel::where(['id' => $user_id])->first();

        $rules = array(
            'name' => 'required',
            'email' => ['required',Rule::unique('users')->ignore($user_id)],
            'phone' => ['required',Rule::unique('users')->ignore($user_id)]            
        );

        $messages = [
            'name.required' => __('name_required'),
            'email.required' => __('email_required'),
            'email.unique' => __('email_unique'),
            'phone.required' => __('phone_required'),            
            'phone.unique' => __('phone_unique'),            
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails() == true) {

            $error     = $validator->errors();
            $allErrors = "";

            foreach ($error->all() as $err) {
                $allErrors .= $err . " <br/>";
            }

            return back()->withErrors(['error' => $allErrors]);

        } else {
                       
            $profile_data->name = $request->name;
            $profile_data->email = $request->email;
            $profile_data->phone = $request->phone;           

            if ($profile_data->update()) {
                
                return back()->with(['success' => __('updated_successfuly')]);

            } else {
                
                return back()->withErrors(['error' => __('unknown_error')]);

            }
        }
    }

    public function update_password(Request $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }
       

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->update();

        return back()->with(['success' => __('updated_successfuly')]);        
        
    }


}
