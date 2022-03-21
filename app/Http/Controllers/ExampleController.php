<?php

namespace App\Http\Controllers;
use Firmantr3\Midtrans\Facade\Midtrans;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\MidtransTransaction;
use App\Http\Controllers\Midtrans\ApiRequestor;
use App\Http\Controllers\Midtrans\SnapApiRequestor;
use App\Http\Controllers\Midtrans\Notification;
use App\Http\Controllers\Midtrans\CoreApi;
use App\Http\Controllers\Midtrans\Snap;

use App\Http\Controllers\Midtrans\Config;

// Midtrans API Resources
use App\Http\Controllers\Midtrans\Transaction;

class ExampleController extends Controller
{
    public function index(){
        $client = new Client();
        $conf = Config::$serverKey = 'SB-Mid-server-LSeo2BQ6SlGjLT4h3wyk9G6A';
        $config =  base64_encode($conf);
        // dump($config);
        // $getArray = "TRX-1645460872966";
        // $headers =[
        //     "Authorization" => "Basic `$config` :",
        //     'content-type' => 'application/json',
        //     'Accept' => 'application/json',
                // ];
        $response = $client->request('GET',"https://api.sandbox.midtrans.com/v2/TRX-1645460872966/status",[
            "headers" => [
            "Authorization" => "Basic `$config` :",
            'content-type' => 'application/json',
            'Accept' => 'application/json',
            ]
        ]);
        dd($response);
        // $status =  json_decode(json_encode($response),true);
        // $transaction_status = $status['transaction_status'];

        // return $status;
        // $body = $response->getBody();
        // return $body;
        // return response()->json($body);
        // $data['data'] = json_decode($body);
        // return view('example')->with($data);

        // $decode = json_decode($responseBody);
        // return $decode;
        // dump($decode);
        // $data ['data'] = $decode;
        // dd($responseBody);
        
        // return view ('example')->with($data);
        // return $responseBody;
        // $midtrans = MidtransTransaction::find(27);
        // dump($midtrans);
        // $data = json_decode($midtrans,true);
        // dump ($data);
        // $array = array_values($data);
        // dump($array);
        // $getArray = $array[9];
        // dump($getArray);
        // $value = response()->json($midtrans);
        // $hasil = json_decode($value,true);
        // $get = $hasil["order_id"];
        // dd($get);
        // $data = $hasil->order_id;
        // $client = Http::get('https://jsonplaceholder.typicode.com/todos/')->json();
        // dd($client);
        // $client = new \GuzzleHttp\Client();
//         $users = Http::get('https://jsonplaceholder.typicode.com/users')
//     ->json();
// dd($users);

        // return $midtrans;
    }

    public function get(){
        $midtrans = MidtransTransaction::find(27);
        $data = json_decode($midtrans,true);
        // dump ($data);
        $array = array_values($data);
        // dump($array);
        $getArray = $array[9];
        // dump($getArray);

        Config::$serverKey = 'SB-Mid-server-LSeo2BQ6SlGjLT4h3wyk9G6A';
        if(!isset(Config::$serverKey))
        {
            return "Please set your payment server key";
        }

        Config::$isSanitized = true;
        Config::$is3ds = true;
        $url = "https://api.sandbox.midtrans.com/v2/". $getArray. "/status";
        $client = new Client();
        $response = $client->request('GET',$url,[
            "headers" => [
                "Authorization" => 'Basic ' . base64_encode(Config::$serverKey.':'),
                'content-type' => 'application/json',
                'Accept' => 'application/json',
                ]
            ])->json();
        // $client = Http::withHeaders([
        //         'Authorization' => 'Basic ' . base64_encode(Config::$serverKey.':'),
        //         'Content-Type' => 'application/json',
        //         'Accept' => 'application/json',
        // ])->get($url)->json();
        dd($response);

        // $curl = curl_init("$url");
        // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        //     'Authorization: Basic ' . base64_encode(Config::$serverKey.':'),
        //     'Content-Type: application/json',
        //         'Accept: application/json',
        // ));
        // $response = response()->json(curl_exec($curl));
        // $output = curl_exec($curl);
        // curl_close($curl);
        // $response = curl_exec($curl);
        // return $curl;
        // curl_close($curl);
        // return $response;
        // $payment['payment'] = $output;
        // return view('example')->with($payment);
        // return view ('example');
        // return $res;
    }
    public function status(){

        Config::$serverKey = 'SB-Mid-server-LSeo2BQ6SlGjLT4h3wyk9G6A';
        if(!isset(Config::$serverKey))
        {
            return "Please set your payment server key";
        }

        Config::$isSanitized = true;
        Config::$is3ds = true;
        // $url = "https://api.sandbox.midtrans.com/v2/". $id_order. "/status";
        // $id_order = "https://api.sandbox.midtrans.com/v2/TRX-1645460872966/status";
        // $curl = curl_init("$id_order");
        // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        //     'Authorization: Basic ' . base64_encode(Config::$serverKey.':'),
        //     'Content-Type: application/json',
        //         'Accept: application/json',
        // ));
        // $response = curl_exec($curl);
        // curl_close($curl);
        // $res = response()->json($response);
        $response = Http::withHeaders([
            'Authorization: Basic ' . base64_encode(Config::$serverKey.':'),
            'Content-Type: application/json',
            'Accept: application/json',
        ])->get("https://api.sandbox.midtrans.com/v2/TRX-1645460872966/status");
        dd($response);
    }

    public function order(){
        $orderId = "TRX-1645460872966";
        $status = Midtrans::status($orderId);
        return response()->json([
            "message"=>"success",
            "data"=>$status
        ]);
        // dd($status);
    }

    public function uiLogin(){
        return view('uilogin');
    }
}
