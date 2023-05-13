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
use App\Models\LisensiSoftwarePengguna;

class LisensiSoftwarePenggunaController extends Controller
{
    public function index(Request $request)
     {
        if ($request->ajax()) {
            $data = LisensiSoftwarePengguna::join('desktop_device', 'desktop_device.id', '=', 'lisensi_pengguna.desktop_id')
                                    ->join('lisensi_software', 'lisensi_software.id', '=', 'lisensi_pengguna.lisensi_id')
                                    ->select('lisensi_pengguna.*', 'lisensi_software.brand_lisensi', 'lisensi_software.model_lisensi') 
                                    ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('desktop_id', function($data){
                    return $data->brand_desktop;
                })
                ->addColumn('lisensi_id', function($data){
                    return $data->model_lisensi;
                })
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Ubah</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Hapus</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="detailButton btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i>Detail</button>';
                    return $button;
                })
                ->make(true);
        }
        // $data = LisensiSoftwarePengguna::get();
        // dd ($data);
        // $data = LisensiSoftwarePengguna::join('desktop_device', 'desktop_device.id', '=', 'lisensi_pengguna.desktop_id')
        //                             ->join('lisensi_software', 'lisensi_software.id', '=', 'lisensi_pengguna.lisensi_id')
        //                             ->select('lisensi_pengguna.*', 'lisensi_software.brand_lisensi', 'lisensi_software.model_lisensi') 
        //                             ->get();
        return view('lisensi-software-pengguna.index');
     }
}
