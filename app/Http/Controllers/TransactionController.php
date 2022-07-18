<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\TransaksiCustomer;
use Pusher\Pusher;
use Illuminate\Support\Facades\Crypt;

class TransactionController extends Controller
{
    public function __construct(){
        // $this->middleware('role:superadministrator');
    }
    public function index(){

        $transaksiPending['listpending'] = TransaksiCustomer::whereStatus("MENUNGGU")->get();
        $transaksiSelesai['listDone'] = TransaksiCustomer::where("status", "NOT LIKE", "%MENUNGGU%")->get();
        return view('transaction')->with($transaksiPending)->with($transaksiSelesai);
    }
    public function confirm($id){
        $decodeID = Crypt::decrypt($id);
        $transaksi = TransaksiCustomer::with(['details.produk','user'])->where('id', $decodeID)->first();
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
        return redirect('transaction');
    }
    public function cancel($id){
        $decodeID = Crypt::decryptString($id);
        $transaksi = TransaksiCustomer::with(['details.produk','user'])->where('id', $decodeID)->first();
        $transaksi->update([
            'status' => "BATAL"
        ]);
        return redirect('transaction');
    }
    public function kirim($id){
        $decodeID = Crypt::decryptString($id);
        $transaksi = TransaksiCustomer::with(['details.produk','user'])->where('id', $decodeID)->first();
        $transaksi->update([
            'status' => "DIKIRIM",
            'pesanan' => "Order Completed"
        ]);
        return redirect('transaction');
    }

    public function selesai($id){
        $decodeID = Crypt::decryptString($id);
        $transaksi = TransaksiCustomer::with(['details.produk','user'])->where('id', $decodeID)->first();
        $transaksi->update([
            'status' => "SELESAI"
        ]);
        return redirect('transaction');
    }
    public function detailtransaction($id){
        $decodeID = Crypt::decryptString($id);
        $dt = TransaksiCustomer::find($decodeID);
        $tittle = "$dt->id";
        $name = "$dt->name";
        return view ('detailtransaction', compact('dt','tittle','name'));
    }
}
