<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrinterPengguna;

class PrinterPenggunaController extends Controller
{
    //
    public function index()
    {
        return view('printer-pengguna.index');
    }
}
