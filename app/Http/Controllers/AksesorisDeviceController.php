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
            // 'stok'              =>  'required',
            'foto_aksesoris'    =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{
            if (AksesorisDevice::where('sn_aksesoris', $request->sn_aksesoris)->count() > 0) {
             // view tampilan
             $rules = array([
                'sn_aksesoris' => 'required',
             ]);
            
            $customMessages = [
                'required' => 'Serial Number Sudah Ada',
            ];
        
            // $error = $this->validate($request, $rules, $customMessages);
            $error = Validator::make($request->all(), $rules, $customMessages);
            return response()->json(['errors' => $error->errors()->all()]);
        }else {
            // $form_data = $request->all();
            $form_data = [
                'sn_aksesoris'      =>  $request->sn_aksesoris,
                'brand_aksesoris'   =>  $request->brand_aksesoris,
                'model_aksesoris'   =>  $request->model_aksesoris,
                'type_aksesoris'    =>  $request->type_aksesoris,
                'garansi_aksesoris' =>  $request->garansi_aksesoris,
                'tahun_anggaran'    =>  $request->tahun_anggaran,
                'harga_aksesoris'   =>  $request->harga_aksesoris,
                'stok'              =>  '1',
                'sisa_stok'         =>  '1',
                ];
            $form_data['foto_aksesoris'] = date('YmdHis').'.'.$request->foto_aksesoris->getClientOriginalExtension();
            $request->foto_aksesoris->move(public_path('images-aksesoris'), $form_data['foto_aksesoris']);

            AksesorisDevice::create($form_data);
            return response()->json(['success' => 'Data Added successfully.']);
            }
        }
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = AksesorisDevice::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }
    public function update(Request $request, AksesorisDevice $printerdevice)
    {
        $rules = array(
            'sn_aksesoris'      =>  'required',
            'brand_aksesoris'   =>  'required',
            'model_aksesoris'   =>  'required',
            'type_aksesoris'    =>  'required',
            'garansi_aksesoris' =>  'required',
            'tahun_anggaran'    =>  'required',
            'harga_aksesoris'   =>  'required',
            'stok'              =>  'required',
            // 'foto_printer'  =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = AksesorisDevice::find($request->hidden_id);
        $fileName  = public_path('images-aksesoris/').$form_data->foto_aksesoris;
        $currentImage = $printerdevice->foto_aksesoris;
        
        if ($request->foto_printer != $currentImage) {
            $file = $request->file('foto_aksesoris');
            $fileName_new = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images-aksesoris/'), $fileName_new);
            $printerImage = public_path('images-aksesoris/').$currentImage;
            $form_data = [
                'sn_aksesoris'      =>  $request->sn_aksesoris,
                'brand_aksesoris'   =>  $request->brand_aksesoris,
                'model_aksesoris'   =>  $request->model_aksesoris,
                'type_aksesoris'    =>  $request->type_aksesoris,
                'garansi_aksesoris' =>  $request->garansi_aksesoris,
                'tahun_anggaran'    =>  $request->tahun_anggaran,
                'harga_aksesoris'   =>  $request->harga_aksesoris,
                'stok'              =>  $request->stok,
                'sisa_stok'         =>  $request->sisa_stok,
                'foto_aksesoris'    =>  $fileName_new
            ];
            File::delete($fileName);

            if(file_exists($printerImage)){
                
                // File::delete($fileName);
                @unlink($printerImage);
                
            }

        } else {
            $form_data = [
                'sn_aksesoris'      =>  $request->sn_aksesoris,
                'brand_aksesoris'   =>  $request->brand_aksesoris,
                'model_aksesoris'   =>  $request->model_aksesoris,
                'type_aksesoris'    =>  $request->type_aksesoris,
                'garansi_aksesoris' =>  $request->garansi_aksesoris,
                'tahun_anggaran'    =>  $request->tahun_anggaran,
                'harga_aksesoris'   =>  $request->harga_aksesoris,
                'stok'              =>  $request->stok,
                'sisa_stok'         =>  $request->sisa_stok, 
            ];
        }
 
        AksesorisDevice::whereId($request->hidden_id)->update($form_data);
 
        return response()->json([
            'success' => 'Data is successfully updated',
            
        ]);
    }

    public function destroy($id)
    {
        // hapus file
		$data = AksesorisDevice::where('id',$id)->first();
		File::delete('images-aksesoris/'.$data->foto_aksesoris);

        AksesorisDevice::where('id',$id)->delete();
		return redirect()->back();
        
    }
}
