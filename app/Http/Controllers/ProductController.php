<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use Cloudinary;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index(){
        $produk ['produk'] = Produk::all();
        return view ('product')->with($produk);
    }
    public function store(Request $request){
        $fileName = Carbon::now()->format('Y-m-d H:i:s').'-'.$request->name;
        $uploadedFile = $request->file('image')->storeOnCloudinaryAs('MyProduk',$fileName);
        $image = $uploadedFile->getSecurePath();
        $public_id = $uploadedFile->getPublicId();
        $user = Produk::create(array_merge($request->all(), [
             'image' =>$image,
             'public_id'=>$public_id,
        ]));
        return redirect('product');
    }
    public function destroy($id)
    {
        $id = Produk::findOrFail($id);
        Cloudinary::destroy($id->public_id);
        $id->delete();
        return redirect()->route('product.index')->with('success', 'Data has been deleted!');
    }
}
