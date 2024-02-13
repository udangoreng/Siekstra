<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\DetailEkstra;
use App\Models\Ekstra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class EkstraController extends Controller
{
    
    public function index()
    {
        $data = Ekstra::with('pelatih')->get();

        return view('Kesiswaan.ekstra', ['data'=>$data]);

        //Filter
    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_ekstra'=>'required',
            'nama_ekstra'=>'required',
            'deskripsi'=>'required',
        ],[
            'kode_ekstra.required'=>'Harap Isi Kode Ekstrakurikuler',
            'nama_ekstra.required'=>'Harap Isi Nama Ekstrakurikuler',
            'deskripsi.required'=>'Harap Isi Deskripsi Ekstrakurikuler',
        ]);
        
        if($validator->fails()){
            $message='';
            foreach ($validator->errors()->messages() as $value){
                $message .=  $value[0].'<br>';
            }

            alert()->error('Terjadi Kesalahan', $message)->toHtml();
            return redirect()->back();
        } else {
            $data = Ekstra::create([
                'kode_ekstra' => $request->kode_ekstra,
                'nama_ekstra' => $request->nama_ekstra,
                'deskripsi_ekstra' => $request->deskripsi,
            ]);
            
            if($data){
                toast('Data Berhasil Ditambahkan','success');
                return redirect('/kesiswaan/ekstra');
            }
        }
    }

    
    public function show(string $id)
    {
        $ekstra = Ekstra::with('pelatih')->with('siswa')->where('id', $id)->first();
        $detail = DetailEkstra::where('id_ekstra', $id)->first();

        if($detail){
            $ekstra = array_merge($ekstra->toArray(), $detail->toArray());
            return view('Kesiswaan.editekstra', ['id'=>$id, 'ekstra'=>(object) $ekstra]);
        }

        // Lihat Ekstra, jika ada dengan id yang sama update.
        // Untuk tahun ajaran cek hari, jika > Juli, tahun +1;
        // Halaman data kosong alias 404
        return view('Kesiswaan.editekstra', ['id'=>$id, 'ekstra'=>$ekstra]);
    }


    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_ekstra'=>'required',
            'kode_ekstra'=>'required',
            'deskripsi_ekstra'=>'required',
            'id'=>'required',
            'hari'=>'required',
            'waktu_mulai'=>'required',
            'waktu_selesai'=>'required',
        ],[
            'nama_ekstra.required'=>'Harap Isi Nama Ekstrakurikuler',
            'kode_ekstra.required'=>'Harap Isi Kode Ekstrakurikuler',
            'deskripsi_ekstra.required'=>'Harap Isi Deskripsi Ekstrakurikuler',
            'hari.required'=>'Harap Isi Hari Ekstrakurikuler',
            'id.required'=>'Terjadi Kesalahan',
            'waktu_mulai.required'=>'Harap Isi Waktu Mulai Ekstrakurikuler',
            'waktu_mulai.required'=>'Harap Isi Waktu Mulai Ekstrakurikuler',
            'waktu_selesai.required'=>'Harap Isi Waktu Selesai Ekstrakurikuler',
        ]);

         if($validator->fails()){
            $message='';
            foreach ($validator->errors()->messages() as $value){
                $message .=  $value[0].'<br>';
            }

            alert()->error('Terjadi Kesalahan', $message)->toHtml();
            return redirect()->back();
        } else {
            $ekstra = Ekstra::find($id);
            $updetail = [
                'id_ekstra'=>$request->id,
                'tahun_ajaran'=>$request->tahun_ajaran,
                'hari'=>$request->hari,
                'waktu_mulai'=>$request->waktu_mulai,
                'waktu_selesai'=>$request->waktu_selesai,
            ];
            $updata = [
                'kode_ekstra'=>$request->kode_ekstra,
                'nama_ekstra'=>$request->nama_ekstra,
                'deskripsi_ekstra'=>$request->deskripsi_ekstra,
            ];

            if($ekstra){
                $details = DetailEkstra::where('id_ekstra', $id)->first();
                if($details){
                    DetailEkstra::where('id_ekstra', $id)->update($updetail);
                } else{
                    DetailEkstra::create($updetail);
                }
                Ekstra::where('id', $id)->update($updata);
                Alert::success('Berhasil Mengubah', 'Berhasil Mengubah Ekstrakurikuler');
            }
        }


        // Jika gagal mengubah
        return redirect('/kesiswaan/ekstra/'.$request->id);
        // Check whether the tahun_ajaran is the current one, is not, create new data.
    }

    
    public function destroy(string $id)
    {
        $data = Ekstra::where('id', $id);
        $detail = DetailEkstra::where('id_ekstra', $id);
        if($data){
            $data->delete();
            $detail->delete();
            Alert::success('Berhasil Menghapus', 'Berhasil Menghapus Ekstrakurikuler');
            return redirect('/kesiswaan/ekstra');
        }
    }
}
