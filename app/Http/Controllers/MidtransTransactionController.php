<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\MidtransTransaction;
use Pusher\Pusher;
use Illuminate\Support\Facades\Crypt;
use Firmantr3\Midtrans\Facade\Midtrans;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Midtrans\ApiRequestor;
use App\Http\Controllers\Midtrans\SnapApiRequestor;
use App\Http\Controllers\Midtrans\Notification;
use App\Http\Controllers\Midtrans\CoreApi;
use App\Http\Controllers\Midtrans\Snap;

use App\Http\Controllers\Midtrans\Config;

class MidtransTransactionController extends Controller
{   
 public function index(){
    $transaksiPending['listpending'] = MidtransTransaction::whereStatus("MENUNGGU")->get();
    $transaksiSelesai['listDone'] = MidtransTransaction::where("status", "NOT LIKE", "%MENUNGGU%")->get();
    return view('transactionmidtrans')->with($transaksiPending)->with($transaksiSelesai);
 }

 public function confirm($id){
    $decodeID = Crypt::decrypt($id);
    $transaksi = MidtransTransaction::with(['details.produk','user'])->where('id', $decodeID)->first();
    $transaksi->update([
        'status' => "PROSES",
        'pesanan'=> "Waiting Order"
    ]);
    $options = array(
        'cluster' => env('PUSHER_APP_CLUSTER'),
        'encrypted' => true
        );
           $pusher = new Pusher(
                   env('PUSHER_APP_KEY'),
                   env('PUSHER_APP_SECRET'),
                   env('PUSHER_APP_ID'),
           $options);
            $data = array(
                'message' =>'setiyawan',
                'tittle'=>'Pesanan Baru'
            );
            $pusher->trigger('notify-channel', 'App\\Events\\Notify', $data);
    return redirect('midtrans'); 
 }
 public function cancle($id){
    $decodeID = Crypt::decryptString($id);
    $transaksi = MidtransTransaction::with(['details.produk','user'])->where('id', $decodeID)->first();
    $transaksi->update([
        'status' => "BATAL"
    ]);
    return redirect('midtrans');
}
public function detailtransaction($id){
    $decodeID = Crypt::decryptString($id);
    $dt = MidtransTransaction::find($decodeID);
    $tittle = "$dt->id";
    $name = "$dt->name";
    $order_id = "$dt->order_id";
    $midtrans = Midtrans::status($order_id);
    $va_numbers = $midtrans->va_numbers[0];
    dump($midtrans);
    return view ('midtransdetail', compact('dt','tittle','name','midtrans','va_numbers'));
}

public function kirim($id){
    $decodeID = Crypt::decryptString($id);
    $transaksi = MidtransTransaction::with(['details.produk','user'])->where('id', $decodeID)->first();
    $transaksi->update([
        'status' => "DIKIRIM"
    ]);
    return redirect('midtrans');
}
public function selesai($id){
    $decodeID = Crypt::decryptString($id);
    $transaksi = MidtransTransaction::with(['details.produk','user'])->where('id', $decodeID)->first();
    $transaksi->update([
        'status' => "SELESAI"
    ]);
    return redirect('midtrans');
}
}
