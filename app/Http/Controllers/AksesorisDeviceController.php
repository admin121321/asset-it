<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AksesorisDevice;

class AksesorisDeviceController extends Controller
{
    //
    public function index()
    {
        return view('aksesoris-device.index');
    }
}
