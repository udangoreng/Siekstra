<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    function login(){
        $usn = Auth::user()->name;
        return view('siswa.index', ['username'=> $usn]);
    }

    public function profil(){
        $user = Auth::user();
        $data = Siswa::where('user_id', $user->id)->first();
        // Ekstra Diikuti
        return view('Siswa.profil', ['user'=> $user, 'data'=>$data]);
    }

    public function update(Request $request, string $id)
    {
        $data = Siswa::find($id);
        $data->nomor_hp_siswa = $request->nomor_hp_siswa;
        $data->save();

        $user = User::where('id', $request->user_id)->first();
        $user->email = $request->email;
        $user->save();

        Alert::success('Berhasil Mengubah', 'Berhasil Mengubah Data');
        return redirect('/siswa/profil');
    }
}
