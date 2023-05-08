<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServerAkun;

class ServerAkunController extends Controller
{
    //
    public function index()
    {
        return view('server-akun.index');
    }
}
