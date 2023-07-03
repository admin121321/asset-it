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
use App\Models\Logo;

class LogoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Logo::latest()->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                    $button .= '   <button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                    return $button;
                })
                ->make(true);
        }

        return view('logo.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            'gambar_logo'             =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else {
            $form_data = $request->all();
            $form_data['gambar_logo'] = date('YmdHis').'.'.$request->gambar_logo->getClientOriginalExtension();
            $request->gambar_logo->move(public_path('images-logo'), $form_data['gambar_logo']);
            
            Logo::create($form_data);
 
            return response()->json(['success' => 'Data Added successfully.']);
        }
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Logo::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, Logo $logo)
    {
        $rules = array(
            // 'gambar_logo'             =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = Logo::find($request->hidden_id);
        $fileName  = public_path('images-logo/').$form_data->gambar_logo;
        $currentImage = $logo->gambar_logo;
        
        if ($request->gambar_logo != $currentImage) {
            $file = $request->file('gambar_logo');
            $fileName_new = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images-logo/'), $fileName_new);
            $logoImage = public_path('images-logo/').$currentImage;
            $form_data = [ 
                'id'              => $request->id,
                'nama_aplikasi'   => $request->nama_aplikasi,
                'gambar_logo'     =>  $fileName_new
            ];
            File::delete($fileName);

            if(file_exists($logoImage)){
                
                // File::delete($fileName);
                @unlink($logoImage);
                
            }

        } else {
            $form_data = [
                'nama_perusahaan'   => $request->nama_perusahaan,
            ];
        }
 
        Logo::whereId($request->hidden_id)->update($form_data);
 
        return response()->json([
            'success' => 'Data is successfully updated',
            
        ]);
    }

    public function destroy($id)
    {
        // hapus file
		$data = Logo::where('id',$id)->first();
		File::delete('images-logo/'.$data->gambar_logo);

        Logo::where('id',$id)->delete();
		return redirect()->back();
        
    }

}


# Created by Sudiman Syah Widodo