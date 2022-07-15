<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\MidtransTransaction;
use App\MidtransTransactionDetail;
use App\TransaksiCustomer;
use App\TransaksiCustomerDetail;
use Firmantr3\Midtrans\Facade\Midtrans;
use App\Produk;
use Pusher\Pusher;


use App\Http\Controllers\Midtrans\Config;

// Midtrans API Resources
use App\Http\Controllers\Midtrans\Transaction;

// Plumbing
use App\Http\Controllers\Midtrans\ApiRequestor;
use App\Http\Controllers\Midtrans\SnapApiRequestor;
use App\Http\Controllers\Midtrans\Notification;
use App\Http\Controllers\Midtrans\CoreApi;
use App\Http\Controllers\Midtrans\Snap;
class PaymentController extends Controller
{
    public function store (Request $request){
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
                $pusher->trigger('midtrans-channel', 'App\\Events\\AndroidMidtrans', $data);
        $validasi = Validator::make($request->all(),[
            'customer_id' => 'required',
            'total_item' => 'required',
            'total_harga'=>'required',
            'name'=>'required',
            'order_id'=>'required',
            'meja'=>'required'
        ]);

        if ($validasi->fails()) {
            $hasil = $validasi->errors()->all();
            return $this->error($hasil[0]);
        }

        $kode_payment = "INV/PYM/" . now()->format('Y-m-d') . "/" . rand(100, 999);
        $kode_trx = "INV/PYM/" . now()->format('Y-m-d') . "/" . rand(100, 999);
        $kode_unik = rand(100, 999);
        $status = "MENUNGGU";
        $expired_at = now()->addDay();
        $pesanan = "Order";

        $dataTransaksi = array_merge($request->all(),[
            'kode_payment' => $kode_payment,
            'kode_trx' => $kode_trx,
            'kode_unik' => $kode_unik,
            'status' => $status,
            'pesanan' => $pesanan,
            'expired_at' => $expired_at
        ]);
        \DB::beginTransaction();
        $transaksi = MidtransTransaction::create($dataTransaksi);
        foreach($request -> produks as $produk){
            $detail = [
                'transaksi_id' => $transaksi->id,
                'produk_id' => $produk ['id'],
                'total_item' => $produk['total_item'],
                'catatan' => $produk['catatan'],
                'total_harga' => $produk['total_harga']
            ];
            $transaksiDetail = MidtransTransactionDetail::create($detail);
            $product = Produk::where('id', $produk['id'])->first();
            $newStock = $product->stock - $produk['total_item'];
            $product->update([
                'stock' => $newStock
            ]);
        }
        if (!empty($transaksi) && !empty($transaksiDetail)) {
            \DB::commit();
            return response()->json([
                'success' => 1,
                'message' => 'Transaksi Berhasil',
                'transaksi' => collect($transaksi),
                // 'item_details'=>collect($transaksiDetail)
            ]);
        } else {
            \DB::rollback();
            return $this->error('Transaksigagal');
        }
        
    }
    public function history($id){
        $transaksis = MidtransTransaction::with(['user'])->whereHas('user', function ($query) use ($id){
            $query -> whereId($id);
        })->orderBy("id","desc")->get();
        $check = MidtransTransaction::with(['user'])->whereHas('user', function ($query) use ($id){
            $query -> whereId($id);
        })->orderBy("id","desc")->get()->count();

        foreach ($transaksis as $transaksi) {
            $details = $transaksi->details;
            foreach ($details as $detail) {
                $detail->produk;
            }
        }
        if ($check > 0) {
            return response()->json([
                'success' => 200,
                'message' => 'Get History',
                'transaksis' => collect($transaksis)
            ]);
            } else {
                return response()->json([
                    'success' => 0,
                    'message' => 'kosong',
                ]);
        }
    }

    public function detail($id){
        $status = Midtrans::status($id);
        return response()->json([
            "success"=> 1,
            "data"=>$status
        ]);
    }
    public function error($pesan) {
        return response()->json([
            'success' => 0,
            'message' => $pesan
        ]);
    }
}
