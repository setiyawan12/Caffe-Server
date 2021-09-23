<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function test (Request $request){
        \Midtrans\Config::$serverKey = 'SB-Mid-server-LSeo2BQ6SlGjLT4h3wyk9G6A';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $billing_address = array(
            'first_name'   => "Andri",
            'last_name'    => "Setiawan",
            'address'      => "Karet Belakang 15A, Setiabudi.",
            'city'         => "Jakarta",
            'postal_code'  => "51161",
            'phone'        => "081322311801",
            'country_code' => 'IDN'
          );
        
        // Populate customer's shipping address
        $shipping_address = array(
            'first_name'   => "yayangku",
            'last_name'    => "setiyawan",
            'address'      => "Bakerstreet 221B.",
            'city'         => "Jakarta",
            'postal_code'  => "51162",
            'phone'        => "081322311801",
            'country_code' => 'IDN'
          );
        
        // Populate customer's info
        $customer_details = array(
          "first_name"  => "TEST",
          "last_name" => "MIDTRANSER",
          "email" => "noreply@example.com",
          "phone" => "+628123456",
          "address" =>"Tegal"
            // 'billing_address'  => $billing_address,
            // 'shipping_address' => $shipping_address
          );
        $params = array(
            'transaction_details' => $request->transaction_details,
            'item_details' => $request->item_details,
            'customer_details'=>$customer_details,
            'shipping_address'=>$shipping_address,
            'billing_address'=>$billing_address

        );

        try {
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

          return response()->json([
            "token" => $snapToken,
            "redirect_url" => $paymentUrl
            
        ]);
        } catch (\Throwable $th) {

          return response()->json([
            "message" => $th->getMessage(),
          ]);
          //throw $th;
        }
      
        // return response()->json($params);
    }
}