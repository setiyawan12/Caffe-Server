<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Generator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Storage;
use Cloudinary;
use Carbon\Carbon;
use File;


class QrGeneratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $qrcode = new Generator;
        $req = 7;
        $json = json_encode([
            "meja"=>$req,
        ]);

        // dd($json);
        // dd($no);

        $qr =$qrcode->format('png')
        ->merge(public_path('img/vietnam.png'), 0.1, true)
        ->size(500)
        ->errorCorrection('H')
        ->generate($json);
        $output = '/qrcode/img.png';
        $hasil = Storage::disk('local')->put($output,$qr);

        $getQr = public_path('/qrcode/img.png');

        $fileName = Carbon::now()->format('Y-m-d H:i:s').'-';
        $uploadedFileUrl = cloudinary()->uploadFile($getQr)->getSecurePath();

        
        if(File::exists($getQr)) {
            File::delete($getQr);
        }
        // Storage::delete();

        // $data = public_path('qrcode/img1.png');


        // if(File::exists($data)) {
        //     File::delete($data);
        // }
        // dd($data);
        // dd($uploadedFileUrl);
        // $cek = Storage::disk('local')->delete(public_path('qrcode/img1.png'));
        // dd($cek);
        // Storage::delete($data);

        // $uploadedFileUrl = Cloudinary::upload(file($data)->getRealPath())->getSecurePath();
        // $qrcode = new Generator;

        // $qr =$qrcode->format('png')
        // ->merge(public_path('img/vietnam.png'), 0.1, true)
        // ->size(500)
        // ->errorCorrection('H')
        // ->generate('TOLDEM');
        // $output = '/qrcode/img.png';
        // dd($output);
        // $hasil = Storage::disk('local')->put($output,$qr);

        // $fileName = Carbon::now()->format('Y-m-d H:i:s').'-'.$request->name;
        // $uploadedFile = $request->file(public_path('qrcode/img.png'))->storeOnCloudinaryAs('MyProduk',$fileName);
        // $image = $uploadedFile->getSecurePath();

        // dd($image);
        // dd(hasil);
        // $hasil = $qr->store('img/qrcode');
        // dd();
        // dd($result);
        // $qr =QrCode::generate('Make me into a QrCode!');
        // $qr->file->storeOnCloudinaryAs('MyProduk');
        // dd($qr);
        // return view('qr-generator',[
        //     'qr' => $qr
        // ]);
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
