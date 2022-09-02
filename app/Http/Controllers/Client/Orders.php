<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Orders extends Controller
{
    
    public function get_orders(Request $request)
    {

        $user_id = $request->user()->id;
        $restrant = DB::table('restrants')->where(['user_id' => $user_id])->first();
        $restrant_id = $restrant->id;

        $orders =  DB::table('orders')
        //->select(DB::raw('count(*) as user_count, status'))
        //->where('status', '<>', 1)
        //->groupBy('status')
        ->where( 'restrant_id' , '=' , $restrant_id )
        ->orderByDesc('created_at')
        ->paginate(20);

        return view('client_dashboard.order.orders', compact('orders'));
    }

}
