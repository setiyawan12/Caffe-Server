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
        // dd($request->image);

        $fileName = Carbon::now()->format('Y-m-d H:i:s').'-'.$request->name;
        $uploadedFile = $request->file('image')->storeOnCloudinaryAs('MyProduk',$fileName);
        $image = $uploadedFile->getSecurePath();
        $public_id = $uploadedFile->getPublicId();
        // dd($image);

        $rules = [
            'name' => 'required'
        ];
        $message = [
            'required' => 'not empty'
        ];

        $this->validate($request, $rules, $message);

        $user = Produk::create(array_merge($request->all(), [
             'stock' => preg_replace('/^0+/','', $request->stock),
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
    public function edit($id){
        $produk = Produk::find($id);
        return response()->json([
            'status' => 200,
            'data' =>$produk,
        ]);
    }

    public function update(Request $request,$id){
        $produk = Produk::findOrFail($id);
        if (isset($request->image)) {
            Cloudinary::destroy($produk->public_id);
            $fileName = Carbon::now()->format('Y-m-d H:i:s').'-'.$request->name;
            $uploadedFile = $request->image->storeOnCloudinaryAs('MyProduk',$fileName);
            $image = $uploadedFile->getSecurePath();
            $public_id = $uploadedFile->getPublicId();
        }
        
        $produk->update([
            'name' =>$request->name,
            'harga'=>$request->harga,
            'stock'=>preg_replace('/^0+/','', $request->stock),
            'image' => $request->image ? $image:$produk->image,
            'public_id' => $request->image ? $public_id:$produk->public_id
        ]);
        return redirect('product');
    }

    private function _validation(Request $request){
        $validation = $request->validate([
         'name.required'=>"Harus Di isi",   
        ]);
    }
}
