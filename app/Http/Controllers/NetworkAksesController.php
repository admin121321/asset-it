<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Validator;
use Auth;
use File;
use DB;
use PDF;
use App\Models\NetworkAkses;
use App\Models\NetworkDevice;
use App\Models\PrinterPengguna;

class NetworkAksesController extends Controller
{
    //
     public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = NetworkAkses::join('network_device', 'network_device.id', '=', 'network_akses.network_id')
                                    ->select('network_akses.*', 'network_device.brand_network',  'network_device.model_network', 'network_device.sn_network', 'network_device.type_network') 
                                    ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('network_id', function($data){
                    return $data->brand_network;
                })
                ->addColumn('network_id', function($data){
                    return $data->sn_network;
                })
                ->addColumn('network_id', function($data){
                    return $data->type_network;
                })
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Ubah</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Hapus</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="detailButton btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i>Detail</button>';
                    return $button;
                })
                ->make(true);
        } 
        // $data = NetworkDevice::get();
        // dd ($data);
        return view('network-akses.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            // 'id'            =>  'required',
            'network_id'       =>  'required',
            'ip_akses'         =>  'required',
            'akun_akses'       =>  'required',
            'password_akses'   =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{

            NetworkAkses::create($request->all());

            return response()->json(['success' => 'Data Added successfully.']);
        }
    }

    public function detail($id)
    {

        if (request()->ajax()) 
        {
            // $data = NetworkAkses::findOrFail($id);
            $data = NetworkAkses::join('network_device', 'network_device.id', '=', 'network_akses.network_id')
                                ->select('network_akses.*', 'network_device.brand_network',  'network_device.model_network', 'network_device.sn_network', 'network_device.type_network') 
                                ->get();
            return response()->json(['result' => $data]);
        }

    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = NetworkAkses::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, NetworkAkses $network_akses)
    {
        $rules = array(
            'network_id'       =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = NetworkAkses::find($request->hidden_id);
        $form_data = [
            'network_id'     =>  $request->network_id,
            'ip_akses'       =>  $request->ip_akses,
            'akun_akses'     =>  $request->akun_akses,
            'password_akses' =>  $request->password_akses,
        ];
 
        NetworkAkses::whereId($request->hidden_id)->update($form_data);
 
        return response()->json([
            'success' => 'Data is successfully updated',
            
        ]);
    }

    public function destroy($id)
    {
        // hapus file
        NetworkAkses::where('id',$id)->delete();
		return redirect()->back();
        
    }

}


# Created by Sudiman Syah Widodo