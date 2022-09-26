<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\TransaksiCustomer;
use Pusher\Pusher;
use Illuminate\Support\Facades\Crypt;
use DB;

class TransactionController extends Controller
{
    public function __construct(){
        // $this->middleware('role:superadministrator');
    }
    public function index(Request $request){
        $current_date = date('Y-m-d');
        // $transaksiPending['listpending'] = TransaksiCustomer::whereStatus('MENUNGGU')->get();

        // $transaksiPending['listpending'] = TransaksiCustomer::whereStatus('MENUNGGU')->whereDate('date',$current_date)->get();
        // if($request->start_date && $request->end_date){
        //     $transaksiPending = TransaksiCustomer::whereBetween('date', [$request->start_date, $request->end_date])->whereStatus('MENUNGGU')->orderBy('date','DESC')->get();
        // }
        // $transaksiPendingNow['listPendingNow'] = TransaksiCustomer::where('date',$current_date)->get();
        // $transaksiSelesai['listDone'] = TransaksiCustomer::where("status", "NOT LIKE", "%MENUNGGU%")->get();
        $data = TransaksiCustomer::whereStatus('MENUNGGU')->where('date',$current_date)-> get();
        if($request->start_date && $request->end_date){
            $data = TransaksiCustomer::whereBetween('date', [$request->start_date, $request->end_date])->whereStatus('MENUNGGU')->orderBy('date','DESC')->get();
        }

        $transaksiSelesai = TransaksiCustomer::where("status", "NOT LIKE", "%MENUNGGU%")->whereDate('date',$current_date)->get();
        if($request->start_date1 && $request->end_date1){
            $transaksiSelesai = TransaksiCustomer::whereBetween('date', [$request->start_date1, $request->end_date1])->where("status", "NOT LIKE", "%MENUNGGU%")->orderBy('date','DESC')->get();
        }
        return view('transaction',compact('data','transaksiSelesai'));
    }
    public function confirm($id){
        $decodeID = Crypt::decrypt($id);
        $transaksi = TransaksiCustomer::with(['details.produk','user'])->where('id', $decodeID)->first();
        $transaksi->update([
            'status' => "DIKIRIM",
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
            'status' => "BATAL",
            'pesanan' => "Oder Cancel"
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
    public function detail($id){
        $decodeID = Crypt::decryptString($id);
        $dt = TransaksiCustomer::find($decodeID);
        $tittle = "$dt->id";
        $name = "$dt->name";
        return view ('detailpesanan', compact('dt','tittle','name'));
    }
    public function detailpesananselesai($id){
        $decodeID = Crypt::decryptString($id);
        $dt = TransaksiCustomer::find($decodeID);
        $tittle = "$dt->id";
        $name = "$dt->name";
        return view ('detailpesananselesai', compact('dt','tittle','name'));
    }
    public function detailtransactionScan(Request $request){
        $kode = $request->kode_unik;
        $dt = TransaksiCustomer::with(['details.produk','user'])->where('kode_unik', $kode)->first();
        if ($dt == null) {
            return redirect()->back();
        };
        $tittle = "$dt->id";
        $name = "$dt->name";
        return view ('detailtransaction', compact('dt','tittle','name'));
    }
}
