<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MidtransTransaction;
use App\Customer;
use Pusher\Pusher;
use Illuminate\Support\Facades\Crypt;
use Firmantr3\Midtrans\Facade\Midtrans;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Midtrans\ApiRequestor;
use App\Http\Controllers\Midtrans\SnapApiRequestor;
use App\Http\Controllers\Midtrans\Notification;
use App\Http\Controllers\Midtrans\CoreApi;
use App\Http\Controllers\Midtrans\Snap;
class OrderPelayanMidtransController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer['customer'] = MidtransTransaction::all();
        $orderPending['orderPending'] = MidtransTransaction::wherePesanan("Waiting Order")->get();
        return view('orderpelayanmidtrans')->with($customer)->with($orderPending);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailpesananmidtrans($id){
        $dt = MidtransTransaction::find($id);
        $tittle = "$dt->id";
        $name = "$dt->name";
        $order_id = "$dt->order_id";
        $midtrans = Midtrans::status($order_id);
        $va_numbers = $midtrans->va_numbers[0];
        return view ('detailpesananmidtrans', compact('dt','tittle','name','midtrans','va_numbers'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
