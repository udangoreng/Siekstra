<?php

namespace App\Http\Controllers\Kesiswaan;

use Carbon\Carbon;
use App\Models\DetailEkstra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalController extends Controller
{
    public function index(request $request)
    {
        $month = Carbon::now()->month;
        if ($month >= 7){
            $thn = Carbon::now()->year."/".(Carbon::now()->year)+1;
        } else {
            $thn = ((Carbon::now()->year)-1)."/".(Carbon::now()->year);
        }

        $ekstra = DetailEkstra::with('ekstra')->where('tahun_ajaran', $thn)->get();

        if ($request->cari) {
            $ekstra = DetailEkstra::with('ekstra')->where('tahun_ajaran', $request->cari)->get();
        }

        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('Kesiswaan.jadwal', compact('ekstra', 'thn', 'hari'));
    }

    public function update(Request $request, string $id)
    {
        $data = DetailEkstra::where('id', $id);

        if($data){
            $updata = [
                'hari'=>$request->hari,
                'waktu_mulai'=>$request->waktu_mulai,
                'waktu_selesai'=>$request->waktu_selesai,
            ];
            $data->update($updata);
            Alert::success('Berhasil Mengubah', 'Berhasil Mengubah Ekstrakurikuler');
        }
        return redirect('/kesiswaan/jadwal');
    }
}
