<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Customer;
use App\TransaksiCustomer;
use App\Notifications\PesananNotification;
use App\User;
class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('role:admin');
    }
    public function index(){
        $produk = Produk::all()->count();
        $foodID = 1;
        $food = Produk::where('category_id',$foodID)->count();

        $drinkID = 2;
        $drink = Produk::where('category_id',$drinkID)->count();

        $snackID = 3;
        $snack = Produk::where('category_id',$snackID)->count();

        $coffeID = 4;
        $coffe = Produk::where('category_id',$coffeID)->count();

        $customer = Customer::all()->count();
        $transaction = TransaksiCustomer::all()->count();
        return view('admin.dashboard',compact('produk','customer','transaction','food','drink','snack','coffe'));
    }

    public function notify(){
        if(auth()->user()){
            $user = User::first();
            auth()->user()->notify(new PesananNotification($user));
        }
    }
}
