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


Route::group(['middleware' =>['auth','role:admin']], function(){
    Route::resource('/admin', 'AdminController');
    Route::get('/notify','AdminController@notify');
    Route::resource('/transaction', 'TransactionController');
    Route::get('/transaction/confim/{id}', 'TransactionController@confirm')->name('transaksiConfirm');
    Route::get('/transaction/cancle/{id}', 'TransactionController@cancel')->name('transaksiCancle');
    Route::get('/transaction/kirim/{id}', 'TransactionController@kirim')->name('transaksiKirim');
    Route::get('/transaction/selesai/{id}', 'TransactionController@selesai')->name('transaksiSelesai');
    Route::get('/transaction/detail/{id}', 'TransactionController@detailtransaction')->name('transaksiDetail');
    
    Route::resource('/midtrans', 'MidtransTransactionController');
    Route::get('/midtrans/confim/{id}', 'MidtransTransactionController@confirm')->name('midtransConfirm');
    Route::get('/midtrans/cancle/{id}', 'MidtransTransactionController@cancle')->name('midtransCancle');
    Route::get('/midtrans/detail/{id}', 'MidtransTransactionController@detailtransaction')->name('midtransDetail');
    Route::get('/midtrans/kirim/{id}', 'MidtransTransactionController@kirim')->name('midtransKirim');
    Route::get('/midtrans/selesai/{id}', 'MidtransTransactionController@selesai')->name('midtransSelesai');

    Route::resource('/order', 'PemesananController');
    Route::get('/pesanan','PemesananController@index');
    Route::get('/pesanan/{id}', 'PemesananController@detailpesanan');
    Route::get('/pesanan/kirim/{id}', 'PemesananController@kirim')->name('pesananKirim');
    Route::resource('/product', 'ProductController');

});
Route::group(['middleware' =>['auth','role:pelayan']],function(){
    Route::resource('/pelayan', 'PelayanController');
    Route::resource('/orderpelayan','OrderPelayanController');
    Route::get('/pesanancustomer/{id}', 'OrderPelayanController@detailpesanan');
    Route::get('/pesanancustomer/kirim/{id}', 'OrderPelayanController@kirim')->name('pesanancustomerkirim');
});

// Route::get('/midtrans','ExampleController@order');
