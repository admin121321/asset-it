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
use App\Models\User;
use App\Models\DesktopDevice;
use App\Models\DesktopPengguna;

class DesktopPenggunaController extends Controller
{

     public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DesktopPengguna::join('users', 'users.id', '=' ,'desktop_pengguna.user_id')
                                    ->join('desktop_device', 'desktop_device.id', '=', 'desktop_pengguna.desktop_id')
                                    ->select('desktop_pengguna.*', 'users.name', 'desktop_device.brand_desktop', 'desktop_device.model_desktop',
                                            'desktop_device.sn_desktop','desktop_device.type_desktop') 
                                    ->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('user_id', function($data){
            return $data->name;
            })
            ->addColumn('desktop_id', function($data){
            return $data->brand_desktop;
            })
            ->addColumn('desktop_id', function($data){
            return $data->model_desktop;
            })
            ->addColumn('action', function($data){
            $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Ubah</button>';
            $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Hapus</button>';
            $button .= '<button type="button" name="edit" id="'.$data->id.'" class="detailButton btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i>Detail</button>';
            return $button;
            })
            ->make(true);
        
        
            }
        // $data = DesktopPengguna::get();
        // dd ($data);
        return view('desktop-pengguna.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            // 'id'                =>  'required',
            'user_id'           =>  'required',
            'desktop_id'        =>  'required',
            'qty'               =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{

            DesktopPengguna::create($request->all());
            $form_data = DesktopDevice::findOrFail($request->desktop_id);
            $form_data->sisa_stok -= $request->qty;
            $form_data->save();
            return response()->json(['success' => 'Data Added successfully.']);
        }
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = DesktopPengguna::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, DesktopPengguna $desktop_pengguna)
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
        $desktop_pengguna = DesktopPengguna::find($request->hidden_id);
            if($desktop_pengguna->qty='1'){
                $desktop_pengguna->update([
                    'desktop_id'   =>  $request->desktop_id,
                    // 'printer_id'=>  $request->printer_id,
                ]);
            }
            else{    
                $desktop_pengguna->update($request->all());
                $form_data = DesktopDevice::findOrFail($request->desktop_id);
                $form_data->sisa_stok -= $request->qty;
            }
 
        return response()->json([
            'success' => 'Data Berhasil di Update',
            
        ]);
    }

    public function detail($id)
    {

        if (request()->ajax()) 
        {
            // $data = DesktopPengguna::findOrFail($id);
            $data = DesktopPengguna::join('users', 'users.id', '=' ,'desktop_pengguna.user_id')
                                    ->join('desktop_device', 'desktop_device.id', '=', 'desktop_pengguna.desktop_id')
                                    ->select('desktop_pengguna.*', 'users.name', 'users.card_id', 'desktop_device.brand_desktop', 'desktop_device.sn_desktop', 'desktop_device.model_desktop', 'desktop_device.type_desktop', 'desktop_device.foto_desktop') 
                                    ->findOrFail($id);
            return response()->json($data);
        }

    }

    public function destroy($id)
    {
        // hapus file
        DesktopPengguna::where('id',$id)->delete();
		return redirect()->back();
        
    }
}
