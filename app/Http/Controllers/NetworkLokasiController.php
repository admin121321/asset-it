<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Validator;
use Auth;
use File;
use DB;
use App\Models\NetworkDevice;
use App\Models\NetworkLokasi;

class NetworkLokasiController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = NetworkLokasi::join('network_device', 'network_device.id', '=', 'network_lokasi.network_id')
                                ->select('network_lokasi.*', 'network_device.brand_network',  'network_device.model_network', 'network_device.sn_network', 'network_device.type_network', 'network_device.port_network') 
                                ->get();
                return Datatables::of($data)->addIndexColumn()
                        ->addColumn('network_id', function($data){
                            return $data->brand_network;
                        })
                        ->addColumn('network_id', function($data){
                            return $data->model_network;
                        })
                        ->addColumn('network_id', function($data){
                            return $data->sn_network;
                        })
                        ->addColumn('network_id', function($data){
                            return $data->type_network;
                        })
                        ->addColumn('network_id', function($data){
                            return $data->port_network;
                        })
                        ->addColumn('action', function($data){
                            $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Ubah</button>';
                            $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Hapus</button>';
                            $button .= '<button type="button" name="edit" id="'.$data->id.'" class="detailButton btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i>Detail</button>';
                            return $button;
                        })
                        ->make(true);
        }
        // $data = PrinterDevice::get();
        // dd ($data);
        $data = NetworkLokasi::join('network_device', 'network_device.id', '=', 'network_lokasi.network_id')
                                ->select('network_lokasi.*', 'network_device.brand_network',  'network_device.model_network', 'network_device.sn_network', 'network_device.type_network') 
                                ->get();
        return view('network-lokasi.index', compact('data'));
    }

    public function store(Request $request)
    {
        $rules = array(
            // 'id'            =>  'required',
            'network_id' =>  'required',
            'lokasi'     =>  'required',
            'qty'        =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{

            NetworkLokasi::create($request->all());
            $form_data = NetworkDevice::findOrFail($request->network_id);
            $form_data->sisa_stok -= $request->qty;
            $form_data->save();
           

            return response()->json(['success' => 'Data Added successfully.']);
        }
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = NetworkLokasi::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, NetworkLokasi $network_lokasi)
    {
        $rules = array(
            'network_id' =>  'required',
            'lokasi'     =>  'required',
            'qty'        =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $network_lokasi = NetworkLokasi::find($request->hidden_id);
            if($network_lokasi->qty='1'){
                $network_lokasi->update([
                    'user_id'   =>  $request->network_id,
                    // 'printer_id'=>  $request->printer_id,
                ]);
            }
            else{    
                $network_lokasi->update($request->all());
                $form_data = NetworkDevice::findOrFail($request->network_id);
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
            // $data = NetworkLokasi::findOrFail($id);
            $data = NetworkLokasi::join('network_device', 'network_device.id', '=', 'network_lokasi.network_id')
                                ->select('network_lokasi.*', 'network_device.brand_network',  'network_device.model_network', 'network_device.sn_network', 'network_device.type_network', 'network_device.port_network') 
                                ->findOrFail($id);
            return response()->json($data);
        }
        // $data = PrinterPengguna::find($id);
   
        // return response()->json($data);
        
        // $data = PrinterPengguna::get();
        // dd ($data);

    }

    public function destroy($id)
    {
        // hapus file
        NetworkLokasi::where('id',$id)->delete();
		return redirect()->back();
        
    }
}
