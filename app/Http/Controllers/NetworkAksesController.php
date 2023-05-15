<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NetworkAkses;

class NetworkAksesController extends Controller
{
    //
     public function index()
    {
        return view('network-akses.index');
    }
}
