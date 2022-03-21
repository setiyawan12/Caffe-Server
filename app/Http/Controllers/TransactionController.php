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
        $this->pushNotif("Proses","Confrim Pesanan");
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
            'status' => "DIKIRIM"
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

    public function pushNotif($title,$message){
        $token = "eDpYPAVT0Lc:APA91bFk-4VUNRJqukS5gOYfwo9Peju5LxQ4vRH1S2YvoZrIaBM7e379zw2CmFKe1G1bSY0NtThP3XxoeNZvS02aax1he2HdTi_2d4eqHbx0kAV7ytiGIS7ReqkLl9UTQ25L0aXIrQ_d";  
        $from = "ci5CMRliL40:APA91bEE8LZ_aFGl_2TWm3gCUGMx5vr1KzXmq5rMr0j3kI1IMIvMUr3d6X4N1xeWxkbX1cOeG_n0cx94jV3DjMu65dNsrqRGjMM_N7_jVTC2Slc_aPkaH7WrV9Qa_hBGwQFrxSmdyuIf";
        $msg =
              [
                'body'  => $title,
                'title' => $message,
                'receiver' => 'erw',
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
            ];

        $fields =
                [
                    'to'        => $token,
                    'notification'  => $msg
                ];

        $headers =
                [
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                ];
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        // dd($result);
        curl_close( $ch );
    }
}
