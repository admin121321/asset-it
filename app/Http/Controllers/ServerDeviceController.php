<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServerDevice;

class ServerDeviceController extends Controller
{
    //
    public function index()
    {
        return view('server-device.index');
    }
}
