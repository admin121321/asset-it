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
use App\Models\User;
use App\Models\PrinterPengguna;
use App\Models\PrinterDevice;

class PrinterPenggunaController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PrinterPengguna::join('users', 'users.id', '=' ,'printer_pengguna.user_id')
                                    ->join('printer_devices', 'printer_devices.id', '=', 'printer_pengguna.printer_id')
                                    ->select('printer_pengguna.*', 'users.name', 'printer_devices.brand_printer', 'printer_devices.model_printer') 
                                    ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('user_id', function($data){
                    return $data->name;
                })
                ->addColumn('printer_id', function($data){
                    return $data->brand_printer;
                })
                ->addColumn('printer_id', function($data){
                    return $data->model_printer;
                })
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                    $button .= '   <button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                    return $button;
                })
                ->make(true);
        }
        // $data = PrinterDevice::get();
        // dd ($data);
        return view('printer-pengguna.index');
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

            // $form_data = $request->all();
            $form_data = [
                'user_id'   =>  $request->user_id,
                'printer_id'=>  $request->printer_id,
                'qty'       =>  $request->qty,
                ];

            PrinterPengguna::create($form_data);
            return response()->json(['success' => 'Data Added successfully.']);
        }
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = PrinterPengguna::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, PrinterPengguna $printerpengguna)
    {
        $rules = array(
            'user_id'   =>  'required',
            'printer_id'=>  'required',
            'qty'       =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = PrinterPengguna::find($request->hidden_id);
        $form_data = [
            'user_id'   =>  $request->user_id,
            'printer_id'=>  $request->printer_id,
            'qty'       =>  $request->qty,
            ];
 
        PrinterPengguna::whereId($request->hidden_id)->update($form_data);
 
        return response()->json([
            'success' => 'Data is successfully updated',
            
        ]);
    }

    public function destroy($id)
    {
        // hapus file
        PrinterPengguna::where('id',$id)->delete();
		return redirect()->back();
        
    }
}
