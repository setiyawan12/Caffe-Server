<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meja;
use SimpleSoftwareIO\QrCode\Generator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Storage;
use Cloudinary;
use Carbon\Carbon;
use File;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Meja::all();
        return view('meja',compact('data'));
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
        $this->validate($request,[
            'no_meja' => 'required|unique:mejas'
        ]);
        // dd($data);
        $qrcode = new Generator;
        $json = json_encode([
            "meja"=>$request->no_meja
        ]);
        $qr =$qrcode->format('png')
        ->merge(public_path('img/vietnam.png'), 0.1, true)
        ->size(200)
        ->errorCorrection('H')
        ->generate($json);
        $output = '/qrcode/img.png';
        $hasil = Storage::disk('local')->put($output,$qr);
        $getQr = public_path('/qrcode/img.png');
        $uploadedFileUrl = cloudinary()->uploadFile($getQr)->getSecurePath();
        $data = Meja::create(array_merge($request->all(),[
            'id' => $request->no_meja,
            'status' => "Tidak Aktif",
            'qr'=> $uploadedFileUrl
        ]));
        if(File::exists($getQr)) {
            File::delete($getQr);
        }
        return redirect('table');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Meja::find($id);
        return response()->json([
            'status' => 200,
            'data' =>$data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Meja::find($id);
        return response()->json([
            'status' => 200,
            'data' =>$data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAktif(Request $request, $id)
    {
        $meja = Meja::find($id);
        
        $meja->update([
            'status' => 'Aktif'
        ]);
        return redirect('table');

    }

    public function updateNonAktif(Request $request, $id)
    {
        $meja = Meja::find($id);
        $meja->update([
            'status' => 'Tidak Aktif'
        ]);
        return redirect('table');
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

    public function addMeja(){
        return view ('tambahmeja');
    }

    public function add(Request $request){
        $this->validate($request,[
            'no_meja' => 'required|unique:mejas'
        ]);
        $qrcode = new Generator;
        $json = json_encode([
            "meja"=>$request->no_meja
        ]);
        $qr =$qrcode->format('png')
        ->merge(public_path('img/vietnam.png'), 0.1, true)
        ->size(200)
        ->errorCorrection('H')
        ->generate($json);
        $output = '/qrcode/img.png';
        $hasil = Storage::disk('local')->put($output,$qr);
        $getQr = public_path('/qrcode/img.png');
        $uploadedFileUrl = cloudinary()->uploadFile($getQr)->getSecurePath();
        $data = Meja::create(array_merge($request->all(),[
            'id' => $request->no_meja,
            'status' => "Tidak Aktif",
            'qr'=> $uploadedFileUrl
        ]));
        if(File::exists($getQr)) {
            File::delete($getQr);
        }

        return redirect('table');
    }
}
