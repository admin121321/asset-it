<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use DataTables;
use Validator;
use Auth;
use File;
use DB;
use PDF;
use App\Models\DesktopDevice;

class DesktopDeviceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DesktopDevice::latest()->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                    $button .= '   <button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="detailButton btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i>Detail</button>';
                    return $button;
                })
                ->make(true);
        }
        // $data = DesktopDevice::get();
        // dd ($data);
        return view('desktop-device.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            // 'id'                =>  'required',
            'sn_desktop'        =>  'required',
            'brand_desktop'     =>  'required',
            'model_desktop'     =>  'required',
            'type_desktop'      =>  'required',
            'garansi_desktop'   =>  'required',
            'tahun_anggaran'    =>  'required',
            'harga_desktop'     =>  'required',
            // 'stok'              =>  'required',
            'foto_desktop'      =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi_desktop' =>  'required',
            'ram_desktop'       =>  'required',
            'hardisk_desktop'   =>  'required',
            'processor_desktop' =>  'required',
            'core_desktop'      =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{
            if (DesktopDevice::where('sn_desktop', $request->sn_desktop)->count() > 0) {
                // view tampilan
                $rules = array([
                    'sn_desktop' => 'required',
                 ]);
                
                $customMessages = [
                    'required' => 'Serial Number Sudah Ada',
                ];
            
                // $error = $this->validate($request, $rules, $customMessages);
                $error = Validator::make($request->all(), $rules, $customMessages);
                return response()->json(['errors' => $error->errors()->all()]);
                
                // view inspect
                // $error = \Illuminate\Validation\ValidationException::withMessages([
                //     'sn_desktop' => 'sudah ada',
                //  ]);
                //  throw $error;
                
            }else {
                 // $form_data = $request->all();
                $form_data = [
                    'sn_desktop'       =>  $request->sn_desktop,
                    'brand_desktop'    =>  $request->brand_desktop,
                    'model_desktop'    =>  $request->model_desktop,
                    'type_desktop'     =>  $request->type_desktop,
                    'garansi_desktop'  =>  $request->garansi_desktop,
                    'tahun_anggaran'   =>  $request->tahun_anggaran,
                    'harga_desktop'    =>  $request->harga_desktop,
                    'stok'             =>  $request->stok,
                    'sisa_stok'        =>  $request->stok,
                    'deskripsi_desktop'=>  $request->deskripsi_desktop,
                    'ram_desktop'      =>  $request->ram_desktop,
                    'hardisk_desktop'  =>  $request->hardisk_desktop,
                    'processor_desktop'=>  $request->processor_desktop,
                    'core_desktop'     =>  $request->core_desktop,
                    ];
                $form_data['foto_desktop'] = date('YmdHis').'.'.$request->foto_desktop->getClientOriginalExtension();
                $request->foto_desktop->move(public_path('images-desktop'), $form_data['foto_desktop']);

                DesktopDevice::create($form_data);
                return response()->json(['success' => 'Data Added successfully.']);

            }

           
        }
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = DesktopDevice::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, DesktopDevice $desktop_device)
    {
        $rules = array(
            'sn_desktop'        =>  'required',
            'brand_desktop'     =>  'required',
            'model_desktop'     =>  'required',
            'type_desktop'      =>  'required',
            'garansi_desktop'   =>  'required',
            'tahun_anggaran'    =>  'required',
            'harga_desktop'     =>  'required',
            'stok'              =>  'required',
            'deskripsi_desktop' =>  'required',
            // 'foto_printer'  =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = DesktopDevice::find($request->hidden_id);
        $fileName  = public_path('images-desktop/').$form_data->foto_desktop;
        $currentImage = $desktop_device->foto_desktop;
        
        if ($request->foto_desktop != $currentImage) {
            $file = $request->file('foto_desktop');
            $fileName_new = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images-desktop/'), $fileName_new);
            $desktopImage = public_path('images-desktop/').$currentImage;
            $form_data = [
                'sn_desktop'       =>  $request->sn_desktop,
                'brand_desktop'    =>  $request->brand_desktop,
                'model_desktop'    =>  $request->model_desktop,
                'type_desktop'     =>  $request->type_desktop,
                'garansi_desktop'  =>  $request->garansi_desktop,
                'tahun_anggaran'   =>  $request->tahun_anggaran,
                'harga_desktop'    =>  $request->harga_desktop,
                // 'stok'             =>  $request->stok,
                // 'sisa_stok'        =>  $request->sisa_stok,
                'deskripsi_desktop'=>  $request->deskripsi_desktop,
                'ram_desktop'      =>  $request->ram_desktop,
                'hardisk_desktop'  =>  $request->hardisk_desktop,
                'processor_desktop'=>  $request->processor_desktop,
                'core_desktop'     =>  $request->core_desktop,
                'foto_desktop'     =>  $fileName_new
            ];
            File::delete($fileName);

            if(file_exists($desktopImage)){
                
                // File::delete($fileName);
                @unlink($desktopImage);
                
            }

        } else {
            $form_data = [
                'sn_desktop'       =>  $request->sn_desktop,
                'brand_desktop'    =>  $request->brand_desktop,
                'model_desktop'    =>  $request->model_desktop,
                'type_desktop'     =>  $request->type_desktop,
                'garansi_desktop'  =>  $request->garansi_desktop,
                'tahun_anggaran'   =>  $request->tahun_anggaran,
                'harga_desktop'    =>  $request->harga_desktop,
                // 'stok'             =>  $request->stok,
                // 'sisa_stok'        =>  $request->sisa_stok,
                'deskripsi_desktop'=>  $request->deskripsi_desktop,
                'ram_desktop'      =>  $request->ram_desktop,
                'hardisk_desktop'  =>  $request->hardisk_desktop,
                'processor_desktop'=>  $request->processor_desktop,
                'core_desktop'     =>  $request->core_desktop,
            ];
        }
 
        DesktopDevice::whereId($request->hidden_id)->update($form_data);
 
        return response()->json([
            'success' => 'Data is successfully updated',
            
        ]);
    }

    public function detail($id)
    {

        if (request()->ajax()) 
        {
            $data = DesktopDevice::findOrFail($id);
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
		$data = DesktopDevice::where('id',$id)->first();
		File::delete('images-desktop/'.$data->foto_desktop);

        DesktopDevice::where('id',$id)->delete();
		return redirect()->back();
        
    }

    public function pdf()
    {
        $data = DesktopDevice::all();
        $customPaper = array(0,0,1500,950);
        $pdf = PDF::loadview('desktop-device.desktop-device-pdf', ['data'=>$data])->setPaper($customPaper);
        // $pdf = PDF::loadview('desktop-device.desktop-device-pdf', ['data'=>$data])->setPaper('f4', 'landscape');
        // ->setPaper([0, 0, 685.98, 396.85], 'landscape')
    	return $pdf->download('list_desktop_device.pdf');
 
        // return view('users.users-pdf');
    }
}


# Created by Sudiman Syah Widodo
