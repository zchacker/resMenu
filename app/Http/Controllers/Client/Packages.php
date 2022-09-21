<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\PaymentTransactionsModel;
use App\Models\UsersModel;
use App\Models\UsersSubscriptionsModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class Packages extends Controller
{
    

    public function payForPackageAfterRegister(Request $request)
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

        // get selected package
        $package = session('package');
        $period  = session('period');

        // get packages prices
        $packageData = DB::table('packages')
        ->where('code', '=', $package)
        ->where('period', '=', $period)
        ->first();

        $priceValue   = $packageData->price;

        return view( 'client_dashboard.packages.payforpackage' , compact('SessionId' , 'CountryCode', 'priceValue') );

    }

    public function listPackages(Request $request)
    {

        $package_id = $request->user()->package_id;
        $package_code = DB::table('packages')
        ->where(['id' => $package_id])
        ->first()->code;  
        
        $subscription = DB::table('users_subscriptions')
        ->where(['user_id' => $request->user()->id])
        ->latest("start_date")
        ->first();

        return view('client_dashboard.packages.list' , compact('package_code', 'subscription'));
    }

    public function currect_subscription(Request $request)
    {

    }

    public function upgradePackage(Request $request)
    {

    }

    public function executePayment(Request $request)
    {

        $sessionId  = $request->sessionId;        

        // get selected package
        $package = session('package');
        $period  = session('period');
        
        // get packages prices
        $packageData = DB::table('packages')
        ->where('code' , '=' , $package)
        ->where('period' , '=' , $period)
        ->first();

        $priceValue   = $packageData->price;
        $periodValue  = $packageData->period;
        $intervalDays = 30;
        $iteration    = 0;

        if($periodValue == 'year'){
            $intervalDays = 180;   
            $priceValue = ($priceValue/2);         
        }       

        $requestBody = [
            'SessionId' => $sessionId,
            'InvoiceValue' => $priceValue ,
            'CustomerName' => $request->user()->name,
            'DisplayCurrencyIso' => 'SAR' ,
            'CustomerEmail' => $request->user()->email ,
            'CallBackUrl' => route('dashboard.package.pay.success') ,
            'ErrorUrl' => route('dashboard.package.pay.error') ,
            'Language' => 'ar',                  
            // 'RecurringModel'  => [
            //     'RecurringType' => 'Custom',
            //     'IntervalDays'  => $intervalDays,
            //     'Iteration'     => 0
            // ]      
        ];

        if($periodValue == 'forever'){
            
            $requestBody = [
                'SessionId' => $sessionId,
                'InvoiceValue' => $priceValue ,
                'CustomerName' => $request->user()->name,
                'DisplayCurrencyIso' => 'SAR' ,
                'CustomerEmail' => $request->user()->email ,
                'CallBackUrl' => route('dashboard.package.pay.success') ,
                'ErrorUrl' => route('dashboard.package.pay.error') ,
                'Language' => 'ar',                                 
            ];

        }

        $response = Http::withToken(env('PAYTOKEN'))
        ->withOptions(['verify' => false])
        ->post('https://apitest.myfatoorah.com/v2/ExecutePayment', $requestBody );
        

        if($response->ok())
        {
            $url = $response->json(['Data' , 'PaymentURL']);            
            //$RecurringId = $response->json(['Data' , 'RecurringId']);

            //$request->session()->put('RecurringId' , $RecurringId);

            $myObj          = new \stdClass();
            $myObj->success = TRUE;                
            $myObj->error   = "";
            $myObj->url     = $url;            

            $json = json_encode($myObj, JSON_PRETTY_PRINT);
            
            return response($json , Response::HTTP_OK); 

        } else {

            var_dump($response->json());

            $error ='';// $response->json(['ValidationErrors']);
            
            $myObj          = new \stdClass();
            $myObj->success = FALSE;                
            $myObj->error   = "عملية الدفع لم تتم بنجاح, حاول مرة أخرى ". $error ;
            $myObj->url     = "";            

            $json = json_encode($myObj, JSON_PRETTY_PRINT);
            
            return response($json , Response::HTTP_OK);

        }

    }

    public function successPay(Request $request)
    {

        $response = Http::withToken(env('PAYTOKEN'))
        ->withOptions(['verify' => false])
        ->post('https://apitest.myfatoorah.com/v2/GetPaymentStatus',
        [
            'Key' => $request->paymentId ,
            'KeyType' => "PaymentId",                       
        ]);       

        $invoiceStatus       = $response->json(['Data' , 'InvoiceStatus']);
        $amount              = $response->json(['Data' , 'InvoiceValue']);
        $InvoiceTransactions = $response->json(['Data' , 'InvoiceTransactions']); 
        $paymentGateway      = $InvoiceTransactions[0]['PaymentGateway'];
        $paymentId           = $InvoiceTransactions[0]['PaymentId'];
        $transactionStatus   = $InvoiceTransactions[0]['TransactionStatus'];
        $currency            = $InvoiceTransactions[0]['PaidCurrency'];
        $cardNumber          = $InvoiceTransactions[0]['CardNumber'];

        // save payment transaction
        $savePayment = new PaymentTransactionsModel();
        $savePayment->invoiceStatus = $invoiceStatus;
        $savePayment->user_id = $request->user()->id;
        $savePayment->amount = $amount;
        $savePayment->paymentGateway = $paymentGateway;
        $savePayment->paymentId = $paymentId;
        $savePayment->transactionStatus = $transactionStatus;
        $savePayment->currency = $currency;
        $savePayment->cardNumber = $cardNumber;
        $savePayment->error = '';
        
        // get selected package
        $package = session('package');
        $period  = session('period');
        
        // get packages prices
        $packageData = DB::table('packages')
        ->where('code' , '=' , $package)
        ->where('period' , '=' , $period)
        ->first();

        // get data from our package
        $priceValue  = $packageData->price;
        $periodValue = $packageData->period;
        $days = 30;

        if($periodValue == 'year'){
            $days = 365;
        }

        if($periodValue == 'forever'){
            $days = 365 * 40;
        }

        // save it to subscribtion
        $subscribtion = new UsersSubscriptionsModel();
        $subscribtion->user_id = $request->user()->id;
        $subscribtion->package_id = $packageData->id;
        $subscribtion->amount = $amount;
        $subscribtion->transaction_id = $paymentId;
        //$subscribtion->recurringId = session('RecurringId');
        $subscribtion->start_date = Carbon::now();
        $subscribtion->end_date = Carbon::now()->addDays($days);// add('day' , $days);
        $subscribtion->save();

        $update_user = DB::table('users')
        ->where(['id' => $request->user()->id])
        ->update(['package_id' => $packageData->id]);

        if($savePayment->save())
        {            
            // assgin roles
            //$user = $request->user();
            $user = UsersModel::where(['id' => $request->user()->id ])->first();

            if($periodValue == 'year'){
                //$user->givePermissionTo('create-menu');
                $user->assignRole('paidUser');
            }
    
            if($periodValue == 'forever'){
                $user->assignRole('paidUser');
            }

            return redirect(route('dashboard.package.pay.result').'?result=success' , Response::HTTP_FOUND);

        }else{

            return "not saved";

        }            

    }


    public function errorPay(Request $request)
    {


        $response = Http::withToken(env('PAYTOKEN'))
        ->withOptions(['verify' => false])
        ->post('https://apitest.myfatoorah.com/v2/GetPaymentStatus',
        [
            'Key' => $request->paymentId ,
            'KeyType' => "PaymentId",                       
        ]);       

        $invoiceStatus       = $response->json(['Data' , 'InvoiceStatus']);
        $amount              = $response->json(['Data' , 'InvoiceValue']);
        $InvoiceTransactions = $response->json(['Data' , 'InvoiceTransactions']); 
        $paymentGateway      = $InvoiceTransactions[0]['PaymentGateway'];
        $paymentId           = $InvoiceTransactions[0]['PaymentId'];
        $transactionStatus   = $InvoiceTransactions[0]['TransactionStatus'];
        $currency            = $InvoiceTransactions[0]['PaidCurrency'];
        $cardNumber          = $InvoiceTransactions[0]['CardNumber'];

        $savePayment = new PaymentTransactionsModel();
        $savePayment->invoiceStatus = $invoiceStatus;
        $savePayment->user_id = $request->user()->id;
        $savePayment->amount = $amount;
        $savePayment->paymentGateway = $paymentGateway;
        $savePayment->paymentId = $paymentId;
        $savePayment->transactionStatus = $transactionStatus;
        $savePayment->currency = $currency;
        $savePayment->cardNumber = $cardNumber;
        
        if($savePayment->save())
        {
            return redirect(route('dashboard.package.pay.result').'?result=error' , Response::HTTP_FOUND);
        }else{
            print "not saved";
        }

    }

    public function result(Request $request)
    {

        $result = $request->result;
        $message = 'تم الاشتراك بنجاح';

        if($result == 'error'){
            $message = '';
        }

        return view('client_dashboard.packages.result' , compact('message'));
    }

}
