<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NetworkLokasi;

class NetworkLokasiController extends Controller
{
    //
    public function index()
    {
        return view('network-lokasi.index');
    }
}
