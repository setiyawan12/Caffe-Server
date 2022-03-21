<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransaksiCustomer;
use App\Customer;
class OrderPelayanController extends Controller
{
    public function index(){
        $oderPending['orderPending'] = TransaksiCustomer::wherePesanan("Waiting Order")->get();
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
        $transaksi = TransaksiCustomer::with(['details.produk','user'])->where('id', $id)->first();
        $transaksi->update([
            'pesanan' => "Order Completed",
            'status' =>"DIKIRIM"
        ]);
        return redirect('orderpelayan');
    }
}
