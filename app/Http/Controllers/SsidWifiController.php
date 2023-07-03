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
use App\Models\SsidWifi;

class SsidWifiController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SsidWifi::latest()->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                    $button .= '   <button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                    return $button;
                })
                ->make(true);
        }
        // $data = SsidWifi::get();
        // dd ($data);
        return view('ssid-wifi.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            // 'id'            =>  'required',
            'ssid_name'        =>  'required',
            'ip_segment'       =>  'required',
            'provider'         =>  'required',
            'lokasi_ssid'      =>  'required',
            'user_ssid'        =>  'required',
            'password_lama'    =>  'required',
            'password_baru'    =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{
            // $cek = SsidWifi::select('ssid_wifi.*') 
            //             ->where('ssid_wifi.ssid_name');
                        // ->exists();
            // $cek = SsidWifi::select('ssid_wifi'cek WHERE ssid_name');
            if (SsidWifi::where('ssid_name', $request->ssid_name)->count() > 0) {
                 // view tampilan
                 $rules = array([
                    'ssid_name' => 'required',
                 ]);
                
                $customMessages = [
                    'required' => 'SSID Sudah Ada',
                ];
                $error = Validator::make($request->all(), $rules, $customMessages);
                return response()->json(['errors' => $error->errors()->all()]);
                
                // $error = \Illuminate\Validation\ValidationException::withMessages([
                //     'ssid_name' => ['sudah ada'],
                //  ]);
                //  throw $error;

                
            }else {
                  
                $form_data = [
                    'ssid_name'     =>  $request->ssid_name,
                    'ip_segment'    =>  $request->ip_segment,
                    'provider'      =>  $request->provider,
                    'lokasi_ssid'   =>  $request->lokasi_ssid,
                    'user_ssid'     =>  $request->user_ssid,
                    'password_lama' =>  $request->password_lama,
                    'password_baru' =>  $request->password_baru,
                    ];

                SsidWifi::create($form_data);
                return response()->json(['success' => 'Data Added successfully.']);
            }
                // $form_data = $request->all();
        
        }
           
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = SsidWifi::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, SsidWifi $ssidwifi)
    {
        $rules = array(
            'ssid_name'        =>  'required',
            'ip_segment'       =>  'required',
            'provider'         =>  'required',
            'lokasi_ssid'      =>  'required',
            'user_ssid'        =>  'required',
            'password_lama'    =>  'required',
            'password_baru'    =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = SsidWifi::find($request->hidden_id);
        $form_data = [
            'ssid_name'     =>  $request->ssid_name,
            'ip_segment'    =>  $request->ip_segment,
            'provider'      =>  $request->provider,
            'lokasi_ssid'   =>  $request->lokasi_ssid,
            'user_ssid'     =>  $request->user_ssid,
            'password_lama' =>  $request->password_lama,
            'password_baru' =>  $request->password_baru, 
        ];
 
        SsidWifi::whereId($request->hidden_id)->update($form_data);
 
        return response()->json([
            'success' => 'Data is successfully updated',
            
        ]);
    }

    public function destroy($id)
    {
        SsidWifi::where('id',$id)->delete();
		return redirect()->back();
        
    }

    public function pdf()
    {
        $data  = SsidWifi::all();
        $pdf = PDF::loadview('ssid-wifi.ssid-wifi-pdf', ['data'=>$data])->setPaper('F4', 'landscape');
        // ->setPaper([0, 0, 685.98, 396.85], 'landscape')
    	return $pdf->download('list_ssid_wifi.pdf');
 
        // return view('users.users-pdf');
    }
}

# Created by Sudiman Syah Widodo 2023
