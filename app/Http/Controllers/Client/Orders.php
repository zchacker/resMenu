<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Orders extends Controller
{
    
    public function get_orders(Request $request)
    {

        $orders =  DB::table('users')
        ->select(DB::raw('count(*) as user_count, status'))
        ->where('status', '<>', 1)
        ->groupBy('status')
        ->get();

        return view('client_dashboad.order.orders', compact('orders'));
    }

}
