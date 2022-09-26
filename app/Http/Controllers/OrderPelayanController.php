<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransaksiCustomer;
use App\Customer;
use Pusher\Pusher;
class OrderPelayanController extends Controller
{
    public function index(){
        $oderPending['orderPending'] = TransaksiCustomer::where('status',"MENUNGGU")->orWhere('status',"PROSES")->orderBy('created_at','DESC')->get();
        // $oderPending['orderPending'] = TransaksiCustomer::all();
        $customer['customer'] = TransaksiCustomer::all();
        return view('orderpelayan')->with($customer)->with($oderPending);
    }
    public function detail(){
        return view ('detailpesanan');
    }
    public function detailpesanan($id){
        $dt = TransaksiCustomer::find($id);
        $tittle = "$dt->id";
        $name = "$dt->name";
        return view ('detailpesananpelayan', compact('dt','tittle','name'));
    }
    public function kirim($id){
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
                    'message' =>'Hi Admin',
                    'tittle'=>'New Order...'
                );
                $pusher->trigger('pelayan-channel', 'App\\Events\\Pelayan', $data);
        $transaksi = TransaksiCustomer::with(['details.produk','user'])->where('id', $id)->first();
        $transaksi->update([
            'pesanan' => "Order Completed",
            'status' =>"DIKIRIM"
        ]);
        return redirect('orderpelayan');
    }

    public function confirm($id){
        $transaksi = TransaksiCustomer::with(['details.produk','user'])->where('id', $id)->first();
        $transaksi->update([
            'status' => "PROSES",
            'pesanan' => "Oder Proses"
        ]);
        return redirect('orderpelayan');
    }
    public function cancel($id){
        $transaksi = TransaksiCustomer::with(['details.produk','user'])->where('id', $id)->first();
        $transaksi->update([
            'status' => "BATAL",
            'pesanan' => "Oder Cancel"
        ]);
        return redirect('orderpelayan');
        }
}
