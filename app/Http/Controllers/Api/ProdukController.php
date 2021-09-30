<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produk;

class ProdukController extends Controller
{
    public function index(){
        $produk = Produk::all();
        return response()->json(
            [
                'success' => true,
                'message' => 'Get Produk Berhasil',
                'data' => $produk
            ]
            );
    }

    public function getId($id){
        $data = Produk::where('category_id',$id)->get();
        if (count($data)>0) {
            $res['success']  = true;
            $res['message'] = "get category berhasil";
            $res['data'] = $data;
            return response($res);
        } else {
            $res['message'] = "Failed!";
            return response($res);
        }
    }
}
