<?php

namespace App\Http\Controllers\Clinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Home extends Controller
{

    public function index(Request $request)
    {

        return view('client_dashboard.home');
    }

    public function shop(Request $request)
    {
        return view('client_dashboard.shop');
    }

    public function updateShop(Request $request)
    {
        
    }

}
