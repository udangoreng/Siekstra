<?php

namespace App\Http\Controllers\Pelatih;

use App\Http\Controllers\Controller;
use App\Models\DetailAbsen;
use App\Models\DetailEkstra;
use App\Models\Ekstra;
use App\Models\Jurnal;
use App\Models\Pelatih;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EkstraController extends Controller
{
    public function index(request $request)
    {
        $ekstra = [];
        $current_date = Carbon::now()->toDateString();
        $month = Carbon::now()->month;
        if ($month >= 7){
            $thn = Carbon::now()->year."/".(Carbon::now()->year)+1;
        } else {
            $thn = ((Carbon::now()->year)-1)."/".(Carbon::now()->year);
        }

        $data = DB::table('ekstra_diikuti')
            ->join('pelatih', 'ekstra_diikuti.user_id', '=', 'pelatih.user_id')
            ->select('pelatih.*', 'ekstra_diikuti.*')
            ->where('ekstra_diikuti.user_id', Auth::user()->id)
            ->where('tahun_ajaran', $request->cari ? $request->cari : $thn)
            ->get();

        $thn_diikuti = DB::table('ekstra_diikuti')
            ->where('ekstra_diikuti.user_id', Auth::user()->id)
            ->get();

        if($data == '[]'){
        } else {
            foreach($data as $id){
                // Get Detail id
                $data_ekstra = DetailEkstra::where('id_ekstra', $id->ekstra_id)->with('ekstra')->where('tahun_ajaran', $id->tahun_ajaran)->first();

                // If there is no detail there
                if(!$data_ekstra){
                    $diikuti = Ekstra::where('id', $id->ekstra_id)->first()->toArray();
                } else {
                    $diikuti = DetailEkstra::where('id_ekstra', $id->ekstra_id)->with('ekstra')->where('tahun_ajaran', $id->tahun_ajaran)->first()->toArray();
                }
                $absensi = DetailAbsen::where('ekstra_id', $id->ekstra_id)->where('tanggal_selesai', '>=', $current_date)->where('tanggal_mulai', "<=", $current_date)->get()->toArray();
                $diikuti['absensi'] = $absensi;
                array_push($ekstra, $diikuti);
            }
        }
        $thn = $request->cari ? $request->cari : $thn;
        return view('Pelatih.ekstra', compact('ekstra', 'data', 'thn', 'thn_diikuti'));
    }

    public function show(string $id, string $thn)
    {
        $current_date = Carbon::now()->toDateString();
        $thn_ajaran =  str_replace('-', '/', $thn);
        $absensi = DetailAbsen::where('ekstra_id', $id)->where('tanggal_selesai', '>=', $current_date)->where('tanggal_mulai', "<=", $current_date)->get()->toArray();
        $ekstra = DetailEkstra::with('ekstra')->where('id_ekstra', $id)->where('tahun_ajaran', $thn_ajaran)->first();
        if(!$ekstra){
            $ekstra = Ekstra::where('id', $id)->first();
        }

        $siswa = DB::table('ekstra_diikuti')
            ->join('siswa', 'ekstra_diikuti.user_id', '=', 'siswa.user_id')
            ->select('siswa.*', 'ekstra_diikuti.id as ekstra_diikuti')
            ->where('ekstra_id', '=', $id)
            ->where('tahun_ajaran', '=', $thn_ajaran)   
            ->get();

        $pelatih = DB::table('ekstra_diikuti')
            ->join('pelatih', 'ekstra_diikuti.user_id', '=', 'pelatih.user_id')
            ->select('pelatih.*')
            ->where('ekstra_id', '=', $id)
            ->where('tahun_ajaran', '=', $thn_ajaran)
            ->get();

        return view('Pelatih.detailekstra', compact('ekstra', 'siswa', 'pelatih', 'absensi'));
    }
}
