<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\RestrantsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Whatsapp extends Controller
{
    
    public function whatsapp_info(Request $request)
    {
        $user_id = $request->user()->id;
        $restrant = RestrantsModel::where(['user_id' => $user_id])->first();
        
        return view( 'client_dashboard.whatsapp.update_whatsapp' , compact('restrant') );

    }


    public function updateWhatsappData(Request $request)
    {
        
        $user_id  = $request->user()->id;
        $restrant = RestrantsModel::where(['user_id' => $user_id])->first();

        $rules = array(
            'allow_whatsapp_orders' => 'required',
            'whatsapp_number' => 'required',
            'wahtsapp_message_body' => 'required'            
        );

        $messages = [
            'allow_whatsapp_orders.required' => __('allow_whatsapp_orders_required'),
            'whatsapp_number.required' => __('whatsapp_number_required'),
            'wahtsapp_message_body.required' => __('wahtsapp_message_body_required'),            
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
                       
            $restrant->whatsapp_number = $request->whatsapp_number;
            $restrant->allow_whatsapp_orders = $request->allow_whatsapp_orders;
            $restrant->wahtsapp_message_body = $request->wahtsapp_message_body;           

            if ($restrant->update()) {
                
                return back()->with(['success' => __('updated_successfuly')]);

            } else {
                
                return back()->withErrors(['error' => __('unknown_error')]);

            }
        }

    }

}
