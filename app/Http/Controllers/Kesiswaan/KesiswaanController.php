<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KesiswaanController extends Controller
{
    function login(){
        $data = Auth::user()->name;
        return view('kesiswaan.index', ['username' => $data]);
    }

    public function index()
    {
        $data = User::where('role', 'Kesiswaan')->paginate(25);
        return view('Kesiswaan.kesiswaan', ['kesiswaan' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NIP'=>'required',
            'nama'=>'required',
            'email'=>'required',
        ],[
            'NIP.required'=>'Harap Isi NIP Kesiswaan',
            'nama.required'=>'Harap Isi Nama Kesiswaan',
            'email.required'=>'Harap Isi Email Kesiswaan',
        ]);

        if($validator->fails()){
            $message='';
            foreach ($validator->errors()->messages() as $value){
                $message .=  $value[0].'<br>';
            }

            alert()->error('Terjadi Kesalahan', $message)->toHtml();
            return redirect()->back();
        } else {
            $password = $request->NIP."@SMKN1jenpo";
            $kesiswaan = User::create([
                'username' => $request->NIP,
                'name' => $request->nama,
                'email' => $request->email,
                'role' => 'Kesiswaan',
                'password' => $password,
            ]);

            if($kesiswaan){
                    toast('Data Berhasil Ditambahkan','success');
                    return redirect('/kesiswaan/kesiswaan');
                }
        }
    }

    public function update(Request $request, string $id)
    {
        $data = User::where('id', $request->id);
        $password = $request->NIP."@SMKN1jenpo";
        $updata = [
            'username' => $request->NIP,
            'name' => $request->nama,
            'email' => $request->email,
            'role' => 'Kesiswaan',
            'password' => $password,
        ];

        if($data){
            $kesiswaan = $data->update($updata);
            Alert::success('Berhasil Mengubah', 'Berhasil Mengubah Data');
            return redirect('/kesiswaan/kesiswaan');
        }
    }

    public function destroy(string $id)
    {
        $data = User::where('id', $id);
        if($data){
            $data->delete();
            Alert::success('Berhasil Menghapus', 'Berhasil Menghapus Data');
            return redirect('/kesiswaan/kesiswaan');
        }
    }
}
