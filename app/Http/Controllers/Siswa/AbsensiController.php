<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\DetailAbsen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiController extends Controller
{
    public function index()
    {
        $absen = Absensi::with('detail')->where('user_id', Auth::user()->id)->get();
        return view('siswa.riwayatabsen', ['absen'=>$absen]);
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
            $detail = DetailAbsen::where('absensi_id', $request->absensi_id)->first();
            $time = Carbon::now()->format('H:i:s');
            $current = Carbon::now()->toDateString();
            
            if(!$telah){
                if($current >= $detail->tanggal_selesai ){
                    if($time > $detail->waktu_selesai){
                        $absen = Absensi::create([
                            'absensi_id' => $request->absensi_id,
                            'user_id' => $user_id,
                            'ekstra_id' => $request->ekstra_id,
                            'status' => 'Ditolak',
                            'keterangan' => $request->keterangan,
                        ]);
                    }
                } elseif($current <= $detail->tanggal_mulai){
                    if($time < $detail->waktu_mulai){
                        Alert::error('Perhatian', 'Absensi Belum Dibuka!');
                        return redirect()->back();
                    }
                } else {
                    $absen = Absensi::create([
                        'absensi_id' => $request->absensi_id,
                        'user_id' => $user_id,
                        'ekstra_id' => $request->ekstra_id,
                        'status' => 'Pending',
                        'keterangan' => $request->keterangan,
                    ]);
                }
        
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
}
