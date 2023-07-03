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
use App\Models\RakServer;
use App\Models\RakServerLokasi;

class RakServerLokasiController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RakServerLokasi::join('rak_server', 'rak_server.id', '=' ,'rak_server_lokasi.rak_id')
                                    ->select('rak_server_lokasi.*', 'rak_server.brand_rak', 'rak_server.kode_rak',) 
                                    ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('rak_id', function($data){
                    return $data->brand_rak;
                })
                ->addColumn('rak_id', function($data){
                    return $data->kode_rak;
                })
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Ubah</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Hapus</button>';
                    // $button .= '<button type="button" name="edit" id="'.$data->id.'" class="detailButton btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i>Detail</button>';
                    return $button;
                })
                ->make(true);
        }
        return view('rak-server-lokasi.index');
    }
    public function store(Request $request)
    {
        $rules = array(
            // 'id'            =>  'required',
            'rak_id'           =>  'required',
            'nama_lokasi_rak'  =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{

            RakServerLokasi::create($request->all());

            return response()->json(['success' => 'Data Added successfully.']);
        }
    }
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = RakServerLokasi::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, RakServerLokasi $rak_server_lokasi)
    {
        $rules = array(
            'rak_id'           =>  'required',
            'nama_lokasi_rak'  =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = RakServerLokasi::find($request->hidden_id);
        $form_data = [
            'rak_id'             =>  $request->rak_id,
            'nama_lokasi_rak'    =>  $request->nama_lokasi_rak,
        ];
 
        RakServerLokasi::whereId($request->hidden_id)->update($form_data);
 
        return response()->json([
            'success' => 'Data is successfully updated',
            
        ]);
    }

    public function destroy($id)
    {
        RakServerLokasi::where('id',$id)->delete();
		return redirect()->back();
        
    }
}

# Created by Sudiman Syah Widodo 2023
