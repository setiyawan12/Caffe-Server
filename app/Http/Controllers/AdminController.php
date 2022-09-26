<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Customer;
use App\TransaksiCustomer;
use App\Notifications\PesananNotification;
use App\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('role:admin');
    }
    public function index(Request $request){
        
        
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

        $dataChartTransaction = [
            "Jan" => 0,
            "Feb" => 0,
            "Mar" => 0,
            "Apr" => 0,
            "May" => 0,
            "Jun" => 0,
            "Jul" => 0,
            "Aug" => 0,
            "Sep" => 0,
            "Oct" => 0,
            "Nov" => 0,
            "Des" => 0,
        ];


        $chartTransaction = TransaksiCustomer::select(
            \DB::raw('SUM(total_harga) as total'),
            \DB::raw("MONTH(date) as month")
        )
        ->groupBy("month")
        ->whereYear('date',date("Y"))
        ->get();
        // dd($chartTransaction);
        // $chartTransaction = TransaksiCustomer::whereStatus("SELESAI")
        //     ->select(
        //         \DB::raw('SUM(total_harga) as total'),
        //         \DB::raw('MONTH(date) as month')
        //     )
        //     ->groupBy("month")
        //     ->whereYear('date',date("Y"))
        //     ->get();

        // dd($chartTransaction);   

        foreach($chartTransaction as $index => $c){
            $dataChartTransaction[date("M", mktime(0, 0, 0, $c->month, 1))] = (int) $c->total;
        }

        // if(env('APP_ENV') === 'local'){
        //     foreach($chartTransaction as $index => $c){
        //         $dataChartTransaction[date("M", mktime(0, 0, 0, $c->month, 1))] = (int) $c->total;
        //     }
        // }else{
        //     dd("PGSQL");
        // }
        // dd($dataChartTransaction);

        $current_date = date('Y-m-d');
        // $cek = Carbon::now()->format('Y-m-d');
        // dd($cek);
        $data = TransaksiCustomer::whereStatus('SELESAI')->where('date',$current_date)-> get();
        // dd($data);

        if($request->start_date && $request->end_date){
            $data = TransaksiCustomer::whereBetween('date', [$request->start_date, $request->end_date])->whereStatus('SELESAI')->orderBy('date','DESC')->get();
        }
        return view('admin.dashboard',compact('produk','customer','transaction','food','drink','snack','coffe', 'dataChartTransaction','data'));
    }
    // public function transaction(){
    //     $current_date = date('Y-m-d');
    //     $data = Transaction::where('date', $current_date)-> get();

    //     if($request->start_date && $request->end_date){
    //         $data = TransaksiCustomer::whereBetween('date', [$request->start_date, $request->end_date])->orderBy('date','DESC')->get();
    //     }
    //     return view('admin.dashboard',compact('data'));
    // }

    public function notify(){
        if(auth()->user()){
            $user = User::first();
            auth()->user()->notify(new PesananNotification($user));
        }
    }
}
