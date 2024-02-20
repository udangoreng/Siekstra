<?php

namespace App\Http\Controllers\Pelatih;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function show(string $id)
    {
        $siswa = DB::table('ekstra_diikuti')
            ->join('siswa', 'ekstra_diikuti.user_id', '=', 'siswa.user_id')
            ->join('ekstra', 'ekstra_diikuti.ekstra_id', '=', 'ekstra.id')
            ->select('siswa.*', 'ekstra_diikuti.id as ekstra_diikuti', 'ekstra_diikuti.*')
            ->where('ekstra_diikuti.id', '=', $id)  
            ->first();

        $ekstra = DB::table('ekstra_diikuti')
            ->join('ekstra', 'ekstra_diikuti.ekstra_id', '=', 'ekstra.id')
            ->select('ekstra.*', 'ekstra_diikuti.nilai')
            ->where('user_id', '=', $siswa->user_id)
            ->where('tahun_ajaran', '=', $siswa->tahun_ajaran)   
            ->get();

        return view('Pelatih.siswa', ['siswa'=>$siswa, 'ekstra'=>$ekstra]);
    }

    public function update(Request $request, string $id)
    {
        $update = DB::table('ekstra_diikuti')
              ->where('id', $id)
              ->update(['nilai' => $request->nilai]);

        if($update){
            toast('Berhasil Menambahkan Nilai','success');
            return redirect()->back();
        }
    }
}
