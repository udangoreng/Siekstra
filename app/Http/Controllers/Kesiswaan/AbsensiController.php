<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\DetailAbsen;
use App\Models\Ekstra;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiController extends Controller
{
    public function absensi()
    {
        $absen = Absensi::with('user', 'ekstra')->paginate('25');
        return view('Kesiswaan.absensi', ['absen'=>$absen]);
    }

    public function kegiatan()
    {
        $ekstra = Ekstra::all();
        $absen = DetailAbsen::with('ekstra')->get();
        return view('Kesiswaan.kegiatan', ['ekstra'=>$ekstra, 'absen'=>$absen]);
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
            return redirect()->back();
        } else {
            $code = Ekstra::where('id', $request->ekstrakurikuler)->first()->kode_ekstra.Carbon::now()->format('dmY');

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
        $ekstra = Ekstra::all();
        $absen = DetailAbsen::where('id', $id)->with('ekstra', 'detail')->first();
        return view('Kesiswaan.editkegiatan', ['absen'=>$absen, 'ekstra'=>$ekstra]);
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
            $code = Ekstra::where('id', $request->ekstrakurikuler)->first()->kode_ekstra.Carbon::now()->format('dmY');
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
