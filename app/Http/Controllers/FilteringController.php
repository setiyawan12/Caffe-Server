<?php

namespace App\Http\Controllers;
use App\TransaksiCustomer;
use Illuminate\Http\Request;

class FilteringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $formDate = "2023-07-23";
        // $toDate ="2023-07-23";

        // $data = TransaksiCustomer::select()
        // ->where('date','>=',$formDate)
        // ->where('date','<=',$toDate)
        // ->get();

        $current_date = date('Y-m-d');

        $data = TransaksiCustomer::where('date', $current_date)->get();

        if($request->start_date && $request->end_date){
            $data = TransaksiCustomer::whereBetween('date', [$request->start_date, $request->end_date])->orderBy('date','DESC')->get();
        }
        // dd($data);
        // $result=array($data);
        // dd($result);
        return view('filter',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
