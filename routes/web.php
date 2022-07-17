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
    
    Route::get('/dashboard/home', [\App\Http\Controllers\Clinet\Home::class, 'index'])->name('dashboard.home');
    Route::get('/dashboard/logout', [\App\Http\Controllers\AuthClient::class, 'logout'])->name('dashboard.logout');

});


