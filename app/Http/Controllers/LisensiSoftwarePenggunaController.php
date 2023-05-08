<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LisensiSoftwarePengguna;

class LisensiSoftwarePenggunaController extends Controller
{
    public function index()
     {
         return view('lisensi-software-pengguna.index');
     }
}
