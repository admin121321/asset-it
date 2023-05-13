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

class AksesorisDeviceController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = AksesorisDevice::latest()->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                    $button .= '   <button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                    return $button;
                })
                ->make(true);
        }
        // $data = AksesorisDevice::get();
        // dd ($data);
        return view('aksesoris-device.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            // 'id'            =>  'required',
            'sn_aksesoris'      =>  'required',
            'brand_aksesoris'   =>  'required',
            'model_aksesoris'   =>  'required',
            'type_aksesoris'    =>  'required',
            'garansi_aksesoris' =>  'required',
            'tahun_anggaran'    =>  'required',
            'harga_aksesoris'   =>  'required',
            'stok'              =>  'required',
            'foto_aksesoris'    =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{

            // $form_data = $request->all();
            $form_data = [
                'id'                =>  $request->sn_aksesoris,
                'sn_aksesoris'      =>  $request->sn_aksesoris,
                'brand_aksesoris'   =>  $request->brand_aksesoris,
                'model_aksesoris'   =>  $request->model_aksesoris,
                'type_aksesoris'    =>  $request->type_aksesoris,
                'garansi_aksesoris' =>  $request->garansi_aksesoris,
                'tahun_anggaran'    =>  $request->tahun_anggaran,
                'harga_aksesoris'   =>  $request->harga_aksesoris,
                'stok'              =>  $request->stok,
                ];
            $form_data['foto_aksesoris'] = date('YmdHis').'.'.$request->foto_aksesoris->getClientOriginalExtension();
            $request->foto_aksesoris->move(public_path('images-aksesoris'), $form_data['foto_aksesoris']);

            AksesorisDevice::create($form_data);
            return response()->json(['success' => 'Data Added successfully.']);
        }
    }
}
