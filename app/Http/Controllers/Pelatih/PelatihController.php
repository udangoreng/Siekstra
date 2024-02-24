<?php

namespace App\Http\Controllers\Pelatih;

use App\Http\Controllers\Controller;
use App\Models\DetailAbsen;
use App\Models\DetailEkstra;
use App\Models\Pelatih;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PelatihController extends Controller
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
        $data = Pelatih::with('ekstra')->where('user_id', Auth::user()->id)->first();
        // dd($ekstra);
        return view('Pelatih.index', compact('username', 'data', 'ekstra', 'absensi'));
    }

    public function profil(){
        $data = Pelatih::where('user_id', Auth::user()->id)->with('ekstra', 'user')->first();
        return view('Pelatih.profil', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $pelatih = Pelatih::find($request->id);
        $updetail = [
            'NIP'=>$request->NIP,
            'nama_pelatih'=>$request->nama_pelatih,
            'nomor_hp_pelatih'=>$request->nomor_hp_pelatih,
            'alamat_pelatih'=>$request->alamat_pelatih,
        ];

        $userdata = [
            'email'=>$request->email,
            'name'=>$request->nama_pelatih,
            'username'=>$request->NIP,
        ];

        $pelatih->update($updetail);
        User::where('id', $request->user_id)->update($userdata);
        return redirect('pelatih/profil');
    }
}
