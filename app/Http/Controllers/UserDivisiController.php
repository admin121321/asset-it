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
use App\Models\UserDivisi;

class UserDivisiController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = UserDivisi::latest()->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                    return $button;
                })
                ->make(true);
        }
        // $data = UserDivisi::get();
        // dd ($data);
        return view('users-divisi.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            'nama_divisi'        =>  'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }else{

            if (UserDivisi::where('nama_divisi', $request->nama_divisi)->count() > 0) {
                 // view tampilan
                 $rules = array([
                    'nama_divisi' => 'required',
                 ]);
                
                $customMessages = [
                    'required' => 'Nama Divisi Sudah Ada',
                ];
                $error = Validator::make($request->all(), $rules, $customMessages);
                return response()->json(['errors' => $error->errors()->all()]);
                
            }else {
                  
                $form_data = [
                    'nama_divisi' =>  $request->nama_divisi,
                    ];

                UserDivisi::create($form_data);
                return response()->json(['success' => 'Data Added successfully.']);
            }
        
        }
           
    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = UserDivisi::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update(Request $request, UserDivisi $user_divisi)
    {
        $rules = array(
            'nama_divisi'        =>  'required',
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        if (UserDivisi::where('nama_divisi', $request->nama_divisi)->count() > 0) {
            // view tampilan
            $rules = array([
               'nama_divisi' => 'required',
            ]);
           
           $customMessages = [
               'required' => 'Nama Divisi Sudah Ada',
           ];
           $error = Validator::make($request->all(), $rules, $customMessages);
           return response()->json(['errors' => $error->errors()->all()]);
           
       }else {
             
            $form_data = UserDivisi::find($request->hidden_id);
            $form_data = [
                'nama_divisi' =>  $request->nama_divisi, 
            ];

            UserDivisi::whereId($request->hidden_id)->update($form_data);
    
            return response()->json([
                'success' => 'Data is successfully updated',
                
            ]);
       }
       
    }

    public function destroy($id)
    {
        UserDivisi::where('id',$id)->delete();
		return redirect()->back();
        
    }
}

# Created by Sudiman Syah Widodo 2023