<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RakServer;

class RakServerController extends Controller
{
    //
    public function index()
    {
        return view('rak-server.index');
    }
}
