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
use App\Models\PrinterDevice;

class PrinterDeviceController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PrinterDevice::latest()->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                    $button .= '   <button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                    return $button;
                })
                ->make(true);
        }
        // $data = PrinterDevice::get();
        // dd ($data);
        return view('printer-device.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            // 'id'            =>  'required',
            'serial_number' =>  'required',
            'brand_printer' =>  'required',
            'model_printer' =>  'required',
            'type_printer'  =>  'required',
            'tahun_anggaran'=>  'required',
            'harga_printer' =>  'required',
            'stok'          =>  'required',
            'foto_printer'  =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{
            if (PrinterDevice::where('serial_number', $request->serial_number)->count() > 0) {
                // view tampilan
                $rules = array([
                    'serial_number' => 'required',
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
                    'serial_number' =>  $request->serial_number,
                    'brand_printer' =>  $request->brand_printer,
                    'model_printer' =>  $request->model_printer,
                    'type_printer'  =>  $request->type_printer,
                    'tahun_anggaran'=>  $request->tahun_anggaran,
                    'harga_printer' =>  $request->harga_printer,
                    'stok'          =>  $request->stok,
                    ];
                $form_data['foto_printer'] = date('YmdHis').'.'.$request->foto_printer->getClientOriginalExtension();
                $request->foto_printer->move(public_path('images-printer'), $form_data['foto_printer']);

                PrinterDevice::create($form_data);
                return response()->json(['success' => 'Data Added successfully.']);
            }
        }
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = PrinterDevice::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, PrinterDevice $printerdevice)
    {
        $rules = array(
            'serial_number' =>  'required',
            'brand_printer' =>  'required',
            'model_printer' =>  'required',
            'type_printer'  =>  'required',
            'tahun_anggaran'=>  'required',
            'harga_printer' =>  'required',
            'stok'          =>  'required',
            // 'foto_printer'  =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = PrinterDevice::find($request->hidden_id);
        $fileName  = public_path('images-printer/').$form_data->foto_printer;
        $currentImage = $printerdevice->foto_printer;
        
        if ($request->foto_printer != $currentImage) {
            $file = $request->file('foto_printer');
            $fileName_new = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images-printer/'), $fileName_new);
            $printerImage = public_path('images-printer/').$currentImage;
            $form_data = [
                'serial_number' =>  $request->serial_number,
                'brand_printer' =>  $request->brand_printer,
                'model_printer' =>  $request->model_printer,
                'type_printer'  =>  $request->type_printer,
                'tahun_anggaran'=>  $request->tahun_anggaran,
                'harga_printer' =>  $request->harga_printer,
                'stok'          =>  $request->stok, 
                'foto_printer'  =>  $fileName_new
            ];
            File::delete($fileName);

            if(file_exists($printerImage)){
                
                // File::delete($fileName);
                @unlink($printerImage);
                
            }

        } else {
            $form_data = [
                'serial_number' =>  $request->serial_number,
                'brand_printer' =>  $request->brand_printer,
                'model_printer' =>  $request->model_printer,
                'type_printer'  =>  $request->type_printer,
                'tahun_anggaran'=>  $request->tahun_anggaran,
                'harga_printer' =>  $request->harga_printer,
                'stok'          =>  $request->stok, 
            ];
        }
 
        PrinterDevice::whereId($request->hidden_id)->update($form_data);
 
        return response()->json([
            'success' => 'Data is successfully updated',
            
        ]);
    }

    public function destroy($id)
    {
        // hapus file
		$data = PrinterDevice::where('id',$id)->first();
		File::delete('images-printer/'.$data->foto_printer);

        PrinterDevice::where('id',$id)->delete();
		return redirect()->back();
        
    }
}
