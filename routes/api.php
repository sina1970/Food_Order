<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FoodsController;
use App\Http\Controllers\Client\AddressController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Admin\AdminOrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//CLIENT
Route::post('client/login',[LoginController::class, 'clientLogin'])->name('clientLogin');
Route::post('client/register',[LoginController::class, 'clientRegister'])->name('clientRegister');


Route::group( ['prefix' => 'client','middleware' => ['auth:client-api','scopes:client'] ],function(){
    // authenticated staff routes here
    Route::get('dashboard',[LoginController::class, 'clientDashboard']);
    Route::post('addaddress',[AddressController::class,'addAddress']);
    Route::get('showaddress/{client_id}',[AddressController::class,'showClientAddresses']);
    Route::apiResource('order',OrderController::class);

});

//ADMIN

Route::get('menu/{category_id}',[MenuController::class,'showMenu']);
Route::post('user/login',[LoginController::class, 'userLogin'])->name('userLogin');
Route::group( ['prefix' => 'user','middleware' => ['auth:user-api','scopes:user'] ],function(){
    // authenticated staff routes here
    Route::get('dashboard',[LoginController::class, 'userDashboard']);
    Route::apiResource('categories',CategoryController::class);
    Route::apiResource('foods',FoodsController::class);

    Route::apiResource('orders',AdminOrderController::class);
});


//test
Route::post('test',[\App\Http\Controllers\TestController::class,'index']);
