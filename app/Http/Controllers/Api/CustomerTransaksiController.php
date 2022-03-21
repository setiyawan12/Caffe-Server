<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\TransaksiCustomer;
use App\TransaksiCustomerDetail;
use Pusher\Pusher;

class CustomerTransaksiController extends Controller
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
                    'message' =>'setiyawan',
                    'tittle'=>'Pesanan Baru'
                );
                $pusher->trigger('android-channel', 'App\\Events\\Android', $data);
        $validasi = Validator::make($request->all(),[
            'customer_id' => 'required',
            'total_item' => 'required',
            'total_harga'=>'required',
            'name'=>'required',
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
        $transaksi = TransaksiCustomer::create($dataTransaksi);
        foreach($request -> produks as $produk){
            $detail = [
                'transaksi_id' => $transaksi->id,
                'produk_id' => $produk ['id'],
                'total_item' => $produk['total_item'],
                'catatan' => $produk['catatan'],
                'total_harga' => $produk['total_harga']
            ];
            $transaksiDetail = TransaksiCustomerDetail::create($detail);
        }
        if (!empty($transaksi) && !empty($transaksiDetail)) {
            \DB::commit();
            return response()->json([
                'success' => 1,
                'message' => 'Transaksi Berhasil',
                'transaksi' => collect($transaksi)
            ]);
        } else {
            \DB::rollback();
            return $this->error('Transaksigagal');
        }  
    }

    public function history($id){
        $transaksis = TransaksiCustomer::with(['user'])->whereHas('user', function ($query) use ($id){
            $query -> whereId($id);
        })->orderBy("id","desc")->get();

        foreach ($transaksis as $transaksi) {
            $details = $transaksi->details;
            foreach ($details as $detail) {
                $detail->produk;
            }
        }
        if (!empty($transaksis)) {
            return response()->json([
                'success' => 1,
                'message' => 'Transaksi Berhasil',
                'transaksis' => collect($transaksis)
            ]);
        } else {
            $this->error('Transaksi gagal');
        }
    }

    public function error($pesan) {
        return response()->json([
            'success' => 0,
            'message' => $pesan
        ]);
    }
}
