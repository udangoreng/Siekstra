<?php

namespace App\Http\Controllers\Pelatih;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\DetailAbsen;
use App\Models\DetailEkstra;
use App\Models\Jurnal;
use App\Models\Pelatih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiController extends Controller
{

    public function index()
    {
        $ekstra = [];
        $ekstra_id = Pelatih::with('ekstra')->where('user_id', Auth::user()->id)->first();
        foreach ($ekstra_id['ekstra'] as $id){
            array_push($ekstra, $id->id);
        }
        $absen = DetailAbsen::with('absensi', 'ekstra')->whereIn('ekstra_id', $ekstra)->get();
        return view('pelatih.riwayatabsensi', ['absen' => $absen]);
    }

    public function show(string $id)
    {
        $siswa_id =[];
        $detail = DetailAbsen::where('id', $id)->first();
        $month = date_parse_from_format("Y-m-d", $detail->tanggal_mulai);
        if ($month['month'] >= 7){
            $thn_ajaran = substr($detail->tanggal_mulai, 0, 4)."/".(substr($detail->tanggal_mulai, 0, 4))+1;
        } else {
            $thn_ajaran = ((substr($detail->tanggal_mulai, 0, 4))-1)."/".(substr($detail->tanggal_mulai, 0, 4));
        }
        $data = Absensi::with('user', 'siswa')->where('absensi_id', $detail->absensi_id)->get();

        if ($data == '[]'){
            $siswa = DB::table('ekstra_diikuti')
            ->join('siswa', 'ekstra_diikuti.user_id', '=', 'siswa.user_id')
            ->select('siswa.*')
            ->where('ekstra_id', '=', $detail->ekstra_id)
            ->where('tahun_ajaran', '=', $thn_ajaran)
            ->get();
        } else{
            foreach ($data->toArray() as $siswa) {
                array_push($siswa_id, $siswa['user_id']);
            }
            $siswa = DB::table('ekstra_diikuti')
            ->join('siswa', 'ekstra_diikuti.user_id', '=', 'siswa.user_id')
            ->select('siswa.*')
            ->where('ekstra_id', '=', $detail->ekstra_id)
            ->where('tahun_ajaran', '=', $thn_ajaran)
            ->whereNotIn('siswa.user_id', $siswa_id)
            ->get();
        }

        $jurnal = Jurnal::where('absensi_id', $id)->get();
        return view('Pelatih.absensi', ['absen'=>$data, 'detail'=>$detail, 'siswa'=>$siswa, 'jurnal'=>$jurnal]);
    }

    public function absen(request $request)
    {
        $validator = Validator::make($request->all(), [
            'keterangan'=>'required',
        ],[
            'keterangan.required'=>'Harap Isi Keterangan',
        ]);

        if($validator->fails()){
            $message='';
            foreach ($validator->errors()->messages() as $value){
                $message .=  $value[0].'<br>';
            }
            alert()->error('Terjadi Kesalahan', $message)->toHtml();
            return redirect()->back();
        } else {
            $user_id = Auth::user()->id;
            $telah = Absensi::where('absensi_id', $request->absensi_id)->where('user_id', $user_id)->first();
            if(!$telah){
                $absen = Absensi::create([
                    'absensi_id' => $request->absensi_id,
                    'user_id' => $user_id,
                    'ekstra_id' => $request->ekstra_id,
                    'status' => 'Dikonfirmasi',
                    'keterangan' => $request->keterangan,
                ]);

                if($absen){
                    Alert::success('Sukses', 'Absensi Anda Telah Dicatat');
                    return redirect()->back();
                } 
            } else {
                Alert::warning('Perhatian', 'Anda Telah Melakukan Absen Sebelumnya');
                return redirect()->back();
            }
        }
    }

    public function absenSiswa(request $request)
    {
        $validator = Validator::make($request->all(), [
            'keterangan'=>'required',
        ],[
            'keterangan.required'=>'Harap Isi Keterangan',
        ]);

        if($validator->fails()){
            $message='';
            foreach ($validator->errors()->messages() as $value){
                $message .=  $value[0].'<br>';
            }
            alert()->error('Terjadi Kesalahan', $message)->toHtml();
            return redirect()->back();
        } else {
            $telah = Absensi::where('absensi_id', $request->absensi_id)->where('user_id', $request->user_id)->first();
            if(!$telah){
                $absen = Absensi::create([
                    'absensi_id' => $request->absensi_id,
                    'user_id' => $request->user_id,
                    'ekstra_id' => $request->ekstra_id,
                    'status' => 'Dikonfirmasi',
                    'keterangan' => $request->keterangan,
                ]);

                if($absen){
                    Alert::success('Sukses', 'Absensi Anda Telah Dicatat');
                    return redirect()->back();
                } 
            } else {
                Alert::warning('Perhatian', 'Anda Telah Melakukan Absen Sebelumnya');
                return redirect()->back();
            }
        }
    }

    public function confirm(request $request)
    {
        $data = Absensi::where('absensi_id', $request->absensi_id)->where('user_id', $request->user_id)->first();
        $updata = [
            'keterangan' => $request->keterangan, 
            'status' => $request->status
        ];

        $update = $data->update($updata);
        if($update){
                toast('Berhasil Mengubah','success');
                return redirect()->back();
            }
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
            $absen = DetailAbsen::where('id', $request->id);
            $updata = [
                'absensi_id'=>$request->absensi_id,
                'ekstra_id'=>$request->ekstrakurikuler,
                'kategori'=>$request->kategori,
                'deskripsi'=>$request->deskripsi,
                'tanggal_mulai'=>$request->tanggal_mulai,
                'tanggal_selesai'=>$request->tanggal_selesai,
                'waktu_mulai'=>$request->waktu_mulai,
                'waktu_selesai'=>$request->waktu_selesai,
            ];
            if($absen){
                $absen->update($updata);
                Alert::success('Berhasil', 'Berhasil Mengubah Data');
                return redirect()->back();
            }
        }
    }
}
