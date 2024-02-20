<?php

namespace App\Http\Controllers\Pelatih;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Ekstra;
use App\Models\Jurnal;
use App\Models\Pelatih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class JurnalController extends Controller
{

    public function index()
    {
        $diikuti = Pelatih::with('ekstra')->where('user_id', Auth::user()->id)->first();
        $ekstra = [];
        foreach ($diikuti->toArray()['ekstra'] as $id) {
            array_push($ekstra, $id['id']);
        }

        $jurnal = Jurnal::with('detail', 'ekstra', 'pelatih')->whereIn('ekstra_id', $ekstra)->get();
        return view('Pelatih.jurnal', compact('jurnal'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ekstra_id'=>'required',
            'absensi_id'=>'required',
            'judul'=>'required',
            'jenis_kegiatan'=>'required',
            'tanggal'=>'required',
            'lokasi'=>'required',
            'deskripsi'=>'required',
        ],[
            'ekstra_id.required'=>'Harap Isi Kode Ekstrakurikuler',
            'absensi_id.required'=>'Harap Isi Nama Ekstrakurikuler',
            'judul.required'=>'Harap Isi Deskripsi Ekstrakurikuler',
            'jenis_kegiatan.required'=>'Harap Isi Deskripsi Ekstrakurikuler',
            'tanggal.required'=>'Harap Isi Deskripsi Ekstrakurikuler',
            'lokasi.required'=>'Harap Isi Deskripsi Ekstrakurikuler',
            'deskripsi.required'=>'Harap Isi Deskripsi Jurnal',
        ]);
        
        if($validator->fails()){
            $message='';
            foreach ($validator->errors()->messages() as $value){
                $message .=  $value[0].'<br>';
            } 

            alert()->error('Terjadi Kesalahan', $message)->toHtml();
            return redirect()->back();
        } else {
            $data = Jurnal::create([
                'ekstra_id'=>$request->ekstra_id,
                'user_id'=>Auth::user()->id,
                'absensi_id'=>$request->absensi_id,
                'judul'=>$request->judul,
                'jenis_kegiatan'=>$request->jenis_kegiatan,
                'tanggal'=>$request->tanggal,
                'lokasi'=>$request->lokasi,
                'deskripsi'=>$request->deskripsi,
            ]);

            if($data){
                Alert::success('Berhasil', 'Absensi Anda Telah Dicatat');
                return redirect()->back();
            }
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'ekstra_id'=>'required',
            'absensi_id'=>'required',
            'judul'=>'required',
            'jenis_kegiatan'=>'required',
            'tanggal'=>'required',
            'lokasi'=>'required',
            'deskripsi'=>'required',
        ],[
            'ekstra_id.required'=>'Harap Isi Kode Ekstrakurikuler',
            'absensi_id.required'=>'Harap Isi Nama Ekstrakurikuler',
            'judul.required'=>'Harap Isi Deskripsi Ekstrakurikuler',
            'jenis_kegiatan.required'=>'Harap Isi Deskripsi Ekstrakurikuler',
            'tanggal.required'=>'Harap Isi Deskripsi Ekstrakurikuler',
            'lokasi.required'=>'Harap Isi Deskripsi Ekstrakurikuler',
            'deskripsi.required'=>'Harap Isi Deskripsi Jurnal',
        ]);
        
        if($validator->fails()){
            $message='';
            foreach ($validator->errors()->messages() as $value){
                $message .=  $value[0].'<br>';
            } 

            alert()->error('Terjadi Kesalahan', $message)->toHtml();
            return redirect()->back();
        } else {

            $data = Jurnal::where('id', $id);
            $updata = [
                'ekstra_id'=>$request->ekstra_id,
                'user_id'=>Auth::user()->id,
                'absensi_id'=>$request->absensi_id,
                'judul'=>$request->judul,
                'jenis_kegiatan'=>$request->jenis_kegiatan,
                'tanggal'=>$request->tanggal,
                'lokasi'=>$request->lokasi,
                'deskripsi'=>$request->deskripsi,
            ];

            if($data){
                $data->update($updata);
                Alert::success('Berhasil', 'Berhasil Mengubah Data');
                return redirect()->back();
            }
        }
    }

    public function show(string $id)
    {
        $jurnal = Jurnal::with('detail', 'ekstra', 'pelatih')->where('id', $id)->first();
        $hadir = Absensi::with('siswa')->where('absensi_id', $jurnal['detail']->absensi_id)->get();
        return view('Pelatih.detailjurnal', compact('jurnal', 'hadir'));
    }

    public function toPDF(request $request)
    {
        $jurnal = Jurnal::with('detail', 'ekstra', 'pelatih')->where('id', $request->id)->get();
        $hadir = Absensi::with('siswa')->where('absensi_id', $jurnal[0]['detail']->absensi_id)->get();
        $pdf = PDF::loadView('pelatih.jurnalpdf', compact('jurnal', 'hadir'));
        return $pdf->stream();
    }

    public function destroy(string $id)
    {
        $data = Jurnal::where('id', $id);
        if($data){
            $data->delete();
            Alert::success('Berhasil', 'Berhasil Menghapus Jurnal');
            return redirect('pelatih/jurnal');
        }
    }
}
