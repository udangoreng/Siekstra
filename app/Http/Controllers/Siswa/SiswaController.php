<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\DetailAbsen;
use App\Models\DetailEkstra;
use App\Models\Ekstra;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    function login(){
        $username = Auth::user()->name;
        $month = Carbon::now()->month;
        if ($month >= 7){
            $thn = Carbon::now()->year."/".(Carbon::now()->year)+1;
        } else {
            $thn = ((Carbon::now()->year)-1)."/".(Carbon::now()->year);
        }
        
        $ekstra = [];
        $absensi = [];
        $data = DB::table('ekstra_diikuti')
            ->where('ekstra_diikuti.user_id', Auth::user()->id)
            ->where('tahun_ajaran', $thn)
            ->get();
        
            foreach ($data as $id){
                $diikuti = DetailEkstra::where('id_ekstra', $id->ekstra_id)->with('ekstra')->where('tahun_ajaran', $thn)->where('hari', now()->locale('id')->dayName)->first();
                array_push($ekstra, $diikuti);
                $absen = DetailAbsen::with('ekstra', 'detail')->where('kategori', '!=', 'Pendaftaran')->where('tanggal_selesai', '>=', Carbon::now()->toDateString())->where('tanggal_mulai', "<=", Carbon::now()->toDateString())->where('ekstra_id', $id->ekstra_id)->get();
                array_push($absensi, $absen);
            }
        return view('Siswa.index', compact('ekstra', 'absensi', 'username'));
    }

    public function profil(){
        $data = Siswa::with('ekstra', 'user')->where('user_id', Auth::user()->id)->first();
        return view('Siswa.profil', compact('data'));
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
