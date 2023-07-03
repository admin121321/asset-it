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
use App\Models\RakServerPengguna;

class RakServerPenggunaController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RakServerPengguna::join('rak_server', 'rak_server.id', '=' ,'rak_server_pengguna.rak_id')
                                    ->join('server_device', 'server_device.id', '=' ,'rak_server_pengguna.server_id')
                                    ->select('rak_server_pengguna.*', 'rak_server.brand_rak', 'rak_server.kode_rak', 'rak_server.type_rak',
                                    'server_device.sn_server','server_device.type_server', 'server_device.model_server', 'server_device.brand_server',) 
                                    ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('server_id', function($data){
                    return $data->sn_server;
                })

                ->addColumn('server_id', function($data){
                    return $data->brand_server;
                })

                ->addColumn('server_id', function($data){
                    return $data->model_server;
                })

                ->addColumn('rak_id', function($data){
                    return $data->brand_rak;
                })

                ->addColumn('rak_id', function($data){
                    return $data->kode_rak;
                })
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Ubah</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Hapus</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="detailButton btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i>Detail</button>';
                    return $button;
                })
                ->make(true);
        }

        return view('rak-server-pengguna.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            'server_id'     =>  'required',
            'rak_id'        =>  'required',
            'penggunaan_u'  =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{

            RakServerPengguna::create($request->all());
            $form_data = RakServer::findOrFail($request->rak_id);
            $form_data->sisa_u -= $request->penggunaan_u;
            $form_data->save();

            return response()->json(['success' => 'Data Added successfully.']);
        }
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = RakServerPengguna::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, RakServerPengguna $rak_server_pengguna)
    {
        $rules = array(
            'server_id'     =>  'required',
            'rak_id'        =>  'required',
            'penggunaan_u'  =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = RakServerPengguna::find($request->hidden_id);
        $form_data = [
            'server_id'     =>  $request->server_id,
            'rak_id'        =>  $request->rak_id,
            'penggunaan_u'  =>  $request->penggunaan_u,
        ];
 
        RakServerPengguna::whereId($request->hidden_id)->update($form_data);
 
        return response()->json([
            'success' => 'Data is successfully updated',
            
        ]);
    }

    public function destroy($id)
    {
        RakServerPengguna::where('id',$id)->delete();
		return redirect()->back();
        
    }

    public function detail($id)
    {

        if (request()->ajax()) 
        {
            $data = RakServerPengguna::join('rak_server', 'rak_server.id', '=' ,'rak_server_pengguna.rak_id')
                                    ->join('server_device', 'server_device.id', '=' ,'rak_server_pengguna.server_id')
                                    ->select('rak_server_pengguna.*', 'rak_server.brand_rak', 'rak_server.kode_rak', 'rak_server.type_rak',
                                    'server_device.sn_server','server_device.type_server', 'server_device.model_server', 'server_device.brand_server',)  
                                    ->findOrFail($id);
            return response()->json($data);
        }

    }
}

# Created by Sudiman Syah Widodo 2023
