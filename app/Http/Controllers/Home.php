<?php

namespace App\Http\Controllers;

use App\Models\CustomersModel;
use App\Models\CustomersPaymentsModel;
use App\Models\MenuCategoriesModel;
use App\Models\MenueItemsModel;
use App\Models\MenusModel;
use App\Models\OrderItemsModel;
use App\Models\OrdersModel;
use App\Models\RestrantsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class Home extends Controller
{
    public function index(Request $request)
    {
        $start = 'hello';
        return view('home.index', compact('start'));
    }

    public function menu(Request $request)
    {

        // $restrant = RestrantsModel::where(['slug' => $request->slug])->first();
        $restrant = DB::table('restrants')->where([ 'slug' => $request->slug ])->first();

        if($restrant == NULL){
            
            return abort(Response::HTTP_NOT_FOUND);
            
        }else{
            
            $restrant_id = $restrant->id;

            // get menue 
            // $menu = MenusModel::where([ 'restrant_id' => $restrant_id ])->first();
            $menu = DB::table('menus')->where([ 'restrant_id' => $restrant_id ])->first();

            if($menu == NULL){
                
                return abort(Response::HTTP_NOT_FOUND);

            }else{
                
                $menucategories = DB::table('menu_categories')->where([ 'menu_id' => $menu->id ])->get();

                $menueitems     = DB::table('menu_items')->where([ 'menu_id' => $menu->id ])
                ->join('files' , 'menu_items.image_file_id', '=' , 'files.id')
                ->get(['menu_items.*' , 'files.file_name']);

                $cover_img  = '';
                $avatar_img = '';


                if( ! empty($restrant->cover) )
                {
                    $cover_img_query = DB::table('files')
                    ->select('file_name')
                    ->where('id' , '=' , $restrant->cover )
                    ->get();

                    if($cover_img_query != NULL){
                        $cover_img = $cover_img_query[0]->file_name;
                    }
                }
                

                if(! empty($restrant->avatar))
                {
                    $avatar_img_query = DB::table('files')
                    ->select('file_name')
                    ->where('id' , '=' , $restrant->avatar )
                    ->first();

                    if($avatar_img_query != NULL){
                        $avatar_img = $avatar_img_query->file_name;
                    }
                }

                return view('customers.menu2' , compact('menucategories' , 'menueitems' , 'restrant_id' , 'restrant', 'cover_img' , 'avatar_img'));

            }
        }

        //return view('home.index');
    }

    public function add_order(Request $request)
    {

        $cart               = $request->cart;
        $restrant_id        = $request->restrant_id;
        $customer_name      = $request->customer_name;
        $customer_phone     = $request->customer_phone;
        $customer_email     = $request->customer_email;
        $payment_type       = $request->payment_type;

        // add customer 
        $customer        = new CustomersModel();
        $customer->name  = $customer_name;
        $customer->email = $customer_email;
        $customer->phone = $customer_phone;

        if( $customer->save() ){

            $customer_id = $customer->id;

            // create order
            $order = new OrdersModel();
            $order->payment_type = $payment_type;
            $order->restrant_id  = $restrant_id;
            $order->customer_id  = $customer_id;

            if($order->save()){

                $order_id = $order->id;

                foreach($cart AS $item){
                    
                    $orderItem = new OrderItemsModel();

                    $orderItem->order_id = $order_id;
                    $orderItem->item_id  = $item['productId'];
                    $orderItem->quantity = $item['counter'];
                    $orderItem->save();

                }

                // update order total amount
                $sub_total = DB::table('order_items')->where(['order_id' => $order_id])
                ->join('menu_items' , 'menu_items.id' , '=' , 'order_items.item_id')
                ->sum(DB::raw('order_items.quantity * IF(menu_items.offer_price > 0, menu_items.offer_price , menu_items.price) '));                

                $update_order = OrdersModel::find($order_id);
                $update_order->total_amount = $sub_total;
                $update_order->update();

                $myObj = new \stdClass();
                $myObj->success = TRUE;                
                $myObj->error   = "";
                $myObj->url     = route('order.details' , $order_id);
                $myObj->orderID = $order_id;

                $json = json_encode($myObj, JSON_PRETTY_PRINT);
                
                return response($json , Response::HTTP_OK);                

            }
        }

        $myObj          = new \stdClass();
        $myObj->success = FALSE;                
        $myObj->error   = "الطلب لم يكتمل لحدوث خلل فني, حاول لاحقاً";
        $myObj->orderID = 0;

        $json = json_encode($myObj, JSON_PRETTY_PRINT);
        
        return response($json , Response::HTTP_OK); 

    }

    public function order_details(Request $request)
    {


        $start          = microtime(true);

        $order_id       = $request->order_id;
        $SessionId      = '';
        $CountryCode    = '';

        $order_data = OrdersModel::where(['id' => $order_id ])->first();

        $restrant_id   = $order_data->restrant_id;
        $restrant      = RestrantsModel::where(['id' => $restrant_id])->first();        
        $payment_token = $restrant->payment_token;

        if($order_data->payment_type == 'credit'){
            
            // get sub total amount 
            $sub_total = DB::table('order_items')->where(['order_id' => $order_id])
            ->join('menu_items' , 'menu_items.id' , '=' , 'order_items.item_id')
            ->sum(DB::raw('order_items.quantity * IF(menu_items.offer_price > 0, menu_items.offer_price , menu_items.price) '));                

            $sub_total = round($sub_total , 2);

            $time = microtime(true) - $start;

            $response = Http::withToken($payment_token)
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

            //print($sub_total.' time: '. $time. ' Secunds ');

            return view('customers.order_payment' , compact('SessionId' , 'CountryCode' , 'sub_total', 'order_id'));

        }else{

            $order = OrdersModel::where(['id' => $order_id])->first();
            $restrant_id = $order->restrant_id;
            $order->status = 2;
            $order->update();

            $restrant = RestrantsModel::where(['id' => $restrant_id])->first();        
            $slug = $restrant->slug;

            return view('customers.order_summary' , compact('order_id', 'slug'));

        }


    }

    public function send_whatsapp(Request $request)
    {

        $order_id       = $request->order_id;
        $order_data     = DB::table('orders')->where([ 'id' => $order_id ])->first();

        $items = DB::table('order_items')->where(['order_id' => $order_id])
        ->join('menu_items' , 'menu_items.id' , '=' , 'order_items.item_id')
        ->get([ 'order_items.id' , 'order_items.quantity' , 'menu_items.name' ]);

        $customer_data = DB::table('customers')->where([ 'id' => $order_data->customer_id ])->first();
        $sub_total = DB::table('order_items')->where(['order_id' => $order_id])
        ->join('menu_items' , 'menu_items.id' , '=' , 'order_items.item_id')
        ->sum(DB::raw('order_items.quantity * IF(menu_items.offer_price > 0, menu_items.offer_price , menu_items.price) '));                

        $sub_total = round($sub_total , 2);

        $customer_details = 'الاسم: '. $customer_data->name . '
رقم الهاتف: ' . $customer_data->phone;
        $order_details    = '';

        foreach($items as $item)
        {
            $order_details .= $item->name.' ------- *  '. $item->quantity . '
';
        }        

        $restrant_id = $order_data->restrant_id;

        $restrant_data = DB::table('restrants')->where([ 'id' => $restrant_id ])->first();
        $restrant_phone = $restrant_data->phone;
        $wahtsapp_message_body = $restrant_data->wahtsapp_message_body;

        $search = array('{ORDER_ID}', '{ORDER_DETAILS}', '{CUSTOMER_DETAILS}', '{ORDER_TOTAL}');
        $replace = array($order_id, $order_details , $customer_details , $sub_total );
        $string = $wahtsapp_message_body;
        
        // urlencode
        $message = urlencode(str_replace($search, $replace, $string, $count));
        //echo(str_replace($search, $replace, $string, $count));


        $url = "https://wa.me/$restrant_phone?text=$message";
        return redirect($url);

    }

    public function init_payment(Request $request)
    {
        
        $sessionId  = $request->sessionId;
        $order_id   = $request->order_id;
        $cardBrand  = $request->cardBrand;

        $order_data = OrdersModel::where(['id' => $order_id ])->first();

        $restrant_id   = $order_data->restrant_id;
        $restrant      = RestrantsModel::where(['id' => $restrant_id])->first();        
        $payment_token = $restrant->payment_token;

        // get sub total amount 
        $sub_total = DB::table('order_items')->where(['order_id' => $order_id])
        ->join('menu_items' , 'menu_items.id' , '=' , 'order_items.item_id')
        ->sum(DB::raw('order_items.quantity * IF(menu_items.offer_price > 0, menu_items.offer_price , menu_items.price) '));                

        $customer_data = OrdersModel::where(['orders.id' => $order_id])
        ->join('customers' , 'customers.id' , '=' , 'orders.customer_id')
        ->first(['customers.name' , 'customers.email' , 'customers.phone']);

        // print $sub_total;
        // die;

        // send request to server for payment
        
        $response = Http::withToken($payment_token)
        ->withOptions(['verify' => false])
        ->post('https://apitest.myfatoorah.com/v2/ExecutePayment',
        [
            'SessionId' => $sessionId,
            'InvoiceValue' => $sub_total,
            'CustomerName' => $customer_data->name,
            'DisplayCurrencyIso' => 'SAR' ,
            //'MobileCountryCode' => '966',
            //'CustomerMobile' => $customer_data->phone ,
            'CustomerEmail' => $customer_data->email ,
            'CallBackUrl' => route('payment.success' , $order_id) ,
            'ErrorUrl' => route('payment.error' , $order_id) ,
            'Language' => 'ar',
            'CustomerReference' => 'noshipping-nosupplier' ,            
        ]);
        

        if($response->ok())
        {
            $url = $response->json(['Data' , 'PaymentURL']);
            
            $myObj = new \stdClass();
            $myObj->success = TRUE;                
            $myObj->error   = "";
            $myObj->url     = $url;            

            $json = json_encode($myObj, JSON_PRETTY_PRINT);
            
            return response($json , Response::HTTP_OK); 

        } else {

            var_dump($response->json());

            $error ='';// $response->json(['ValidationErrors']);
            
            $myObj = new \stdClass();
            $myObj->success = FALSE;                
            $myObj->error   = "عملية الدفع لم تتم بنجاح, حاول مرة أخرى ". $error ;
            $myObj->url     = "";            

            $json = json_encode($myObj, JSON_PRETTY_PRINT);
            
            return response($json , Response::HTTP_OK);

        }


    }

    public function success_pay(Request $request)
    {
        
        $order_id = $request->order_id;

        $order_data    = OrdersModel::where(['id' => $order_id ])->first();

        $restrant_id   = $order_data->restrant_id;
        $restrant      = RestrantsModel::where(['id' => $restrant_id])->first();        
        $payment_token = $restrant->payment_token;

        $response = Http::withToken($payment_token)
        ->withOptions(['verify' => false])
        ->post('https://apitest.myfatoorah.com/v2/GetPaymentStatus',
        [
            'Key' => $request->paymentId ,
            'KeyType' => "PaymentId",                       
        ]);

        $invoiceStatus = $response->json(['Data' , 'InvoiceStatus']);
        $amount = $response->json(['Data' , 'InvoiceValue']);
        $InvoiceTransactions = $response->json(['Data' , 'InvoiceTransactions']); 
        $paymentGateway = $InvoiceTransactions[0]['PaymentGateway'];
        $paymentId = $InvoiceTransactions[0]['PaymentId'];
        $transactionStatus = $InvoiceTransactions[0]['TransactionStatus'];
        $currency = $InvoiceTransactions[0]['PaidCurrency'];
        $cardNumber = $InvoiceTransactions[0]['CardNumber'];

        $savePayment = new CustomersPaymentsModel();

        $savePayment->invoiceStatus = $invoiceStatus;
        $savePayment->order_id = $order_id;
        $savePayment->amount = $amount;
        $savePayment->paymentGateway = $paymentGateway;
        $savePayment->paymentId = $paymentId;
        $savePayment->transactionStatus = $transactionStatus;
        $savePayment->currency = $currency;
        $savePayment->cardNumber = $cardNumber;
        
        if($savePayment->save())
        {
            $order = OrdersModel::where(['id' => $order_id])->first();            
            $order->status = 2;
            $order->update();

            return redirect(route('payment.result' , [$order_id]).'?result=success' , Response::HTTP_FOUND);

        }else{
            print "not saved";
        }


    }


    public function error_pay(Request $request)
    {

        $order_id = $request->order_id;

        $order_data    = OrdersModel::where(['id' => $order_id ])->first();

        $restrant_id   = $order_data->restrant_id;
        $restrant      = RestrantsModel::where(['id' => $restrant_id])->first();        
        $payment_token = $restrant->payment_token;

        $response = Http::withToken($payment_token)
        ->withOptions(['verify' => false])
        ->post('https://apitest.myfatoorah.com/v2/GetPaymentStatus',
        [
            'Key' => $request->paymentId ,
            'KeyType' => "PaymentId",                       
        ]);

        $invoiceStatus = $response->json(['Data' , 'InvoiceStatus']);
        $amount = $response->json(['Data' , 'InvoiceValue']);
        $InvoiceTransactions = $response->json(['Data' , 'InvoiceTransactions']); 
        $paymentGateway = $InvoiceTransactions[0]['PaymentGateway'];
        $paymentId = $InvoiceTransactions[0]['PaymentId'];
        $transactionStatus = $InvoiceTransactions[0]['TransactionStatus'];
        $currency = $InvoiceTransactions[0]['PaidCurrency'];
        $cardNumber = $InvoiceTransactions[0]['CardNumber'];
        $Error = $InvoiceTransactions[0]['Error'];

        $savePayment = new CustomersPaymentsModel();

        $savePayment->invoiceStatus = $invoiceStatus;
        $savePayment->order_id = $order_id;
        $savePayment->amount = $amount;
        $savePayment->paymentGateway = $paymentGateway;
        $savePayment->paymentId = $paymentId;
        $savePayment->transactionStatus = $transactionStatus;
        $savePayment->currency = $currency;
        $savePayment->cardNumber = $cardNumber;
        $savePayment->error = $Error;
        
        if($savePayment->save())
        {
            
            return redirect(route('payment.result' , [$order_id]).'?result=error' , Response::HTTP_FOUND);

        }else{

            print "Error";

        }

    }


    public function payment_result(Request $request)
    {

        $order_id = $request->order_id;
        $order = OrdersModel::where(['id' => $order_id])->first();
        $restrant_id = $order->restrant_id;

        $restrant = RestrantsModel::where(['id' => $restrant_id])->first();        
        $slug = $restrant->slug;
        $result = $request->result;

        return view('customers.payment_result' , compact('slug' ,'result', 'order_id'));

    }



}
