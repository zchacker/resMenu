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
        
        return view('home.index');
    }

    public function menu(Request $request)
    {

        $restrant = RestrantsModel::where(['slug' => $request->slug])->first();

        if($restrant == NULL){
            abort(Response::HTTP_NOT_FOUND);
            //return "no menu found";
        }else{
            
            $restrant_id = $restrant->id;

            // get menue 
            $menu = MenusModel::where([ 'restrant_id' => $restrant_id ])->first();

            if($menu == NULL){
                
                return "menu NOT found";

            }else{

                $menucategories = MenuCategoriesModel::where(['menu_id' => $menu->id])->get();
                $menueitems     = MenueItemsModel::where(['menu_id' => $menu->id])
                ->join('files' , 'menue_items.image_file_id', '=' , 'files.id')
                ->get(['menue_items.*' , 'files.file_name']);                                           

                return view('customers.menu1' , compact('menucategories' , 'menueitems' , 'restrant_id' , 'restrant'));

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
                    $orderItem->item_id = $item['productId'];
                    $orderItem->quantity = $item['counter'];
                    $orderItem->save();

                }

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
        $start = microtime(true);

        $order_id = $request->order_id;
        $SessionId = '';
        $CountryCode = '';

        // get sub total amount 
        $sub_total = OrderItemsModel::where(['order_id' => $order_id])
        ->join('menue_items' , 'menue_items.id' , '=' , 'orderitems.item_id')
        ->sum(DB::raw('orderitems.quantity * IF(menue_items.offer_price > 0, menue_items.offer_price , menue_items.price) '));                

        $time = microtime(true) - $start;

        $response = Http::withToken('rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL')
       ->withOptions(['verify' => false])
        ->post('https://apitest.myfatoorah.com/v2/InitiateSession' , 
        [
            'CustomerIdentifier' => '123',
        ]);

        
        if($response->ok())
        {
            $SessionId = $response->json(['Data' , 'SessionId']);
            $CountryCode = $response->json(['Data' , 'CountryCode']);
        }                

        //print($sub_total.' time: '. $time. ' Secunds ');

        return view('customers.order_summary' , compact('SessionId' , 'CountryCode' , 'sub_total', 'order_id'));
    }

    public function init_payment(Request $request)
    {
        
        $sessionId  = $request->sessionId;
        $order_id   = $request->order_id;
        $cardBrand  = $request->cardBrand;

        $sub_total = OrderItemsModel::where(['order_id' => $order_id])
        ->join('menue_items' , 'menue_items.id' , '=' , 'orderitems.item_id')
        ->sum(DB::raw('orderitems.quantity * IF(menue_items.offer_price > 0, menue_items.offer_price , menue_items.price) '));

        $customer_data = OrdersModel::where(['orders.id' => $order_id])
        ->join('customers' , 'customers.id' , '=' , 'orders.customer_id')
        ->first(['customers.name' , 'customers.email' , 'customers.phone']);

        // print $sub_total;
        // die;

        // send request to server for payment
        $response = Http::withToken('rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL')
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

            //var_dump($response->json());

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

        $response = Http::withToken(env('PAYTOKEN'))
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
            return redirect(route('payment.result' , [$order_id]).'?result=success' , Response::HTTP_FOUND);

        }else{
            print "not saved";
        }


    }


    public function error_pay(Request $request)
    {

        $order_id = $request->order_id;

        $response = Http::withToken(env('PAYTOKEN'))
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

        return view('customers.payment_result' , compact('slug' ,'result'));

    }



}
