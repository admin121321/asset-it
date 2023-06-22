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
use App\Models\RakServer;

class RakServerController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RakServer::latest()->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $button  = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="detailButton btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i>Detail</button>';
                    return $button;
                })
                ->make(true);
        }
        return view('rak-server.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            // 'id'            =>  'required',
            'brand_rak'     =>  'required',
            'type_rak'      =>  'required',
            'kode_rak'      =>  'required',
            'dimensi_rak'   =>  'required',
            'ukuran_u_rak'  =>  'required',
            'foto_rak'      =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{
            if (RakServer::where('sn_rak', $request->sn_rak)->count() > 0) {
                // view tampilan
                $rules = array([
                    'sn_rak' => 'required',
                ]);
                
                $customMessages = [
                    'required' => 'Kode Rak Sudah Ada',
                ];
        
                // $error = $this->validate($request, $rules, $customMessages);
                $error = Validator::make($request->all(), $rules, $customMessages);
                return response()->json(['errors' => $error->errors()->all()]);
            }else{
                // $form_data = $request->all();
                $form_data = [
                    'sn_rak'        =>  $request->sn_rak,
                    'brand_rak'     =>  $request->brand_rak,
                    'type_rak'      =>  $request->type_rak,
                    'kode_rak'      =>  $request->kode_rak,
                    'dimensi_rak'   =>  $request->dimensi_rak,
                    'ukuran_u_rak'  =>  $request->ukuran_u_rak,
                    'sisa_u'        =>  $request->ukuran_u_rak,
                    'tahun_anggaran'=>  $request->tahun_anggaran,
                    'harga_rak'     =>  $request->harga_rak,
                    'deskripsi'     =>  $request->deskripsi,
                    ];
                $form_data['foto_rak'] = date('YmdHis').'.'.$request->foto_rak->getClientOriginalExtension();
                $request->foto_rak->move(public_path('images-rak'), $form_data['foto_rak']);

                RakServer::create($form_data);
                return response()->json(['success' => 'Data Added successfully.']);
            }
        }
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = RakServer::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, RakServer $rak_server)
    {
        $rules = array(
            'brand_rak'     =>  'required',
            'type_rak'      =>  'required',
            'kode_rak'      =>  'required',
            'dimensi_rak'   =>  'required',
            'ukuran_u_rak'  =>  'required',
            'foto_rak'      =>  '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = RakServer::find($request->hidden_id);
        $fileName  = public_path('images-rak/').$form_data->foto_rak;
        $currentImage = $rak_server->foto_rak;
        
        if ($request->foto_rak != $currentImage) {
            $file = $request->file('foto_rak');
            $fileName_new = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images-rak/'), $fileName_new);
            $rakImage = public_path('images-rak/').$currentImage;
            $form_data = [
                'sn_rak'        =>  $request->sn_rak,
                'brand_rak'     =>  $request->brand_rak,
                'type_rak'      =>  $request->type_rak,
                'kode_rak'      =>  $request->kode_rak,
                'dimensi_rak'   =>  $request->dimensi_rak,
                'ukuran_u_rak'  =>  $request->ukuran_u_rak,
                // 'sisa_u'        =>  $request->sisa_u,
                'tahun_anggaran'=>  $request->tahun_anggaran,
                'harga_rak'     =>  $request->harga_rak,
                'deskripsi'     =>  $request->deskripsi,
                'foto_rak'      =>  $fileName_new
            ];
            File::delete($fileName);

            if(file_exists($rakImage)){
                
                // File::delete($fileName);
                @unlink($rakImage);
                
            }

        } else {
            $form_data = [
                'sn_rak'        =>  $request->sn_rak,
                'brand_rak'     =>  $request->brand_rak,
                'type_rak'      =>  $request->type_rak,
                'kode_rak'      =>  $request->kode_rak,
                'dimensi_rak'   =>  $request->dimensi_rak,
                'ukuran_u_rak'  =>  $request->ukuran_u_rak,
                // 'sisa_u'        =>  $request->sisa_u,
                'tahun_anggaran'=>  $request->tahun_anggaran,
                'harga_rak'     =>  $request->harga_rak,
                'deskripsi'     =>  $request->deskripsi,
            ];
        }
 
        RakServer::whereId($request->hidden_id)->update($form_data);
 
        return response()->json([
            'success' => 'Data is successfully updated',
            
        ]);
    }

    public function detail($id)
    {

        if (request()->ajax()) 
        {
            $data = RakServer::findOrFail($id);
            return response()->json($data);
        }

    }

    public function destroy($id)
    {
        // hapus file
		$data = RakServer::where('id',$id)->first();
		File::delete('images-rak/'.$data->foto_rak);

        RakServer::where('id',$id)->delete();
		return redirect()->back();
        
    }
}
