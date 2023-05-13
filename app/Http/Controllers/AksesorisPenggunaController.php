<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Validator;
use Auth;
use File;
use DB;
use App\Models\AksesorisDevice;
use App\Models\AksesorisPengguna;

class AksesorisPenggunaController extends Controller
{
    //
    public function index()
    {
        return view('aksesoris-pengguna.index');
    }
}
