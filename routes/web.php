<?php
use Illuminate\Http\Request;
use App\Events\MessageCreated;
use App\Http\Controllers\PusherNotificationController;


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


Auth::routes();
Route::resource('/','HandleLoginController');
Route::resource('/example','ExampleController');
Route::get('/status','ExampleController@order');

Route::get('/uilogin','ExampleController@uiLogin');


Route::group(['middleware' =>['auth','role:superadministrator']], function(){
    Route::resource('/admin', 'AdminController');
    Route::resource('/transaction', 'TransactionController');
    Route::get('/transaction/confim/{id}', 'TransactionController@confirm')->name('transaksiConfirm');
    Route::get('/transaction/cancle/{id}', 'TransactionController@cancel')->name('transaksiCancle');
    Route::get('/transaction/kirim/{id}', 'TransactionController@kirim')->name('transaksiKirim');
    Route::get('/transaction/selesai/{id}', 'TransactionController@selesai')->name('transaksiSelesai');
    Route::get('/transaction/detail/{id}', 'TransactionController@detailtransaction')->name('transaksiDetail'); 

    Route::resource('/order', 'PemesananController');
    Route::get('/pesanan','PemesananController@index');
    Route::get('/pesanan/{id}', 'PemesananController@detailpesanan');
    Route::get('/pesanan/kirim/{id}', 'PemesananController@kirim')->name('pesananKirim');


    Route::resource('/product', 'ProductController');

});
Route::group(['middleware' =>['auth','role:user']],function(){
    Route::resource('/pelayan', 'PelayanController');
    Route::resource('/orderpelayan','OrderPelayanController');
    Route::get('/pesanancustomer/{id}', 'OrderPelayanController@detailpesanan');
    Route::get('/pesanancustomer/kirim/{id}', 'OrderPelayanController@kirim')->name('pesanancustomerkirim');
});
