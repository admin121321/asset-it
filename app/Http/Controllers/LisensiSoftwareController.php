<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LisensiSoftware;

class LisensiSoftwareController extends Controller
{
    public function index()
     {
         return view('lisensi-software.index');
     }
}
