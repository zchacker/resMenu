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
Route::get('/register' , [\App\Http\Controllers\AuthClient::class , 'register'])->name('register');
Route::post('/register_submit' , [\App\Http\Controllers\AuthClient::class , 'requestRegister'])->name('submit.register');
Route::get('/login' , [\App\Http\Controllers\AuthClient::class , 'loginView'])->name('login');
Route::post('/login_submit' , [\App\Http\Controllers\AuthClient::class , 'login'])->name('submit.login');
Route::get('image/{filename}' , [\App\Http\Controllers\Files::class , 'displayImage'])->name('image.displayImage');
Route::get('/m/{slug}' , [\App\Http\Controllers\Home::class , 'menu'])->name('menu');


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
    Route::get('/dashboard/items/{item_id?}/edit/submit', [\App\Http\Controllers\Client\MenuItem::class, 'edit_item_submit'])->name('dashboard.items.edit.submit');

    Route::get('/dashboard/logout', [\App\Http\Controllers\AuthClient::class, 'logout'])->name('dashboard.logout');

});


