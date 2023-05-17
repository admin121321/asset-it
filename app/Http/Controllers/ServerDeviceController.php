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
use App\Models\ServerDevice;
use App\Models\ServerSpek;

class ServerDeviceController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ServerDevice::leftjoin('server_spek', 'server_device.id', '=' ,'server_spek.server_id',)
                                ->select('server_device.*', 'server_spek.server_id',  'server_spek.ram_server',
                                'server_spek.hardisk_server','server_spek.processor_server','server_spek.core_server',
                                'server_spek.subdomain_server','server_spek.port_akses_server','server_spek.ip_address_server',
                                'server_spek.ip_management_server','server_spek.deskripsi_server',) 
                                ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('server_spek.server_id', function($data){
                    return $data->ip_management_server;
                })
                ->addColumn('server_spek.server_id', function($data){
                    return $data->ip_address_server;
                })
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Ubah</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Hapus</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="detailButton btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i>Detail</button>';
                    return $button;
                })
                ->make(true);
        }
        return view('server-device.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            // 'id'            =>  'required',
            'user_id'   =>  'required',
            'printer_id'=>  'required',
            'qty'       =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{

            ServerDevice::create($request->all());
            // $form_data = PrinterDevice::findOrFail($request->printer_id);
            // $form_data->stok -= $request->qty;
            // $form_data->save();
           

            return response()->json(['success' => 'Data Added successfully.']);
        }
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = ServerDevice::leftjoin('server_spek', 'server_device.id', '=' ,'server_spek.server_id',)
                                ->select('server_device.*', 'server_spek.server_id',  'server_spek.ram_server',
                                'server_spek.hardisk_server','server_spek.processor_server','server_spek.core_server',
                                'server_spek.subdomain_server','server_spek.port_akses_server','server_spek.ip_address_server',
                                'server_spek.ip_management_server','server_spek.deskripsi_server',)
                                ->findOrFail($id);
            // $data = ServerDevice::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, ServerDevice $server_device)
    {
        $rules = array(
            'user_id'   =>  'required',
            // 'printer_id'=>  'required',
            'qty'       =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $server_device = ServerDevice::find($request->hidden_id);
            if($server_device->qty='1'){
                $server_device->update([
                    'user_id'   =>  $request->user_id,
                    // 'printer_id'=>  $request->printer_id,
                ]);
            }
            else{    
                $server_device->update($request->all());
                $form_data = ServerDevice::findOrFail($request->printer_id);
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

        if (request()->ajax()) 
        {
            $data = ServerDevice::leftjoin('server_spek', 'server_device.id', '=' ,'server_spek.server_id',)
                                ->select('server_device.*', 'server_spek.server_id',  'server_spek.ram_server',
                                'server_spek.hardisk_server','server_spek.processor_server','server_spek.core_server',
                                'server_spek.subdomain_server','server_spek.port_akses_server','server_spek.ip_address_server',
                                'server_spek.ip_management_server','server_spek.deskripsi_server',) 
                                ->findOrFail($id);
            // $data = PrinterPengguna::findOrFail($id);
            return response()->json($data);
        }

    }

    public function destroy($id)
    {
        // hapus file
        PrinterPengguna::where('id',$id)->delete();
		return redirect()->back();
        
    }
}
