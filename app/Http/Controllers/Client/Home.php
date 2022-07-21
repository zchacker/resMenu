<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\RestrantsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Home extends Controller
{

    public function index(Request $request)
    {

        return view('client_dashboard.home');
    }

    public function shop(Request $request)
    {
        $user_id = $request->user()->id;
        $restrant = RestrantsModel::where(['user_id' => $user_id])->first();

        return view('client_dashboard.shop', compact('restrant'));
    }

    public function updateShop(Request $request)
    {
        $user_id = $request->user()->id;
        $restrant = RestrantsModel::where(['user_id' => $user_id])->first();

        $rules = array(
            'name' => 'required',
            'address' => 'required',
            'working_hours' => 'required',
            'phone' => 'required',
        );

        $messages = [
            'name.required' => __('shop_name_required'),
            'address.required' => __('shop_address_required'),
            'working_hours.required' => __('working_hours_required'),
            'phone.required' => __('phone_required'),
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

            $restrant->name = $request->name;
            $restrant->message = $request->message;
            $restrant->address = $request->address;
            $restrant->phone = $request->phone;
            $restrant->working_hours = $request->working_hours;
            $restrant->slag = $request->slag;
            $restrant->latitude = $request->latitude;
            $restrant->longitude = $request->longitude;

            if ($restrant->update()) {
                
                return back()->with(['success' => __('updated_successfuly')]);

            } else {
                
                return back()->withErrors(['error' => __('unknown_error')]);

            }
        }
    }
}
