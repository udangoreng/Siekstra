<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\DetailAbsen;
use App\Models\Ekstra;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiController extends Controller
{
    public function absensi(request $request)
    {
        $absen = Absensi::with('user', 'ekstra')->latest()->paginate(10);
        $ekstra = Ekstra::all();
        if($request->cari or $request->ekstra){
            $absen = Absensi::where('ekstra_id', $request->ekstra)
            ->orWhere('absensi_id', 'LIKE', '%'.$request->cari.'%')
            ->orWhere('keterangan', $request->cari)
            ->orWhere('status', $request->cari)
            ->paginate(10);
        }

        if($request->tanggal_mulai){
            $absen = Absensi::where('created_at', '>=', $request->tanggal_mulai)
            ->paginate(10);
        } else if($request->tanggal_selesai){
            $absen = Absensi::where('created_at', '<=', $request->tanggal_selesai)
            ->paginate(10);
        } else if($request->tanggal_mulai && $request->tanggal_selesai){
            $absen = Absensi::whereBetween('created_at', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->paginate(10);
        }

        return view('Kesiswaan.absensi', compact('ekstra', 'absen'));
    }

    public function kegiatan(request $request)
    {
        $ekstra = Ekstra::all();
        $absen = DetailAbsen::with('ekstra')->latest()->paginate(10);
        if($request->cari or $request->ekstra){
            $absen = DetailAbsen::with('ekstra')
            ->where('ekstra_id', $request->ekstra)
            ->orWhere('kategori', $request->cari)
            ->orWhere('absensi_id', $request->cari)
            ->paginate(10);
        }

        if($request->tanggal_mulai){
            $absen = DetailAbsen::where('tanggal_mulai', '>=', $request->tanggal_mulai)
            ->paginate(10);
        }

        if($request->tanggal_selesai){
            $absen = DetailAbsen::where('tanggal_selesai', '<=', $request->tanggal_selesai)
            ->paginate(10);
        }

        if($request->tanggal_selesai && $request->tanggal_mulai){
            $absen = DetailAbsen::whereBetween('created_at', [$request->tanggal_mulai, $request->tanggal_selesai])
            ->paginate(10);
        }

        return view('Kesiswaan.kegiatan', compact('ekstra', 'absen'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ekstrakurikuler'=>'required',
            'deskripsi'=>'required',
            'kategori'=>'required',
            'tanggal_mulai'=>'required',
            'tanggal_selesai'=>'required',
            'waktu_mulai'=>'required',
            'waktu_selesai'=>'required',
        ],[
            'ekstrakurikuler'=>'Harap Isi Ekstrakurikuler',
            'deskripsi'=>'Harap Isi Deskripsi Absensi',
            'kategori'=>'Harap Isi Kategori Absensi',
            'tanggal_mulai'=>'Harap Isi Tanggal Mulai',
            'tanggal_selesai'=>'Harap Isi Tanggal Selesai',
            'waktu_mulai'=>'Harap Isi Waktu Mulai Absensi',
            'waktu_selesai'=>'Harap Isi Waktu Selesai Absensi',
        ]);
        
        if($validator->fails()){
            $message='';
            foreach ($validator->errors()->messages() as $value){
                $message .=  $value[0].'<br>';
            }

            alert()->error('Terjadi Kesalahan', $message)->toHtml();
            return redirect('/kesiswaan/kegiatan');
        } else {

            if($request->tanggal_selesai < $request->tanggal_mulai){
                Alert::error('Terjadi Kesalahan', 'Tanggal Tutup Tidak Bisa Lebih Dahulu Dibanding Tanggal Buka!');
                return redirect('/kesiswaan/kegiatan');
            }
            $code = Ekstra::where('id', $request->ekstrakurikuler)->first()->kode_ekstra.strtotime(Carbon::now());

            $data = DetailAbsen::create([
                'absensi_id'=>$code,
                'ekstra_id'=>$request->ekstrakurikuler,
                'kategori'=>$request->kategori,
                'deskripsi'=>$request->deskripsi,
                'tanggal_mulai'=>$request->tanggal_mulai,
                'tanggal_selesai'=>$request->tanggal_selesai,
                'waktu_mulai'=>$request->waktu_mulai,
                'waktu_selesai'=>$request->waktu_selesai,
            ]);
            
            if($data){
                toast('Data Berhasil Ditambahkan','success');
                return redirect('/kesiswaan/kegiatan');
            }
        }
    }

    public function show(string $id)
    {
        $siswa_id =[];
        $ekstra = Ekstra::all();
        $absen = DetailAbsen::where('id', $id)->with('ekstra', 'detail')->first();
        $month = date_parse_from_format("Y-m-d", $absen->tanggal_mulai);
        if ($month['month'] >= 7){
            $thn_ajaran = substr($absen->tanggal_mulai, 0, 4)."/".(substr($absen->tanggal_mulai, 0, 4))+1;
        } else {
            $thn_ajaran = ((substr($absen->tanggal_mulai, 0, 4))-1)."/".(substr($absen->tanggal_mulai, 0, 4));
        }

        $absensi = Absensi::with('user', 'siswa')->where('absensi_id', $absen->absensi_id)->get();
        $all = DB::table('ekstra_diikuti')
            ->join('siswa', 'ekstra_diikuti.user_id', '=', 'siswa.user_id')
            ->select('siswa.*')
            ->where('ekstra_id', '=', $absen->ekstra_id)
            ->where('tahun_ajaran', '=', $thn_ajaran)
            ->get();

        if ($absensi == '[]'){
            $siswa = $all;
        } else{
            foreach ($absensi->toArray() as $siswa) {
                array_push($siswa_id, $siswa['user_id']);
            }
            $siswa = DB::table('ekstra_diikuti')
            ->join('siswa', 'ekstra_diikuti.user_id', '=', 'siswa.user_id')
            ->select('siswa.*')
            ->where('ekstra_id', '=', $absen->ekstra_id)
            ->where('tahun_ajaran', '=', $thn_ajaran)
            ->whereNotIn('siswa.user_id', $siswa_id)
            ->get();
        }
        
        return view('Kesiswaan.editkegiatan', compact('absen', 'absensi', 'siswa', 'ekstra', 'all'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'ekstrakurikuler'=>'required',
            'kategori'=>'required',
            'deskripsi'=>'required',
            'tanggal_mulai'=>'required',
            'tanggal_selesai'=>'required',
            'waktu_mulai'=>'required',
            'waktu_selesai'=>'required',
        ],[
            'ekstrakurikuler'=>'Harap Isi Ekstrakurikuler',
            'kategori'=>'Harap Isi Kategori Absensi',
            'deskripsi'=>'Harap Isi Deskripsi Absensi',
            'tanggal_mulai'=>'Harap Isi Tanggal Mulai',
            'tanggal_selesai'=>'Harap Isi Tanggal Selesai',
            'waktu_mulai'=>'Harap Isi Waktu Mulai Absensi',
            'waktu_selesai'=>'Harap Isi Waktu Selesai Absensi',
        ]);

        if($validator->fails()){
            $message='';
            foreach ($validator->errors()->messages() as $value){
                $message .=  $value[0].'<br>';
            }

            alert()->error('Terjadi Kesalahan', $message)->toHtml();
            return redirect()->back();
        } else {
            $code = Ekstra::where('id', $request->ekstrakurikuler)->first()->kode_ekstra.strtotime(Carbon::now());
            $absen = DetailAbsen::where('id', $request->id)->first();
            $updata = [
                'absensi_id'=>$code,
                'ekstrakurikuler'=>$request->ekstrakurikuler,
                'deskripsi'=>$request->deskripsi,
                'kategori'=>$request->kategori,
                'tanggal_mulai'=>$request->tanggal_mulai,
                'tanggal_selesai'=>$request->tanggal_selesai,
                'waktu_mulai'=>$request->waktu_mulai,
                'waktu_selesai'=>$request->waktu_selesai,
            ];
            $absen->update($updata);
            Alert::success('Berhasil Mengubah', 'Berhasil Mengubah Absensi');
            return redirect('/kesiswaan/kegiatan/'.$request->id);
        }
    }

    public function destroy(string $id)
    {
        $data = DetailAbsen::where('id', $id)->first();
        if($data){
            $data->delete();
            Alert::success('Berhasil Menghapus', 'Berhasil Menghapus Ekstrakurikuler');
            return redirect('/kesiswaan/kegiatan');
        }
    }
}
