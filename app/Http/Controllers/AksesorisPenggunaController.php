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
use PDF;
use App\Models\AksesorisDevice;
use App\Models\AksesorisPengguna;

class AksesorisPenggunaController extends Controller
{
    //
    public function index(Request $request)
     {
        if ($request->ajax()) {
            $data = AksesorisPengguna::join('desktop_device', 'desktop_device.id', '=', 'aksesoris_pengguna.desktop_id')
                                    ->join('aksesoris_device', 'aksesoris_device.id', '=', 'aksesoris_pengguna.aksesoris_id')
                                    ->select('aksesoris_pengguna.*', 'aksesoris_device.brand_aksesoris', 'aksesoris_device.model_aksesoris', 'aksesoris_device.type_aksesoris','desktop_device.brand_desktop') 
                                    ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('desktop_id', function($data){
                    return $data->brand_desktop;
                })
                ->addColumn('aksesoris_id', function($data){
                    return $data->model_aksesoris;
                })
                ->addColumn('aksesoris_id', function($data){
                    return $data->type_aksesoris;
                })
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Ubah</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Hapus</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="detailButton btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i>Detail</button>';
                    return $button;
                })
                ->make(true);
        }
        // $data = AksesorisPengguna::get();
        // dd ($data);
        return view('aksesoris-pengguna.index');
     }
    
     public function store(Request $request)
    {
        $rules = array(
            // 'id'            =>  'required',
            'desktop_id'   =>  'required',
            'aksesoris_id'=>  'required',
            // 'qty'       =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{

            AksesorisPengguna::create($request->all());
            $form_data = AksesorisDevice::findOrFail($request->aksesoris_id);
            $form_data->sisa_stok -= $request->qty;
            $form_data->save();
           

            return response()->json(['success' => 'Data Added successfully.']);
        }
    }
    
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = AksesorisPengguna::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }
    
    public function update(Request $request, AksesorisPengguna $aksesoris_pengguna)
    {
        $rules = array(
            'desktop_id'   =>  'required',
            // 'lisensi_id'=>  'required',
            // 'qty'       =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $aksesoris_pengguna = AksesorisPengguna::find($request->hidden_id);
            if($aksesoris_pengguna->qty='1'){
                $aksesoris_pengguna->update([
                    'desktop_id'   =>  $request->desktop_id,
                    // 'printer_id'=>  $request->printer_id,
                ]);
            }
            else{    
                $aksesoris_pengguna->update($request->all());
                $form_data = AksesorisDevice::findOrFail($request->aksesoris_id);
                $form_data->sisa_stok -= $request->qty;
            }
 
        return response()->json([
            'success' => 'Data Berhasil di Update',
            
        ]);
    }

    public function detail($id)
    {
        if(request()->ajax())
        {
            // $data = AksesorisPengguna::findOrFail($id);
            $data = AksesorisPengguna::join('desktop_device', 'desktop_device.id', '=', 'aksesoris_pengguna.desktop_id')
                                    ->join('aksesoris_device', 'aksesoris_device.id', '=', 'aksesoris_pengguna.aksesoris_id')
                                    ->select('aksesoris_pengguna.*', 'aksesoris_device.brand_aksesoris', 'aksesoris_device.model_aksesoris', 'aksesoris_device.type_aksesoris',
                                             'aksesoris_device.sn_aksesoris', 'desktop_device.brand_desktop','desktop_device.type_desktop', 'desktop_device.sn_desktop', ) 
                                    ->findOrFail($id);
            return response()->json($data);
        }
    }

    public function destroy($id)
    {
        // hapus file
        AksesorisPengguna::where('id',$id)->delete();
		return redirect()->back();
        
    }

    public function pdf()
    {
        $data = AksesorisPengguna::join('desktop_device', 'desktop_device.id', '=', 'aksesoris_pengguna.desktop_id')
                                ->join('aksesoris_device', 'aksesoris_device.id', '=', 'aksesoris_pengguna.aksesoris_id')
                                ->select('aksesoris_pengguna.*', 'aksesoris_device.sn_aksesoris','aksesoris_device.brand_aksesoris', 'aksesoris_device.model_aksesoris', 'aksesoris_device.type_aksesoris',
                                'desktop_device.brand_desktop','desktop_device.sn_desktop','desktop_device.model_desktop','desktop_device.type_desktop') 
                                ->get();
        $pdf = PDF::loadview('aksesoris-pengguna.aksesoris-pengguna-pdf', ['data'=>$data])->setPaper('F4', 'landscape');
        // ->setPaper([0, 0, 685.98, 396.85], 'landscape')
    	return $pdf->download('list_aksesoris_pengguna.pdf');
 
        // return view('users.users-pdf');
    }
}

# Created by Sudiman Syah Widodo