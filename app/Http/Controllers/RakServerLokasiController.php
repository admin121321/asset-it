<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RakServerLokasi;

class RakServerLokasiController extends Controller
{
    //
    public function index()
    {
        return view('rak-server-lokasi.index');
    }
}
