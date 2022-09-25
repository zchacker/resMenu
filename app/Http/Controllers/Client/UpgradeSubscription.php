<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpgradeSubscription extends Controller
{
    
    public function selectPackage(Request $request)
    {

        $package = $request->package;
        $period  = $request->period;


        if(empty($package) == TRUE){
            $package = 1;
        }        

        if(empty($period)){
            $period = 'month';
        }

        $request->session()->put('package' , $package);
        $request->session()->put('period' , $period);
        
    }

}
