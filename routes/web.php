<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

//Route::redirect('/' , 'ar');

// this for public routes
Route::get('/', [\App\Http\Controllers\Home::class, 'index'])->name('home');
Route::get('/register/{period?}/{package?}' , [\App\Http\Controllers\AuthClient::class , 'register'])->name('register.user');
Route::post('/register_submit' , [\App\Http\Controllers\AuthClient::class , 'requestRegister'])->name('submit.register');
Route::get('/login' , [\App\Http\Controllers\AuthClient::class , 'loginView'])->name('login');
Route::post('/login_submit' , [\App\Http\Controllers\AuthClient::class , 'login'])->name('submit.login');
Route::get('image/{filename}' , [\App\Http\Controllers\Files::class , 'displayImage'])->name('image.displayImage');
Route::get('/m/{slug}' , [\App\Http\Controllers\Home::class , 'menu'])->name('menu');
Route::post('/addOrder' , [\App\Http\Controllers\Home::class , 'add_order'])->name('addOrder');
Route::get('/order/{order_id?}' , [\App\Http\Controllers\Home::class , 'order_details'])->name('order.details');
Route::post('/init_payment' , [\App\Http\Controllers\Home::class , 'init_payment'])->name('order.pay');
Route::get('/success_pay/{order_id?}' , [\App\Http\Controllers\Home::class , 'success_pay'])->name('payment.success');
Route::get('/error_pay/{order_id?}' , [\App\Http\Controllers\Home::class , 'error_pay'])->name('payment.error');
Route::get('/payment_result/{order_id?}' , [\App\Http\Controllers\Home::class , 'payment_result'])->name('payment.result');

Route::get('/send_whatsapp/{order_id?}' , [\App\Http\Controllers\Home::class , 'send_whatsapp'])->name('send.whatsapp');


// forgot password
Route::get('/forgotPassword'  , [\App\Http\Controllers\AuthClient::class , 'forgotPassword'])->name('forgotPassword');    
Route::post('/forgotPassword/submit' , [\App\Http\Controllers\AuthClient::class , 'forgotPasswordSubmit'])->name('forgotPassword.submit');

Route::get('/resetPassword/{id}/{token}'  , [\App\Http\Controllers\AuthClient::class , 'restPassword'])->name('resetPassword');
Route::post('/resetPassword/submit'  , [\App\Http\Controllers\AuthClient::class , 'restPasswordSubmit'])->name('resetPassword.submit');


Route::group(['prefix' => '{language?}'], function($language){

    if (! in_array($language, ['en', 'ar'])) {
        //abort(400);
        App::setLocale('ar');
    }

    // Route::getRoutes();

    Route::get('/', [\App\Http\Controllers\Home::class, 'index'])->name('home');
    Route::get('/register' , [\App\Http\Controllers\AuthClient::class , 'register'])->name('register');
    Route::get('/login' , [\App\Http\Controllers\AuthClient::class , 'loginView'])->name('login');
    
    

    Route::prefix('/service')->group(function(){
        
    });

});


Route::group([ 'middleware' => ['auth:user'] ] , function(){
          
    Route::get('/dashboard/home', [\App\Http\Controllers\Client\Home::class, 'index'])->name('dashboard.home');
    Route::get('/dashboard/shop', [\App\Http\Controllers\Client\Home::class, 'shop'])->name('dashboard.shop');
    Route::post('/dashboard/shop/update', [\App\Http\Controllers\Client\Home::class, 'updateShop'])->name('dashboard.update.shop');
        
    
    // this for menue category
    Route::get('/dashboard/categories', [\App\Http\Controllers\Client\Menu::class, 'categories'])->name('dashboard.categories');
    Route::get('/dashboard/categories/add', [\App\Http\Controllers\Client\Menu::class, 'add_category'])->name('dashboard.categories.add');    
    Route::get('/dashboard/categories/edit/{id?}', [\App\Http\Controllers\Client\Menu::class, 'edit_category'])->name('dashboard.categories.edit');    
    Route::post('/dashboard/categories/add/submit', [\App\Http\Controllers\Client\Menu::class, 'add_category_submit'])->name('dashboard.categories.add.submit');    
    Route::post('/dashboard/categories/edit/submit', [\App\Http\Controllers\Client\Menu::class, 'edit_category_submit'])->name('dashboard.categories.edit.submit');    
    Route::get('/dashboard/categories/delete/{id?}', [\App\Http\Controllers\Client\Menu::class, 'delete_menu_category'])->name('dashboard.categories.delete');

    // this for menue item
    Route::get('/dashboard/items/{category_id?}', [\App\Http\Controllers\Client\MenuItem::class, 'items'])->name('dashboard.items');
    Route::get('/dashboard/items/{category_id?}/add', [\App\Http\Controllers\Client\MenuItem::class, 'add_item'])->name('dashboard.items.add');        
    Route::post('/dashboard/items/{category_id?}/add/submit', [\App\Http\Controllers\Client\MenuItem::class, 'add_item_submit'])->name('dashboard.items.add.submit');    

    Route::get('/dashboard/items/{category_id?}/edit/{item_id?}', [\App\Http\Controllers\Client\MenuItem::class, 'edit_item'])->name('dashboard.items.edit');
    Route::post('/dashboard/items/{item_id?}/edit/submit', [\App\Http\Controllers\Client\MenuItem::class, 'edit_item_submit'])->name('dashboard.items.edit.submit');
    Route::get('/dashboard/items/delete/{item_id?}/{category_id?}', [\App\Http\Controllers\Client\MenuItem::class, 'delete_item'])->name('dashboard.items.delete');

    
    Route::group(['middleware' => ['role:paidUser']] , function(){

        // manage order
        Route::get('/dashboard/orders', [\App\Http\Controllers\Client\Orders::class, 'get_orders'])->name('dashboard.orders');
        Route::get('/dashboard/orders/details/{order_id?}', [\App\Http\Controllers\Client\Orders::class, 'order_details'])->name('dashboard.orders.details');
   
        // to update whatsapp    
        Route::get('/dashboard/whatsapp', [\App\Http\Controllers\Client\Whatsapp::class, 'whatsapp_info'])->name('dashboard.whatsapp');
        Route::post('/dashboard/whatsapp/update', [\App\Http\Controllers\Client\Whatsapp::class, 'updateWhatsappData'])->name('dashboard.whatsapp.update');

    });

    
    Route::get('/dashboard/qr', [\App\Http\Controllers\Client\Qr::class, 'showQr'])->name('dashboard.qr');
    Route::post('/dashboard/qr/submit', [\App\Http\Controllers\Client\Qr::class, 'updateQr'])->name('dashboard.qr.submit');

    // update settings
    Route::get('/dashboard/settings', [\App\Http\Controllers\Client\Settings::class, 'show_settings'])->name('dashboard.settings');    
    Route::post('/dashboard/settings/update', [\App\Http\Controllers\Client\Settings::class, 'update_profile'])->name('dashboard.settings.update');
    
    // packages
    Route::get('/dashboard/packages/list' , [\App\Http\Controllers\Client\Packages::class, 'listPackages'])->name('dashboard.package.list');
    Route::get('/dashboard/packagePay' , [\App\Http\Controllers\Client\Packages::class, 'payForPackageAfterRegister'])->name('dashboard.package.pay');
    Route::post('/dashboard/package/make/payment' , [\App\Http\Controllers\Client\Packages::class, 'executePayment'])->name('dashboard.package.pay.submit');

    Route::get('dashboard/package/pay/result/' , [\App\Http\Controllers\Client\Packages::class, 'result'])->name('dashboard.package.pay.result');
    Route::get('dashboard/pay/success/' , [\App\Http\Controllers\Client\Packages::class, 'successPay'])->name('dashboard.package.pay.success');
    Route::get('dashboard/pay/error/' , [\App\Http\Controllers\Client\Packages::class, 'errorPay'])->name('dashboard.package.pay.error');

    // update password
    Route::get('/dashboard/password', [\App\Http\Controllers\Client\Settings::class, 'password_form'])->name('dashboard.password');
    Route::post('/dashboard/password/update', [\App\Http\Controllers\Client\Settings::class, 'update_password'])->name('dashboard.password.update');

    Route::get('/dashboard/ram', [\App\Http\Controllers\Client\Qr::class, 'total_ram_cpu_usage'])->name('dashboard.ram');

    Route::get('/dashboard/logout', [\App\Http\Controllers\AuthClient::class, 'logout'])->name('dashboard.logout');

});


