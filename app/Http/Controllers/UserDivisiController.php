<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDivisi;

class UserDivisiController extends Controller
{
    //
    public function index()
    {
        return view('users-divisi.index');
    }
}
