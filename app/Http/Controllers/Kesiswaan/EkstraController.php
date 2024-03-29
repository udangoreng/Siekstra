<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\DetailEkstra;
use App\Models\Ekstra;
use App\Models\Pelatih;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class EkstraController extends Controller
{
    
    public function index(request $request)
    {
        $data = Ekstra::with('pelatih', 'siswa')->paginate(10);
        $month = Carbon::now()->month;
        if ($month >= 7){
            $thn = Carbon::now()->year."/".(Carbon::now()->year)+1;
        } else {
            $thn = ((Carbon::now()->year)-1)."/".(Carbon::now()->year);
        }

        if($request->cari){
            $data = Ekstra::with('pelatih', 'siswa')
            ->where('nama_ekstra', $request->cari)
            ->orWhere('kode_ekstra', $request->cari)
            ->paginate(10);
        }
        return view('Kesiswaan.ekstra', compact('data', 'thn'));
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

    public function redir(request $request, string $id)
    {
        $year = str_replace('/', '-', $request->tahun_ajaran);
        return redirect('/kesiswaan/ekstra/'.$id.'/'.$year);
    }

    
    public function show(request $request, string $id, string $thn)
    {
        $thn_ajaran =  str_replace('-', '/', $thn);

        $siswa = DB::table('ekstra_diikuti')
            ->join('siswa', 'ekstra_diikuti.user_id', '=', 'siswa.user_id')
            ->select('siswa.*')
            ->where('ekstra_id', '=', $id)
            ->where('tahun_ajaran', '=', $thn_ajaran)
            ->get();

        $pelatih = DB::table('ekstra_diikuti')
            ->join('pelatih', 'ekstra_diikuti.user_id', '=', 'pelatih.user_id')
            ->select('pelatih.*')
            ->where('ekstra_id', '=', $id)
            ->where('tahun_ajaran', '=', $thn_ajaran)
            ->get();

        $detail = DetailEkstra::with('ekstra')->where('id_ekstra', $id)->where('tahun_ajaran', $thn_ajaran)->first();
        $guru = Pelatih::all();

        if(!$detail){
                $ekstra = Ekstra::where('id', $id)->first();
                return view('Kesiswaan.editekstra', ['id'=>$id, 'ekstra'=>$ekstra, 'guru' => $guru, 'pelatih'=>$pelatih, 'siswa'=>$siswa, 'thn'=>$thn_ajaran]);
            }
        return view('Kesiswaan.editekstra', ['id'=>$id, 'ekstra'=>$detail, 'guru' => $guru, 'pelatih' => $pelatih, 'siswa' => $siswa, 'thn' => $thn_ajaran]);
    }


    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_ekstra'=>'required',
            'kode_ekstra'=>'required',
            'deskripsi_ekstra'=>'required',
            'tahun_ajaran'=>'required',
            'id'=>'required',
            'hari'=>'required',
            'waktu_mulai'=>'required',
            'waktu_selesai'=>'required',
        ],[
            'nama_ekstra.required'=>'Harap Isi Nama Ekstrakurikuler',
            'kode_ekstra.required'=>'Harap Isi Kode Ekstrakurikuler',
            'deskripsi_ekstra.required'=>'Harap Isi Deskripsi Ekstrakurikuler',
            'tahun_ajaran.required'=>'Harap Isi Tahun Ajaran Ekstrakurikuler',
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
                $pertahun = DetailEkstra::where('id_ekstra', $id)->where('tahun_ajaran', $request->tahun_ajaran)->first();
                if($pertahun){
                        DetailEkstra::where('id', $pertahun->id)->update($updetail);
                    } else {
                        DetailEkstra::create($updetail);
                        $thn_ajaran =  str_replace('/', '-', $request->tahun_ajaran);
                        Alert::success('Berhasil Mengubah', 'Berhasil Mengubah Ekstrakurikuler');
                        return redirect('/kesiswaan/ekstra/'.$request->id.'/'.$thn_ajaran);
                }
                Ekstra::where('id', $id)->update($updata);
                Alert::success('Berhasil Mengubah', 'Berhasil Mengubah Ekstrakurikuler');
        }

        $thn_ajaran =  str_replace('/', '-', $request->tahun_ajaran);
        return redirect('/kesiswaan/ekstra/'.$request->id.'/'.$thn_ajaran);
    }
}

    public function assign(Request $request, string $id){
        $user_id = User::where('id', $request->id)->first()->id;
        // Check if user with those excact data isnt there
        $data = DB::table('ekstra_diikuti')
                ->where('user_id', $user_id)->where('ekstra_id', $request->ekstra_id)->where('tahun_ajaran', $request->tahun_ajaran)->first();

        if(!$data){
            DB::table('ekstra_diikuti')->insert([
                'user_id' => $user_id, 
                'tahun_ajaran' => $request->tahun_pelajaran,
                'ekstra_id' => $id,
            ]);

            toast('Data Berhasil Ditambahkan','success');
            return redirect()->back();
        }

        Alert::warning('Perhatian', 'Ekstrakurikuler Telah Ditambahkan');
        return redirect()->back();
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
