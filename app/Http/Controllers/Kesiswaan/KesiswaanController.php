<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\DetailAbsen;
use App\Models\DetailEkstra;
use App\Models\Ekstra;
use App\Models\Jurnal;
use App\Models\Pelatih;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KesiswaanController extends Controller
{
    function login(){
        $username = Auth::user()->name;
        $ekstra = Ekstra::get();
        $siswa = Siswa::get();
        $pelatih = Pelatih::get();
        $jurnal = Jurnal::get();
        $absen = DetailAbsen::get();

        $eks_today = DetailEkstra::with('ekstra')->where('hari', now()->locale('id')->dayName)->get();
        return view('kesiswaan.index', compact('username', 'ekstra', 'siswa', 'pelatih', 'jurnal', 'absen', 'eks_today'));
    }

    public function index(request $request)
    {
        $kesiswaan = User::where('role', 'Kesiswaan')->latest()->paginate(10);
        if($request->cari){
            $kesiswaan = User::where('role', 'Kesiswaan')
            ->where('name', $request->cari)
            ->orWhere('username', $request->cari)
            ->paginate(10);
        }
        return view('Kesiswaan.kesiswaan', compact('kesiswaan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'=>'required',
            'nama'=>'required',
            'email'=>'required',
        ],[
            'username.required'=>'Harap Isi username Kesiswaan',
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
            $password = $request->username."@SMKN1jenpo";
            $kesiswaan = User::create([
                'username' => $request->username,
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
