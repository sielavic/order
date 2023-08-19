<?php

use App\Models\Order;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'App\Http\Controllers\OrderController@index');

Route::get('/orders/create',  function (Request $request) {
    return view('orders.create');
});

Route::post('/orders', 'App\Http\Controllers\OrderController@create');

Route::put('/orders/{order}', 'App\Http\Controllers\OrderController@update');


Route::get('/orders/{order}/edit',  function (Request $request, $order) {
    return view('orders.edit', ['order' => Order::find($order)]);
});


Route::get('/orders/{order}/confirm', 'App\Http\Controllers\OrderController@confirm');
Route::get('/orders/{order}/complete', 'App\Http\Controllers\OrderController@complete');
