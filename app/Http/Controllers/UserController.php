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
use App\Models\User;
use App\Models\UserDivisi;

class UserController extends Controller
{
    //
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = User::select('users.*')->orderBy('created_at', 'DESC')->latest()->get();
            $data = User::join('users_divisi', 'users_divisi.id', '=' ,'users.divisi_id',)
                        ->select('users.*', 'users_divisi.nama_divisi') 
                        ->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"> <i class="bi bi-pencil-square"></i>Edit Profile</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="passwordButton btn btn-warning btn-sm"> <i class="bi bi-pencil-square"></i>Edit Pass</button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="detailButton btn btn-success btn-sm"> <i class="bi bi-pencil-square"></i>Detail</button>';
                    $button .= '   <button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"> <i class="bi bi-backspace-reverse-fill"></i> Delete</button>';
                    return $button;
                })
                ->make(true);
        }
 
        return view('users.index');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'foto' => '|image|mimes:jpg,jpeg,png,ico',
        ]);

        $foto = $request->file('foto');

        if ($foto == NULL){
            $form_data = array(
                    'name'         => $request->name,
                    'card_id'      => $request->card_id,
                    'divisi_id'    => strtoupper($request->divisi_id),
                    'email'        => $request->email,
                    'password'     => Hash::make($request->password),
                    'level_login'  => strtoupper($request->level_login),
            );

        } else {
            $nama_file = date('YmdHis').'.'.$foto->getClientOriginalName();
            $tujuan_upload = 'images-foto';
            $foto->move($tujuan_upload,$nama_file);
            $form_data = array(
                'name'         => $request->name,
                'card_id'      => $request->card_id,
                'divisi_id'    => strtoupper($request->divisi_id),
                'email'        => $request->email,
                'password'     => Hash::make($request->password),
                'level_login'  => strtoupper($request->level_login),
                'foto'         => $nama_file,
            );
        }

        User::create($form_data);
        return response()->json(['success' => 'Data Added successfully.']);

    }

    public function edit($id)
    {
        if(request()->ajax())
        {
            // $data = User::findOrFail($id);
            $data = User::join('users_divisi', 'users_divisi.id', '=' ,'users.divisi_id',)
                        ->select('users.*', 'users_divisi.nama_divisi')
                        ->findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }
 
    public function update(Request $request, User $user)
    {
        $rules = array(
          
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $form_data = User::find($request->hidden_id);
        $fileName  = public_path('images-foto/').$form_data->foto;
        $currentImage = $user->foto;
        
        if ($request->foto != $currentImage) {
            $file = $request->file('foto');
            $fileName_new = date('YmdHis') . '.' . $file->getClientOriginalName();
            $file->move(public_path('images-foto/'), $fileName_new);
            $userImage = public_path('images-foto/').$currentImage;
            $form_data = [
                'name'         => $request->name,
                'card_id'      => $request->card_id,
                'divisi_id'    => strtoupper($request->divisi_id),
                'email'        => $request->email,
                'level_login'  => strtoupper($request->level_login), 
                'foto'         =>  $fileName_new
            ];
            File::delete($fileName);

            if(file_exists($userImage)){
                
                // File::delete($fileName);
                @unlink($userImage);
                
            }

        } else {
            // $fileName = $request->gambar;
            $form_data = [
                'name'         => $request->name,
                'card_id'      => $request->card_id,
                'divisi_id'    => strtoupper($request->divisi_id),
                'email'        => $request->email,
                'level_login'  => strtoupper($request->level_login),
            ];
        }
 
        User::whereId($request->hidden_id)->update($form_data);
 
        return response()->json([
            'success' => 'Data is successfully updated',
            
        ]);
    }

    public function edit_pass($id)
    {
        if(request()->ajax())
        {
            $data = User::findOrFail($id);
            // $data = User::join('users_divisi', 'users_divisi.id', '=' ,'users.divisi_id',)
            //             ->select('users.*', 'users_divisi.nama_divisi')
            //             ->findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    public function update_pass(Request $request, User $user)
    {
        $rules = array(
          
        );
 
        $error = Validator::make($request->all(), $rules);
 
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
        );
 
        User::whereId($request->hidden_id_pass)->update($form_data);
 
        return response()->json([
            'success' => 'Data is successfully updated',
            
        ]);
    }
 
    public function destroy($id)
    {
        $data = User::where('id',$id)->first();
		File::delete('images-foto/'.$data->foto);

        $data = User::findOrFail($id);
        $data->delete();
    }

    public function detail($id)
    {
        if(request()->ajax())
        {
            $data = User::join('users_divisi', 'users_divisi.id', '=' ,'users.divisi_id',)
                        ->select('users.*', 'users_divisi.nama_divisi')
                        ->findOrFail($id);
            return response()->json($data);
        }
    }

    public function pdf()
    {
        // $users  = User::all();
        $data = User::join('users_divisi', 'users_divisi.id', '=' ,'users.divisi_id',)
                    ->select('users.*', 'users_divisi.nama_divisi') 
                    ->get();
        $pdf = PDF::loadview('users.users-pdf', ['data'=>$data])->setPaper('F4', 'landscape');
        // ->setPaper([0, 0, 685.98, 396.85], 'landscape')
    	return $pdf->download('list_users.pdf');
 
        // return view('users.users-pdf');
    }
}
