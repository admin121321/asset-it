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

class NetworkDeviceController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = NetworkDevice::latest()->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                    $button .= '   <button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                    return $button;
                })
                ->make(true);
        } 
        // $data = NetworkDevice::get();
        // dd ($data);
        return view('network-device.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            // 'id'            =>  'required',
            'sn_network'      =>  'required',
            'brand_network'   =>  'required',
            'model_network'   =>  'required',
            'type_network'    =>  'required',
            'port_network'    =>  'required',
            'garansi_network' =>  'required',
            'tahun_anggaran'  =>  'required',
            'harga_network'   =>  'required',
            'stok'            =>  'required',
            'foto_network'    =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{
            if (NetworkDevice::where('sn_network', $request->sn_network)->count() > 0) {
                // view tampilan
                $rules = array([
                'sn_network' => 'required',
                ]);
                
                $customMessages = [
                    'required' => 'Serial Number Sudah Ada',
                ];
            
                // $error = $this->validate($request, $rules, $customMessages);
                $error = Validator::make($request->all(), $rules, $customMessages);
                return response()->json(['errors' => $error->errors()->all()]);
            }else{
                // $form_data = $request->all();
                $form_data = [
                    'sn_network'        =>  $request->sn_network,
                    'brand_network'     =>  $request->brand_network,
                    'model_network'     =>  $request->model_network,
                    'type_network'      =>  $request->type_network,
                    'port_network'      =>  $request->port_network,
                    'garansi_network'   =>  $request->garansi_network,
                    'tahun_anggaran'    =>  $request->tahun_anggaran,
                    'harga_network'     =>  $request->harga_network,
                    'stok'              =>  $request->stok,
                    'sisa_stok'              =>  $request->stok,
                    ];
                $form_data['foto_network'] = date('YmdHis').'.'.$request->foto_network->getClientOriginalExtension();
                $request->foto_network->move(public_path('images-network'), $form_data['foto_network']);

                NetworkDevice::create($form_data);
                return response()->json(['success' => 'Data Added successfully.']);
            } 
        }
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = NetworkDevice::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, NetworkDevice $networkdevice)
    {
        $rules = array(
            'sn_network'      =>  'required',
            'brand_network'   =>  'required',
            'model_network'   =>  'required',
            'type_network'    =>  'required',
            'port_network'    =>  'required',
            'garansi_network' =>  'required',
            'tahun_anggaran'  =>  'required',
            'harga_network'   =>  'required',
            // 'stok'            =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = NetworkDevice::find($request->hidden_id);
        $fileName  = public_path('images-network/').$form_data->foto_network;
        $currentImage = $networkdevice->foto_network;
        
        if ($request->foto_network != $currentImage) {
            $file = $request->file('foto_network');
            $fileName_new = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images-network/'), $fileName_new);
            $networkImage = public_path('images-netwrok/').$currentImage;
            $form_data = [
                'sn_network'        =>  $request->sn_network,
                'brand_network'     =>  $request->brand_network,
                'model_network'     =>  $request->model_network,
                'type_network'      =>  $request->type_network,
                'port_network'      =>  $request->port_network,
                'garansi_network'   =>  $request->garansi_network,
                'tahun_anggaran'    =>  $request->tahun_anggaran,
                'harga_network'     =>  $request->harga_network,
                // 'stok'              =>  $request->stok,
                'foto_network'      =>  $fileName_new
            ];
            File::delete($fileName);

            if(file_exists($networkImage)){
                
                // File::delete($fileName);
                @unlink($networkImage);
                
            }

        } else {
            $form_data = [
                'sn_network'        =>  $request->sn_network,
                'brand_network'     =>  $request->brand_network,
                'model_network'     =>  $request->model_network,
                'type_network'      =>  $request->type_network,
                'port_network'      =>  $request->port_network,
                'garansi_network'   =>  $request->garansi_network,
                'tahun_anggaran'    =>  $request->tahun_anggaran,
                'harga_network'     =>  $request->harga_network,
                // 'stok'              =>  $request->stok,
            ];
        }
 
        NetworkDevice::whereId($request->hidden_id)->update($form_data);
 
        return response()->json([
            'success' => 'Data is successfully updated',
            
        ]);
    }

    public function destroy($id)
    {
        // hapus file
		$data = NetworkDevice::where('id',$id)->first();
		File::delete('images-network/'.$data->foto_netwrok);

        NetworkDevice::where('id',$id)->delete();
		return redirect()->back();
        
    }
}
