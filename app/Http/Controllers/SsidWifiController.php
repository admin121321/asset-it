<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SsidWifi;

class SsidWifiController extends Controller
{
    //
    public function index()
    {
        return view('ssid-wifi.index');
    }
}
