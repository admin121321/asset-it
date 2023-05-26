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
use App\Models\ServerPenggunaan;

class ServerDeviceController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ServerDevice::leftjoin('server_spek', 'server_device.id', '=' ,'server_spek.id',)
                                ->leftjoin('server_penggunaan', 'server_device.id', '=' ,'server_penggunaan.id',)
                                ->select('server_device.*', 'server_spek.ram_server','server_spek.hardisk_server',
                                'server_spek.processor_server','server_spek.core_server','server_penggunaan.url_server',
                                'server_penggunaan.port_akses_server','server_penggunaan.ip_address_server','server_penggunaan.ip_management_server',
                                'server_penggunaan.hostname_server','server_penggunaan.web_server','server_penggunaan.php_server', 
                                'server_penggunaan.db_server', 'server_penggunaan.application_server','server_penggunaan.deskripsi_server') 
                                ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('server_penggunaan.server_id', function($data){
                    return $data->ip_management_server;
                })
                ->addColumn('server_penggunaan.server_id', function($data){
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
            'sn_server'            =>  'required',
            'brand_server'         =>  'required',
            'model_server'         =>  'required',
            'type_server'          =>  'required',
            'garansi_server'       =>  'required',
            'support_server'       =>  'required',
            'tahun_anggaran'       =>  'required',
            'harga_server'         =>  'required',
            'stok'                 =>  'required',
            'foto_server'          =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Server Spek
            'ram_server'           =>  'required',
            'hardisk_server'       =>  'required',
            'processor_server'     =>  'required',
            'core_server'          =>  'required',
            // Server Pengguaan
            'hostname_server'      =>  'required',
            'url_server'           =>  'required',
            'port_akses_server'    =>  'required',
            'ip_address_server'    =>  'required',
            'ip_management_server' =>  'required',
            'web_server'           =>  'required',
            'php_server'           =>  'required',
            'db_server'            =>  'required',
            'application_server'   =>  'required',
            'deskripsi_server'     =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{
            // Proses Input Server Device
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
            // Variable Untuk Proses Server Device dan input ID ke Server spek dan Penggunaan
            $value_id = ServerDevice::create($form_data)->id;
            
            // Proses Input Server Penggunaan
            $penggunaan_data = [
                'id'                   =>  $value_id,
                // 'server_id'            =>  ServerSpek::create($spek_data)->server_id,
                'hostname_server'      =>  $request->hostname_server,
                'url_server'           =>  $request->url_server,
                'port_akses_server'    =>  $request->port_akses_server,
                'ip_address_server'    =>  $request->ip_address_server,
                'ip_management_server' =>  $request->ip_management_server,
                'web_server'           =>  $request->web_server,
                'php_server'           =>  $request->php_server,
                'db_server'            =>  $request->db_server,
                'application_server'   =>  $request->application_server,
                'deskripsi_server'     =>  $request->deskripsi_server,
                ];
            
            // Proses Input Server Spek
            $spek_data = [
                'id'                  =>  $value_id,
                // 'server_id'           =>  ServerPenggunaan::create($penggunaan_data),
                'ram_server'          =>  $request->ram_server,
                'hardisk_server'      =>  $request->hardisk_server,
                'processor_server'    =>  $request->processor_server,
                'core_server'         =>  $request->core_server,
                ];
                
            // ServerDevice::create($form_data);
            ServerSpek::create($spek_data);
            ServerPenggunaan::create($penggunaan_data);
           

            return response()->json(['success' => 'Data Added successfully.']);
        }
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = ServerDevice::join('server_spek', 'server_spek.id', '=' ,'server_device.id',)
                                ->join('server_penggunaan', 'server_penggunaan.id', '=' ,'server_device.id',)
                                ->select('server_device.*', 'server_spek.ram_server','server_spek.hardisk_server',
                                'server_spek.processor_server','server_spek.core_server','server_penggunaan.url_server',
                                'server_penggunaan.port_akses_server','server_penggunaan.ip_address_server','server_penggunaan.ip_management_server',
                                'server_penggunaan.hostname_server','server_penggunaan.web_server','server_penggunaan.php_server', 
                                'server_penggunaan.db_server', 'server_penggunaan.application_server','server_penggunaan.deskripsi_server') 
                                ->findOrFail($id);
            // $data = ServerDevice::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, ServerDevice $server_device, ServerSpek $server_spek, ServerPenggunaan $server_penggunaan)
    {
        $rules = array(
            // Server Device
            // 'foto_server'    =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sn_server'            =>  'required',
            'brand_server'         =>  'required',
            'model_server'         =>  'required',
            'type_server'          =>  'required',
            'garansi_server'       =>  'required',
            'support_server'       =>  'required',
            'tahun_anggaran'       =>  'required',
            'harga_server'         =>  'required',
            'stok'                 =>  'required',
            
            // Server Spek
            'ram_server'           =>  'required',
            'hardisk_server'       =>  'required',
            'processor_server'     =>  'required',
            'core_server'          =>  'required',
            
            // Server Pengguaan
            'hostname_server'      =>  'required',
            'url_server'           =>  'required',
            'port_akses_server'    =>  'required',
            'ip_address_server'    =>  'required',
            'ip_management_server' =>  'required',
            'web_server'           =>  'required',
            'php_server'           =>  'required',
            'db_server'            =>  'required',
            'application_server'   =>  'required',
            'deskripsi_server'     =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
          // Update Server Spek
        $spek_data = ServerSpek::find($request->hidden_id);
        $spek_data = [
            // 'server_id'           =>  $request->server_id,
            'ram_server'          =>  $request->ram_server,
            'hardisk_server'      =>  $request->hardisk_server,
            'processor_server'    =>  $request->processor_server,
            'core_server'         =>  $request->core_server,
        ];

        // Update Server Penggunaan
        $penggunaan_data = ServerPenggunaan::find($request->hidden_id);
        $penggunaan_data = [
            // 'id'                  =>  ServerDevice::create($form_data)->id,
            'hostname_server'      =>  $request->hostname_server,
            'url_server'           =>  $request->url_server,
            'port_akses_server'    =>  $request->port_akses_server,
            'ip_address_server'    =>  $request->ip_address_server,
            'ip_management_server' =>  $request->ip_management_server,
            'web_server'           =>  $request->web_server,
            'php_server'           =>  $request->php_server,
            'db_server'            =>  $request->db_server,
            'application_server'   =>  $request->application_server,
            'deskripsi_server'     =>  $request->deskripsi_server,
            ];
        
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

        // Proses Update
        ServerDevice::whereId($request->hidden_id)->update($form_data);
        ServerSpek::whereId($request->hidden_id)->update($spek_data);
        ServerPenggunaan::whereId($request->hidden_id)->update($penggunaan_data);
 
        return response()->json([
            'success' => 'Data is successfully updated',
            
        ]);
    }

    public function detail($id)
    {

        if (request()->ajax()) 
        {
            $data = ServerDevice::join('server_spek', 'server_spek.id', '=' ,'server_device.id',)
                                ->join('server_penggunaan', 'server_penggunaan.id', '=' ,'server_device.id',)
                                ->select('server_device.*', 'server_spek.ram_server','server_spek.hardisk_server',
                                'server_spek.processor_server','server_spek.core_server','server_penggunaan.url_server',
                                'server_penggunaan.port_akses_server','server_penggunaan.ip_address_server','server_penggunaan.ip_management_server',
                                'server_penggunaan.hostname_server','server_penggunaan.web_server','server_penggunaan.php_server', 
                                'server_penggunaan.db_server', 'server_penggunaan.application_server','server_penggunaan.deskripsi_server') 
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
        ServerSpek::where('id',$id)->delete();
        ServerPenggunaan::where('id',$id)->delete();
		return redirect()->back();
        
    }
}
