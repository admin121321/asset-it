<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NetworkDevice;

class NetworkDeviceController extends Controller
{
    //
    public function index()
    {
        return view('network-device.index');
    }
}
