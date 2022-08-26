<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Settings extends Controller
{
    
    
    public function show_settings(Request $request)
    {

        $user_id   = $request->user()->id;
        $user_info = UsersModel::where(['id' => $user_id])->first();
        
        return view( 'client_dashboard.settings.information' , compact('user_info') );

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



}
