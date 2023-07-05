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
use PDF;
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
                                    ->select('printer_pengguna.*', 'users.name', 'users.card_id', 'printer_devices.brand_printer', 'printer_devices.model_printer', 'printer_devices.serial_number', 'printer_devices.type_printer', ) 
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
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Ubah</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Hapus</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="detailButton btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i>Detail</button>';
                    return $button;
                })
                ->make(true);
        }
        // $data = PrinterDevice::get();
        // dd ($data);
        $data = PrinterPengguna::join('users', 'users.id', '=' ,'printer_pengguna.user_id')
                                ->join('printer_devices', 'printer_devices.id', '=', 'printer_pengguna.printer_id')
                                ->select('printer_pengguna.*', 'users.name', 'printer_devices.brand_printer', 'printer_devices.model_printer', 'printer_devices.serial_number') 
                                ->get();
        return view('printer-pengguna.index', compact('data'));
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

            PrinterPengguna::create($request->all());
            $form_data = PrinterDevice::findOrFail($request->printer_id);
            $form_data->sisa_stok -= $request->qty;
            $form_data->save();
           

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
            // 'printer_id'=>  'required',
            'qty'       =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $printer_pengguna = PrinterPengguna::find($request->hidden_id);
            if($printer_pengguna->qty='1'){
                $printer_pengguna->update([
                    'user_id'   =>  $request->user_id,
                    // 'printer_id'=>  $request->printer_id,
                ]);
            }
            else{    
                $printer_pengguna->update($request->all());
                $form_data = PrinterDevice::findOrFail($request->printer_id);
                $form_data->stok -= $request->qty;
            }

        // $form_data = PrinterPengguna::find($request->hidden_id);
        // $form_data = [
        //     'user_id'   =>  $request->user_id,
        //     'printer_id'=>  $request->printer_id,
        //     'qty'       =>  $request->qty,
        //     ];
 
        // PrinterPengguna::whereId($request->hidden_id)->update($form_data);
 
        return response()->json([
            'success' => 'Data Berhasil di Update',
            
        ]);
    }

    public function detail($id)
    {

        if (request()->ajax()) 
        {
            // $data = PrinterPengguna::findOrFail($id);
            $data = PrinterPengguna::join('users', 'users.id', '=' ,'printer_pengguna.user_id')
                                    ->join('printer_devices', 'printer_devices.id', '=', 'printer_pengguna.printer_id')
                                    ->select('printer_pengguna.*', 'users.name', 'users.card_id', 'printer_devices.brand_printer', 
                                            'printer_devices.model_printer', 'printer_devices.foto_printer', 'printer_devices.serial_number', 'printer_devices.type_printer', ) 
                                    ->findOrFail($id);
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
        PrinterPengguna::where('id',$id)->delete();
		return redirect()->back();
        
    }
    
    public function pdf()
    {
        $data = PrinterPengguna::join('users', 'users.id', '=' ,'printer_pengguna.user_id')
                                    ->join('printer_devices', 'printer_devices.id', '=', 'printer_pengguna.printer_id')
                                    ->select('printer_pengguna.*', 'users.name', 'users.card_id', 'printer_devices.brand_printer', 'printer_devices.model_printer', 'printer_devices.serial_number', 'printer_devices.type_printer',) 
                                    ->get();
        $pdf = PDF::loadview('printer-pengguna.printer-pengguna-pdf', ['data'=>$data])->setPaper('F4', 'landscape');
        // ->setPaper([0, 0, 685.98, 396.85], 'landscape')
    	return $pdf->download('list_printer_pengguna.pdf');
 
        // return view('users.users-pdf');
    }
}

# Created by Sudiman Syah Widodo 2023
