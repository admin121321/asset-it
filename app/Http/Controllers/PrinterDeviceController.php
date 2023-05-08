<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\PrinterDevice;

class PrinterDeviceController extends Controller
{
    //
    public function index()
    {
        return view('printer-device.index');
    }
}
