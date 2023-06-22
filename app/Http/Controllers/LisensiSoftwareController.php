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
use App\Models\LisensiSoftware;

class LisensiSoftwareController extends Controller
{
    public function index(Request $request)
     {
        if ($request->ajax()) {
            $data = LisensiSoftware::latest()->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="detailButton btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i>Detail</button>';
                    return $button;
                })
                ->make(true);
        } 

        // $data = LisensiSoftware::get();
        // dd ($data);
        return view('lisensi-software.index');
     }

     public function store(Request $request)
     {
         $rules = array(
             // 'id'            =>  'required',
             'sn_lisensi'    =>  'required',
             'brand_lisensi' =>  'required',
             'model_lisensi' =>  'required',
             'type_lisensi'  =>  'required',
             'tahun_anggaran'=>  'required',
             'harga_lisensi' =>  'required',
             'bit_os'       =>  'required',
             'stok'          =>  'required',
             'key_lisensi'   =>  'required',
             'foto_lisensi'  =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         );
  
         $error = Validator::make($request->all(), $rules);
  
         if($error->fails())
         {
             return response()->json(['errors' => $error->errors()->all()]);
         }else{
            if (LisensiSoftware::where('sn_lisensi', $request->sn_lisensi)->count() > 0) {
              // view tampilan
                $rules = array([
                    'sn_lisensi' => 'required',
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
                    'sn_lisensi'    =>  $request->sn_lisensi,
                    'brand_lisensi' =>  $request->brand_lisensi,
                    'model_lisensi' =>  $request->model_lisensi,
                    'type_lisensi'  =>  $request->type_lisensi,
                    'tahun_anggaran'=>  $request->tahun_anggaran,
                    'masa_aktif'    =>  $request->masa_aktif,
                    'bit_os'        =>  $request->bit_os,
                    'harga_lisensi' =>  $request->harga_lisensi,
                    'key_lisensi'   =>  $request->key_lisensi,
                    'stok'          =>  $request->stok,
                    'sisa_stok'     =>  $request->stok,
                    ];
                $form_data['foto_lisensi'] = date('YmdHis').'.'.$request->foto_lisensi->getClientOriginalExtension();
                $request->foto_lisensi->move(public_path('images-lisensi'), $form_data['foto_lisensi']);
    
                LisensiSoftware::create($form_data);
                return response()->json(['success' => 'Data Berhasil Ditambah.']);
            }
         }
     }
 
     public function edit($id)
     {
         if(request()->ajax())
         {
             $data = LisensiSoftware::findOrFail($id);
             return response()->json(['result' => $data]);
         }
     }
 
     public function update(Request $request, LisensiSoftware $lisensisoftware)
     {
         $rules = array(
            'sn_lisensi'    =>  'required',
            'brand_lisensi' =>  'required',
            'model_lisensi' =>  'required',
            'type_lisensi'  =>  'required',
            'tahun_anggaran'=>  'required',
            'harga_lisensi' =>  'required',
            'bit_os'       =>  'required',
            'stok'          =>  'required',
            'key_lisensi'   =>  'required',
            // 'foto_lisensi'  =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         );
  
         $error = Validator::make($request->all(), $rules);
  
         if($error->fails())
         {
             return response()->json(['errors' => $error->errors()->all()]);
         }
         $form_data = LisensiSoftware::find($request->hidden_id);
         $fileName  = public_path('images-lisensi/').$form_data->foto_lisensi;
         $currentImage =  $lisensisoftware->foto_lisensi;
         
         if ($request->foto_lisensi != $currentImage) {
             $file = $request->file('foto_lisensi');
             $fileName_new = date('YmdHis') . '.' . $file->getClientOriginalExtension();
             $file->move(public_path('images-lisensi/'), $fileName_new);
             $lisensiImage = public_path('images-lisensi/').$currentImage;
             $form_data = [
                 'sn_lisensi'    =>  $request->sn_lisensi,
                 'brand_lisensi' =>  $request->brand_lisensi,
                 'model_lisensi' =>  $request->model_lisensi,
                 'type_lisensi'  =>  $request->type_lisensi,
                 'tahun_anggaran'=>  $request->tahun_anggaran,
                 'masa_aktif'    =>  $request->masa_aktif,
                 'bit_os'        =>  $request->bit_os,
                 'harga_lisensi' =>  $request->harga_lisensi,
                 'key_lisensi'   =>  $request->key_lisensi,
                 'stok'          =>  $request->stok,
                 'sisa_stok'     =>  $request->sisa_stok,
                 'foto_lisensi'  =>  $fileName_new
             ];
             File::delete($fileName);
 
             if(file_exists($lisensiImage)){
                 
                 // File::delete($fileName);
                 @unlink($lisensiImage);
                 
             }
 
         } else {
             $form_data = [
                'sn_lisensi'    =>  $request->sn_lisensi,
                'brand_lisensi' =>  $request->brand_lisensi,
                'model_lisensi' =>  $request->model_lisensi,
                'type_lisensi'  =>  $request->type_lisensi,
                'tahun_anggaran'=>  $request->tahun_anggaran,
                'masa_aktif'    =>  $request->masa_aktif,
                'bit_os'        =>  $request->bit_os,
                'harga_lisensi' =>  $request->harga_lisensi,
                'key_lisensi'   =>  $request->key_lisensi,
                'stok'          =>  $request->stok,
                'sisa_stok'     =>  $request->sisa_stok,
             ];
         }
  
         LisensiSoftware::whereId($request->hidden_id)->update($form_data);
  
         return response()->json([
             'success' => 'Data is successfully updated',
             
         ]);
     }

     public function detail($id)
    {

        if (request()->ajax()) 
        {
            $data = LisensiSoftware::findOrFail($id);
            return response()->json($data);
        }

    }
 
     public function destroy($id)
     {
         // hapus file
         $data = LisensiSoftware::where('id',$id)->first();
         File::delete('images-lisensi/'.$data->foto_lisensi);
 
         LisensiSoftware::where('id',$id)->delete();
         return redirect()->back();
         
     }
}
