<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\DetailAbsen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AbsensiController extends Controller
{
    public function index()
    {
        $month = Carbon::now()->month;
        if ($month >= 7){
            $thn = Carbon::now()->year."/".(Carbon::now()->year)+1;
            $awal = date('Y-m-d', strtotime(Carbon::now()->year.'-07-01'));
            $akhir = date('Y-m-d', strtotime(Carbon::now()->year.'-12-31'));
        } else {
            $thn = ((Carbon::now()->year)-1)."/".(Carbon::now()->year);
            $awal = date('Y-m-d', strtotime((Carbon::now()->year).'-01-01'));
            $akhir = date('Y-m-d', strtotime((Carbon::now()->year).'-06-30'));
        }

        $banyak = [];
        $data = DB::table('ekstra_diikuti')
            ->join('ekstra', 'ekstra_diikuti.ekstra_id', '=', 'ekstra.id')
            ->select('ekstra.*', 'ekstra_diikuti.*')
            ->where('user_id', '=', Auth::user()->id)
            ->where('tahun_ajaran', '=', $thn)
            ->get();

        foreach ($data as $id) {
            $count = Absensi::where('user_id', Auth::user()->id)->where('ekstra_id', $id->ekstra_id)->count();
            $total = DetailAbsen::with('ekstra')->where('ekstra_id', $id->ekstra_id)->whereBetween('tanggal_mulai', [$awal, $akhir])->whereBetween('tanggal_selesai', [$awal, $akhir])->get();
            if(!count($total) == 0 || !$count == 0){
                $percentage = ($count / count($total)) * 100;
            } else {
                $percentage = 0;
            }
            array_push($banyak,[
                'ekstra'=>$id->nama_ekstra,
                'absen'=>$count,
                'semua'=>count($total),
                'persen'=>$percentage]);
            }
            $absen = Absensi::with('detail', 'ekstra')->where('user_id', Auth::user()->id)->get();
            return view('siswa.riwayatabsen', compact('absen', 'banyak'));
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
                    } else {
                        $absen = Absensi::create([
                            'absensi_id' => $request->absensi_id,
                            'user_id' => $user_id,
                            'ekstra_id' => $request->ekstra_id,
                            'status' => 'Pending',
                            'keterangan' => $request->keterangan,
                        ]);

                        if($absen){
                            Alert::success('Sukses', 'Absensi Anda Telah Dicatat');
                            return redirect()->back();
                        }
                    }
                } elseif($current <= $detail->tanggal_mulai){
                        if($time < $detail->waktu_mulai){
                            Alert::error('Perhatian', 'Absensi Belum Dibuka!');
                            return redirect()->back();
                        } else {
                            $absen = Absensi::create([
                                'absensi_id' => $request->absensi_id,
                                'user_id' => $user_id,
                                'ekstra_id' => $request->ekstra_id,
                                'status' => 'Pending',
                                'keterangan' => $request->keterangan,
                            ]);

                            if($absen){
                                Alert::success('Sukses', 'Absensi Anda Telah Dicatat');
                                return redirect()->back();
                            }
                        }
                } else {
                    $absen = Absensi::create([
                        'absensi_id' => $request->absensi_id,
                        'user_id' => $user_id,
                        'ekstra_id' => $request->ekstra_id,
                        'status' => 'Pending',
                        'keterangan' => $request->keterangan,
                    ]);

                    if($absen){
                        Alert::success('Sukses', 'Absensi Anda Telah Dicatat');
                        return redirect()->back();
                    }
                }
            } else {
                Alert::warning('Perhatian', 'Anda Telah Melakukan Absen Sebelumnya');
                return redirect()->back();
            }
        }
    }
}
