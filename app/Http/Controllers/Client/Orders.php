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

    public function order_details(Request $request)
    {

        // get order data
        $order = DB::table('orders')
        ->where(['id' => $request->order_id])
        ->first();

        // get customet data
        $customer = DB::table('customers')
        ->where(['id' => $order->customer_id ])
        ->first();        

        // get order data
        $order_items = DB::table('order_items')
        ->join('menu_items' , 'order_items.item_id' , '=' , 'menu_items.id')
        ->join('files' , 'menu_items.image_file_id' , '=' , 'files.id')
        ->where(['order_items.order_id' => $request->order_id ])
        ->get(['order_items.*' , 'menu_items.name' , 'menu_items.price' , 'menu_items.offer_price', 'files.file_name']);

        return view('client_dashboard.order.order_details', compact( 'order' , 'customer' , 'order_items' ));
    }

}
