<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\DetailAbsen;
use App\Models\DetailEkstra;
use App\Models\Ekstra;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class EkstraController extends Controller
{
    public function index(request $request)
    {
        $current_date = Carbon::now()->toDateString();
        $month = Carbon::now()->month;
        if ($month >= 7){
            $thn = Carbon::now()->year."/".(Carbon::now()->year)+1;
        } else {
            $thn = ((Carbon::now()->year)-1)."/".(Carbon::now()->year);
        }

        $ekstra_diikuti = [];
        $id_ekstra = [];
        $data = DB::table('ekstra_diikuti')
            ->join('siswa', 'ekstra_diikuti.user_id', '=', 'siswa.user_id')
            ->select('siswa.*', 'ekstra_diikuti.*')
            ->where('ekstra_diikuti.user_id', Auth::user()->id)
            ->where('tahun_ajaran', $request->cari ? $request->cari : $thn)
            ->get();

        if($data == '[]'){
            $data = $data = DB::table('siswa')
            ->where('user_id', Auth::user()->id)
            ->get();
        }
        
        foreach($data as $ekstra){
            $ekstra = collect($ekstra);
            if(array_key_exists('ekstra_id', $ekstra->toArray())){
                // Get Detail Ekstra
                $data_ekstra = DetailEkstra::where('id_ekstra', $ekstra['ekstra_id'])->with('ekstra')->where('tahun_ajaran', $ekstra['tahun_ajaran'])->first();

                // If there is no detail there
                if(!$data_ekstra){
                    $diikuti = Ekstra::where('id', $ekstra['ekstra_id'])->first()->toArray(); 
                } else {
                     $diikuti = DetailEkstra::where('id_ekstra', $ekstra['ekstra_id'])->with('ekstra')->where('tahun_ajaran', $ekstra['tahun_ajaran'])->first()->toArray();
                }
                $absensi = DetailAbsen::where('ekstra_id', $ekstra['ekstra_id'])->where('tanggal_selesai', '>=', $current_date)->where('tanggal_mulai', "<=", $current_date)->where('kategori', "!=", 'Pendaftaran')->get()->toArray();
                    $diikuti['absensi'] = $absensi;
                array_push($ekstra_diikuti, $diikuti);
                array_push($id_ekstra, $ekstra['ekstra_id']);
                $khusus = DetailAbsen::with('ekstra', 'detail')->where('kategori', 'Pendaftaran')->where('tanggal_selesai', '>=', $current_date)->where('tanggal_mulai', "<=", $current_date)->whereNotIn('ekstra_id', $id_ekstra)->get();
            } else {
                $khusus = [];
                if($request->cari == $thn){
                    $khusus = DetailAbsen::with('ekstra', 'detail')->where('kategori', 'Pendaftaran')->where('tanggal_selesai', '>=', $current_date)->where('tanggal_mulai', "<=", $current_date)->get();
                }
            }

        }
        return view('Siswa.ekstra', ['ekstra'=> $ekstra_diikuti, 'siswa'=>$data, 'khusus'=>$khusus, 'thn'=>$thn]);
    }

    public function daftar(request $request)
    {
        $banyak = DB::table('ekstra_diikuti')
                ->where('user_id', $request->user_id)
                ->where('tahun_ajaran', $request->tahun_ajaran)
                ->get();

        if(count($banyak) > 3){
            Alert::warning('Perhatian', 'Anda Telah Mendaftar Lebih Dari 3 Ekstra!');
            return redirect('/siswa/ekstra/');
        } else {
            $data = DB::table('ekstra_diikuti')
                ->where('user_id', $request->user_id)
                ->where('ekstra_id', $request->ekstra_id)
                ->where('tahun_ajaran', $request->tahun_ajaran)
                ->first();
            if(!$data){
                DB::table('ekstra_diikuti')->insert([
                    'user_id' => $request->user_id, 
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'ekstra_id' => $request->ekstra_id,
                ]);

                $absen = Absensi::where('absensi_id', $request->absensi_id)->where('user_id', $request->user_id);
                if(!$absen){
                    $absen = Absensi::create([
                        'absensi_id' => $request->absensi_id,
                        'user_id' => $request->user_id,
                        'ekstra_id' => $request->ekstra_id,
                        'status' => 'Dikonfirmasi',
                        'keterangan' => 'Hadir',
                    ]);
                }
                toast('Data Berhasil Ditambahkan','success');
                return redirect('/siswa/ekstra/');
            }

            Alert::warning('Perhatian', 'Anda Telah Terdaftar di Ekstrakurikuler Ini');
            return redirect('/siswa/ekstra/');
        }
    }

    public function show(string $id, string $thn)
    {
        $data = DB::table('ekstra_diikuti')
            ->where('user_id', Auth::user()->id)
            ->where('tahun_ajaran', str_replace('-', '/', $thn))
            ->where('ekstra_id', $id)
            ->get();

        if ($data == '[]'){
            return redirect()->back();
        }
        $current_date = Carbon::now()->toDateString();
        $user = Auth::user()->name;
        $absensi = DetailAbsen::where('ekstra_id', $id)->where('tanggal_selesai', '>=', $current_date)->where('tanggal_mulai', "<=", $current_date)->where('kategori', "!=", 'Pendaftaran')->get()->toArray();
        $ekstra = DetailEkstra::with('ekstra')->where('id_ekstra', $id)->where('tahun_ajaran', str_replace('-', '/', $thn))->first();
        if(!$ekstra){
            $ekstra = Ekstra::where('id', $id)->first();
        }
        $siswa = DB::table('ekstra_diikuti')
            ->join('siswa', 'ekstra_diikuti.user_id', '=', 'siswa.user_id')
            ->select('siswa.*')
            ->where('ekstra_id', '=', $id)
            ->where('tahun_ajaran', '=', str_replace('-', '/', $thn))
            ->get();

        $pelatih = DB::table('ekstra_diikuti')
            ->join('pelatih', 'ekstra_diikuti.user_id', '=', 'pelatih.user_id')
            ->select('pelatih.*')
            ->where('ekstra_id', '=', $id)
            ->where('tahun_ajaran', '=', str_replace('-', '/', $thn))
            ->get();
        return view('Siswa.detailekstra', compact('ekstra', 'siswa', 'pelatih', 'absensi', 'user'));
    }
}
