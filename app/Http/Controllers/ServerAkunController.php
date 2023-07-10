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
use App\Models\ServerDevice;
use App\Models\ServerSpek;
use App\Models\ServerAkun;

class ServerAkunController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ServerAkun::join('server_device', 'server_device.id', '=' ,'server_akun.server_id',)
                                ->select('server_akun.*', 'server_device.sn_server', 'server_device.model_server', 'server_device.type_server') 
                                ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('server_id', function($data){
                    return $data->sn_server;
                })
                ->addColumn('server_id', function($data){
                    return $data->model_server;
                })
                ->addColumn('server_id', function($data){
                    return $data->type_server;
                })
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Ubah</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Hapus</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="detailButton btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i>Detail</button>';
                    return $button;
                })
                ->make(true);
        }
        return view('server-akun.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            // 'id'            =>  'required',
            'server_id'            =>  'required',
            'akun_server'          =>  'required',
            'password_server'      =>  'required',
            'tujuan_akses_server'  =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{

            $form_data = $request->all();
            ServerAkun::create($form_data);
           

            return response()->json(['success' => 'Data Added successfully.']);
        }
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = ServerAkun::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, ServerAkun $server_akun)
    {
        $rules = array(
            'server_id'            =>  'required',
            'akun_server'          =>  'required',
            'password_server'      =>  'required',
            'tujuan_akses_server'  =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = ServerAkun::find($request->hidden_id);
        $form_data = [
            'server_id'           =>  $request->server_id,
            'akun_server'         =>  $request->akun_server,
            'password_server'     =>  $request->password_server,
            'tujuan_akses_server' =>  $request->tujuan_akses_server,
            ];
 
            ServerAkun::whereId($request->hidden_id)->update($form_data);
 
        return response()->json([
            'success' => 'Data Berhasil di Update',
            
        ]);
    }

    public function detail($id)
    {

        if (request()->ajax()) 
        {
            $data = ServerAkun::join('server_device', 'server_device.id', '=' ,'server_akun.server_id',)
                                ->select('server_akun.*', 'server_device.sn_server', 'server_device.model_server', 'server_device.type_server') 
                                ->findOrFail($id);
            return response()->json($data);
        }

    }

    public function destroy($id)
    {
        // hapus file
        ServerAkun::where('id',$id)->delete();
		return redirect()->back();
        
    }

    public function pdf()
    {
        $data = ServerAkun::join('server_device', 'server_device.id', '=' ,'server_akun.server_id',)
                                ->select('server_akun.*', 'server_device.sn_server', 'server_device.model_server', 'server_device.type_server') 
                                ->get();
        // $customPaper = array(0,0,2300,1500);
        // $pdf = PDF::loadview('server-akun.server-akun-pdf', ['data'=>$data])->setPaper($customPaper);
        $pdf = PDF::loadview('server-akun.server-akun-pdf', ['data'=>$data])->setPaper('f4', 'landscape');
        // ->setPaper([0, 0, 685.98, 396.85], 'landscape')
    	return $pdf->download('list_server_akun_device.pdf');
 
        // return view('users.users-pdf');
    }
}

# Created by Sudiman Syah Widodo 2023
