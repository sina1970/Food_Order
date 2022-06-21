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
Route::post('client/addaddress',[AddressController::class,'addAddress']);
Route::get('client/showaddress/{client_id}',[AddressController::class,'showClientAddresses']);
Route::post('addorder',[OrderController::class,'store']);
Route::apiResource('order',OrderController::class);

Route::group( ['prefix' => 'client','middleware' => ['auth:client-api','scopes:client'] ],function(){
    // authenticated staff routes here
    Route::get('dashboard',[LoginController::class, 'clientDashboard']);
});

//ADMIN
//Route::post('user/register',[LoginController::class, 'userRegister'])->name('userRegister');
Route::apiResource('categories',CategoryController::class);
Route::apiResource('foods',FoodsController::class);
Route::get('menu/{category_id}',[MenuController::class,'showMenu']);
Route::apiResource('orders',AdminOrderController::class);
Route::post('user/login',[LoginController::class, 'userLogin'])->name('userLogin');
Route::group( ['prefix' => 'user','middleware' => ['auth:user-api','scopes:user'] ],function(){
    // authenticated staff routes here
    Route::get('dashboard',[LoginController::class, 'userDashboard']);
});


//test
Route::post('test',[\App\Http\Controllers\TestController::class,'index']);
