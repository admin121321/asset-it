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
            // Server Data
            'sn_server'      =>  'required',
            'brand_server'   =>  'required',
            'model_server'   =>  'required',
            'type_server'    =>  'required',
            'garansi_server' =>  'required',
            'support_server' =>  'required',
            'tahun_anggaran' =>  'required',
            'harga_server'   =>  'required',
            'stok'           =>  'required',
            'foto_server'    =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Server Spek
            'server_id'            =>  'required',
            'ram_server'           =>  'required',
            'hardisk_server'       =>  'required',
            'processor_server'     =>  'required',
            'core_server'          =>  'required',
            'subdomain_server'     =>  'required',
            'port_akses_server'    =>  'required',
            'ip_address_server'    =>  'required',
            'ip_management_server' =>  'required',
            'deskripsi_server'     =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{

            $form_data = [
                'sn_server'      =>  $request->sn_server,
                'brand_server'   =>  $request->brand_server,
                'model_server'   =>  $request->model_server,
                'type_server'    =>  $request->type_server,
                'garansi_server' =>  $request->garansi_server,
                'support_server' =>  $request->support_server,
                'tahun_anggaran' =>  $request->tahun_anggaran,
                'harga_server'   =>  $request->harga_server,
                'stok'           =>  $request->stok,
                ];
            $form_data['foto_server'] = date('YmdHis').'.'.$request->foto_server->getClientOriginalExtension();
            $request->foto_server->move(public_path('images-server'), $form_data['foto_server']);

            // ServerDevice::create($form_data);

            // ServerSpek::create($request->all());
            // $server_device=ServerDevice::findOrFail(request('server_device'));
            $spek_data = [
                'server_id'           =>  ServerDevice::create($form_data)->id,
                'ram_server'          =>  $request->ram_server,
                'hardisk_server'      =>  $request->hardisk_server,
                'processor_server'    =>  $request->processor_server,
                'core_server'         =>  $request->core_server,
                'subdomain_server'    =>  $request->subdomain_server,
                'port_akses_server'   =>  $request->port_akses_server,
                'ip_address_server'   =>  $request->ip_address_server,
                'ip_management_server'=>  $request->ip_management_server,
                'deskripsi_server'    =>  $request->deskripsi_server,
                ];
            ServerSpek::create($spek_data);
           

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
            'sn_server'      =>  'required',
            'brand_server'   =>  'required',
            'model_server'   =>  'required',
            'type_server'    =>  'required',
            'garansi_server' =>  'required',
            'support_server' =>  'required',
            'tahun_anggaran' =>  'required',
            'harga_server'   =>  'required',
            'stok'           =>  'required',
            // 'foto_server'    =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Server Spek
            // 'server_id'            =>  'required',
            'ram_server'           =>  'required',
            'hardisk_server'       =>  'required',
            'processor_server'     =>  'required',
            'core_server'          =>  'required',
            'subdomain_server'     =>  'required',
            'port_akses_server'    =>  'required',
            'ip_address_server'    =>  'required',
            'ip_management_server' =>  'required',
            'deskripsi_server'     =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        // Update Server Device
        $form_data = ServerDevice::find($request->hidden_id);
        $fileName  = public_path('images-server/').$form_data->foto_server;
        $currentImage = $server_device->foto_server;
        
        if ($request->foto_server != $currentImage) {
            $file = $request->file('foto_server');
            $fileName_new = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images-server/'), $fileName_new);
            $serverImage = public_path('images-server/').$currentImage;
            $form_data = [
                    'sn_server'      =>  $request->sn_server,
                    'brand_server'   =>  $request->brand_server,
                    'model_server'   =>  $request->model_server,
                    'type_server'    =>  $request->type_server,
                    'garansi_server' =>  $request->garansi_server,
                    'support_server' =>  $request->support_server,
                    'tahun_anggaran' =>  $request->tahun_anggaran,
                    'harga_server'   =>  $request->harga_server,
                    'stok'           =>  $request->stok,
                    'foto_server'    =>  $fileName_new,
            ];
            File::delete($fileName);

            if(file_exists($serverImage)){
                
                // File::delete($fileName);
                @unlink($serverImage);
                
            }

        } else {
            $form_data = [
                    'sn_server'      =>  $request->sn_server,
                    'brand_server'   =>  $request->brand_server,
                    'model_server'   =>  $request->model_server,
                    'type_server'    =>  $request->type_server,
                    'garansi_server' =>  $request->garansi_server,
                    'support_server' =>  $request->support_server,
                    'tahun_anggaran' =>  $request->tahun_anggaran,
                    'harga_server'   =>  $request->harga_server,
                    'stok'           =>  $request->stok,
            ];
        }

        ServerDevice::whereId($request->hidden_id)->update($form_data);
        // Update Server Spek
        $spek_data = ServerSpek::find($request->hidden_id);
        $spek_data = [
            'server_id'           =>  $request->server_id,
            'ram_server'          =>  $request->ram_server,
            'hardisk_server'      =>  $request->hardisk_server,
            'processor_server'    =>  $request->processor_server,
            'core_server'         =>  $request->core_server,
            'subdomain_server'    =>  $request->subdomain_server,
            'port_akses_server'   =>  $request->port_akses_server,
            'ip_address_server'   =>  $request->ip_address_server,
            'ip_management_server'=>  $request->ip_management_server,
            'deskripsi_server'    =>  $request->deskripsi_server,
            ];
        ServerSpek::whereId($request->hidden_id)->update($spek_data);
 
        return response()->json([
            'success' => 'Data is successfully updated',
            
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
        // hapus file
		$data = ServerDevice::where('id',$id)->first();
		File::delete('images-server/'.$data->foto_server);

        ServerDevice::where('id',$id)->delete();
		return redirect()->back();

        ServerSpek::where('id',$id)->delete();
		return redirect()->back();
        
    }
}
