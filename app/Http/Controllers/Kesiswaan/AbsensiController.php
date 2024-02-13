<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\DetailAbsen;
use App\Models\Ekstra;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    public function absensi()
    {

        return view('Kesiswaan.absensi');
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
            'kategori'=>'required',
            'tanggal_mulai'=>'required',
            'tanggal_selesai'=>'required',
            'waktu_mulai'=>'required',
            'waktu_selesai'=>'required',
        ],[
            'ekstrakurikuler'=>'Harap Isi Ekstrakurikuler',
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
            $code = Ekstra::find($request->ekstrakurikuler)->first()->kode_ekstra.Carbon::now()->format('dmY');

            $data = DetailAbsen::create([
                'absensi_id'=>$code,
                'ekstra_id'=>$request->ekstrakurikuler,
                'kategori'=>$request->kategori,
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
        // Code Absensi => Request kode_ekstra + current date;
    }
}
