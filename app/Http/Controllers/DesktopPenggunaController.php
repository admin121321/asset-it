<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DesktopPengguna;

class DesktopPenggunaController extends Controller
{
     //
     public function index()
     {
         return view('desktop-pengguna.index');
     }
}
