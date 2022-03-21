<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiCustomer extends Model
{
    protected $fillable = ['customer_id', 'kode_payment',
    'kode_trx', 'total_item', 'total_harga', 'kode_unik',
    'status', 'meja', 'name', 'pesanan',
    'deskripsi', 'expired_at'];
    public function details()
    {
        return $this->hasMany(TransaksiCustomerDetail::class, "transaksi_id", "id");
    }
    public function user(){
        return $this->belongsTo(Customer::class,"customer_id","id");
    }
}
