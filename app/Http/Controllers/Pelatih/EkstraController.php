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
    public function index()
    {
        $ekstra_diikuti = [];
        $current_date = Carbon::now()->toDateString();
        $month = Carbon::now()->month;
        if ($month >= 7){
            $thn_ajaran = Carbon::now()->year."/".(Carbon::now()->year)+1;
        } else {
            $thn_ajaran = ((Carbon::now()->year)-1)."/".(Carbon::now()->year);
        }

        $data = Pelatih::with('ekstra')->where('user_id', Auth::user()->id)->first();
        if(count($data['ekstra']) < 1){

        } else {
            foreach($data['ekstra'] as $ekstra){
                // Get Detail Ekstra
                $data_ekstra = DetailEkstra::where('id_ekstra', $ekstra->id)->with('ekstra')->where('tahun_ajaran', $thn_ajaran)->first();

                // If there is no detail there
                if(!$data_ekstra){
                    $diikuti = Ekstra::where('id', $ekstra->id)->first()->toArray();
                } else {
                    $diikuti = DetailEkstra::where('id_ekstra', $ekstra->id)->with('ekstra')->where('tahun_ajaran', $thn_ajaran)->first()->toArray();
                }
                $absensi = DetailAbsen::where('ekstra_id', $ekstra->id)->where('tanggal_selesai', '>=', $current_date)->where('tanggal_mulai', "<=", $current_date)->get()->toArray();
                $diikuti['absensi'] = $absensi;
                array_push($ekstra_diikuti, $diikuti);
            }
        }
        return view('Pelatih.ekstra', ['ekstra'=>$ekstra_diikuti, 'thn'=>$thn_ajaran]);
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

        // $jurnal = Jurnal::where('ekstra_id', $id)->all();
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

        return view('Pelatih.detailekstra', ['ekstra' => $ekstra, 'siswa'=>$siswa, 'pelatih'=>$pelatih, 'absensi'=>$absensi]);
    }
}
