<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login','Api\UserController@login');
Route::post('customer','Api\CustomerController@index');
Route::post('register', 'Api\UserController@register');
Route::get('produk', 'Api\ProdukController@index');
Route::get('produk/{id}', 'Api\ProdukController@getId');
Route::post('chekout', 'Api\TransaksiController@store');
Route::post('transaksi', 'Api\CustomerTransaksiController@store');
Route::get('transaksi/customer/{id}', 'Api\CustomerTransaksiController@history');
Route::get('transaksi/customer/midtrans/{id}', 'Api\PaymentController@history');
Route::get('chekout/user/{id}', 'Api\TransaksiController@history');
Route::get('transaksi/customer/midtransdetail/{id}', 'Api\PaymentController@detail');
// Route::get('chekout/customer/{id}', 'Api\TransaksiController@history');
Route::post('chekout/batal/{id}', 'Api\TransaksiController@batal');
Route::post('/charge', 'Api\MidtransController@test');
Route::post('payment', 'Api\PaymentController@store');

// Route::post('/charge', 'Api\PaymentController@charge');

// Route::post('push', 'Api\TransaksiController@Notif');
