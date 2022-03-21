<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Customer;

class CustomerController extends Controller
{
    public function index(Request $request){
        $validasi = Validator::make($request->all(),[
            'name' => 'required'
        ]);
        if($validasi->fails()){
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }
        $customer = Customer::create($request->all());
        if ($customer) {
            return response()->json([
                'success' =>200,
                'message'=>'Cutomer terdaftar',
                'data' => $customer
            ]);
        }
    }
    public function success($data, $message = "success") {
        return response()->json([
            'code' => 200,
            'message' => $message,
            'data' => $data
        ]);
    }
    public function error($message) {
        return response()->json([
            'code' => 400,
            'message' => $message
        ], 400);

    }
}
