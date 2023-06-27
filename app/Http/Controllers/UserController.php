<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use DataTables;
use Validator;
use Auth;
use File;
use DB;
use App\Models\User;

class UserController extends Controller
{
    //
    //
    public function index()
    {
        return view('users.index');
    }
}
