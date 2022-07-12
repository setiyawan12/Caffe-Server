<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransaksiCustomer;
use App\Customer;
use Pusher\Pusher;
use Illuminate\Support\Facades\Crypt;


class PemesananController extends Controller
{
    public function index(){
        $customer['customer'] = TransaksiCustomer::all();
        $orderPending['orderPending'] = TransaksiCustomer::wherePesanan("Waiting Order")->get();
        return view('order')->with($customer)->with($orderPending);
    }
    public function detailpesanan($id){
        $dt = TransaksiCustomer::find($id);
        $tittle = "$dt->id";
        $name = "$dt->name";
        return view ('detailpesanan', compact('dt','tittle','name'));
    }
    public function kirim($id){
        $transaksi = TransaksiCustomer::with(['details.produk','user'])->where('id', $id)->first();
        $transaksi->update([
            'pesanan' => "Order Completed",
            'status' => "DIKIRIM"
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
                    'message' =>'Kasir',
                    'tittle'=>'Pesanan Diantar'
                );
                $pusher->trigger('pesanan', 'App\\Events\\Pesanan', $data);
        return redirect('order');
    }
}
