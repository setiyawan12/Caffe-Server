<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelayanController extends Controller
{
    public function __construct(){
        $this->middleware('role:pelayan');
    }
    public function index(){
        return view ('pelayan.index');
    }
}
