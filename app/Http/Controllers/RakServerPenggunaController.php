<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RakServerPengguna;

class RakServerPenggunaController extends Controller
{
    //
    public function index()
    {
        return view('rak-server-pengguna.index');
    }
}
