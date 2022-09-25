<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RenewSubscription extends Controller
{
    
    public function renewSubscription(Request $request)
    {

        $SessionId      = '';
        $CountryCode    = '';
        
        $response = Http::withToken(env('PAYTOKEN'))
        ->withOptions(['verify' => false])
        ->post('https://apitest.myfatoorah.com/v2/InitiateSession' , 
        [
            'CustomerIdentifier' => '123',
        ]);

        
        if($response->ok())
        {
            $SessionId   = $response->json(['Data' , 'SessionId']);
            $CountryCode = $response->json(['Data' , 'CountryCode']);
        }
        

        // get packages prices
        $packageData = DB::table('users')
        ->where('users.id', '=', $request->user()->id )
        ->join('packages' , 'packages.id' , '=' , 'users.package_id')        
        ->first(['packages.price' , 'packages.code' , 'packages.period']);

        $request->session()->put('package' , $packageData->code);
        $request->session()->put('period' , $packageData->period);  

        $priceValue   = $packageData->price;

        return view( 'client_dashboard.packages.payforpackage' , compact('SessionId' , 'CountryCode', 'priceValue') );


    }



}
