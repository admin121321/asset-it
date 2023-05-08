<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
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
                    $button = '<button type="button" name="edit" id="'.$data->serial_number.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                    $button .= '   <button type="button" name="edit" id="'.$data->serial_number.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                    return $button;
                })
                ->make(true);
        }
        return view('printer-device.index');
    }

    public function store(Request $request)
    {
        
    }

    public function edit($serial_number)
    {
        if(request()->ajax())
        {
            $data = PrinterDevice::findOrFail($serial_number);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, Logo $logo)
    {
        
    }

    public function destroy($serial_number)
    {
        // hapus file
		$data = PrinterDevice::where('serial_number',$serial_number)->first();
		File::delete('images-logo/'.$data->foto_printer);

        PrinterDevice::where('serial_number',$serial_number)->delete();
		return redirect()->back();
        
    }
}
