<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DesktopDevice;

class DesktopDeviceController extends Controller
{
    //
    public function index()
    {
        return view('desktop-device.index');
    }
}
