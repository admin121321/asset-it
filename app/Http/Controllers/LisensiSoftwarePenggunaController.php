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
use App\Models\LisensiSoftware;

class LisensiSoftwarePenggunaController extends Controller
{
    public function index(Request $request)
     {
        if ($request->ajax()) {
            $data = LisensiSoftwarePengguna::join('desktop_device', 'desktop_device.id', '=', 'lisensi_pengguna.desktop_id')
                                    ->join('lisensi_software', 'lisensi_software.id', '=', 'lisensi_pengguna.lisensi_id')
                                    ->select('lisensi_pengguna.*', 'lisensi_software.brand_lisensi',  'desktop_device.brand_desktop', 'lisensi_software.model_lisensi', 'desktop_device.sn_desktop', 'desktop_device.type_desktop') 
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
        $data = LisensiSoftwarePengguna::join('desktop_device', 'desktop_device.id', '=', 'lisensi_pengguna.desktop_id')
                                    ->join('lisensi_software', 'lisensi_software.id', '=', 'lisensi_pengguna.lisensi_id')
                                    ->select('lisensi_pengguna.*', 'lisensi_software.brand_lisensi', 'lisensi_software.model_lisensi', 'desktop_device.sn_desktop', 'desktop_device.type_desktop') 
                                    ->get();
        return view('lisensi-software-pengguna.index');
     }

     public function store(Request $request)
    {
        $rules = array(
            // 'id'            =>  'required',
            'desktop_id'   =>  'required',
            'lisensi_id'=>  'required',
            // 'qty'       =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{

            LisensiSoftwarePengguna::create($request->all());
            $form_data = LisensiSoftware::findOrFail($request->lisensi_id);
            $form_data->sisa_stok -= $request->qty;
            $form_data->save();
           

            return response()->json(['success' => 'Data Added successfully.']);
        }
    }
    
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = LisensiSoftwarePengguna::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, LisensiSoftwarePengguna $lisensi_software_pengguna)
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
        $lisensi_software_pengguna = LisensiSoftwarePengguna::find($request->hidden_id);
            if($lisensi_software_pengguna->qty='1'){
                $lisensi_software_pengguna->update([
                    'desktop_id'   =>  $request->desktop_id,
                    // 'printer_id'=>  $request->printer_id,
                ]);
            }
            else{    
                $lisensi_software_pengguna->update($request->all());
                $form_data = LisensiSoftware::findOrFail($request->lisensi_id);
                $form_data->stok -= $request->qty;
            }

        // $form_data = PrinterPengguna::find($request->hidden_id);
        // $form_data = [
        //     'user_id'   =>  $request->user_id,
        //     'printer_id'=>  $request->printer_id,
        //     'qty'       =>  $request->qty,
        //     ];
 
        // PrinterPengguna::whereId($request->hidden_id)->update($form_data);
 
        return response()->json([
            'success' => 'Data Berhasil di Update',
            
        ]);
    }

    public function detail($id)
    {
        if(request()->ajax())
        {
            // $data = LisensiSoftwarePengguna::findOrFail($id);
            $data = LisensiSoftwarePengguna::join('desktop_device', 'desktop_device.id', '=', 'lisensi_pengguna.desktop_id')
                                            ->join('lisensi_software', 'lisensi_software.id', '=', 'lisensi_pengguna.lisensi_id')
                                            ->select('lisensi_pengguna.*', 'lisensi_software.brand_lisensi', 'lisensi_software.type_lisensi', 'lisensi_software.sn_lisensi',
                                                     'desktop_device.brand_desktop', 'desktop_device.sn_desktop', 'desktop_device.type_desktop') 
                                            ->findOrFail($id);
            return response()->json($data);
        }
    }

    public function destroy($id)
    {
        // hapus file
        LisensiSoftwarePengguna::where('id',$id)->delete();
		return redirect()->back();
        
    }
}
