<?php

namespace App\Http\Controllers\Pelatih;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\DetailAbsen;
use App\Models\DetailEkstra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiController extends Controller
{
    public function show(string $id)
    {
        $detail = DetailAbsen::where('id', $id)->first();
        $data = Absensi::with('user', 'siswa')->where('absensi_id', $detail->absensi_id)->get();
        return view('Pelatih.absensi', ['absen'=>$data, 'detail'=>$detail]);
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
}
