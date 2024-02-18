<?php

namespace App\Http\Controllers\Pelatih;

use App\Http\Controllers\Controller;
use App\Models\Ekstra;
use App\Models\Jurnal;
use App\Models\Pelatih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

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
        return view('Pelatih.jurnal', ['jurnal' => $jurnal]);
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
                Alert::success('Sukses', 'Absensi Anda Telah Dicatat');
                return redirect()->back();
            }
        }
    }

    public function show(string $id)
    {
        $jurnal = Jurnal::with('detail', 'ekstra', 'pelatih')->where('id', $id)->first();
        return view('Pelatih.detailjurnal', ['jurnal' => $jurnal]);
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
