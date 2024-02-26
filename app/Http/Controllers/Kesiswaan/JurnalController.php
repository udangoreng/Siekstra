<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Ekstra;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class JurnalController extends Controller
{
    public function index(request $request)
    {
        $ekstra = Ekstra::all();
        $jurnal = Jurnal::with('detail', 'ekstra', 'pelatih')->latest()->paginate(10);
        if($request->cari or $request->ekstra){
            $jurnal = Jurnal::with('detail', 'ekstra', 'pelatih')
            ->where('ekstra_id', $request->ekstra)
            ->orWhere('judul', 'LIKE', '%'.$request->cari.'%')
            ->paginate(10);
        }

        if($request->tanggal_mulai){
            $jurnal = Jurnal::with('detail', 'ekstra', 'pelatih')
            ->where('tanggal', '>=', $request->tanggal_mulai)
            ->paginate(10);
        }

        if($request->tanggal_selesai){
            $jurnal = Jurnal::with('detail', 'ekstra', 'pelatih')
            ->where('tanggal', '<=', $request->tanggal_selesai)
            ->paginate(10);
        }
        return view('Kesiswaan.jurnal', compact('jurnal', 'ekstra'));
    }

    public function show(string $id)
    {
        $jurnal = Jurnal::with('detail', 'ekstra', 'pelatih')->where('id', $id)->first();
        return view('Pelatih.detailjurnal', ['jurnal' => $jurnal]);
    }

    public function toPDF(request $request)
    {
        $jurnal = Jurnal::with('detail', 'ekstra', 'pelatih')->where('id', $request->id)->get();
        $hadir = Absensi::with('siswa')->where('absensi_id', $jurnal[0]['detail']->absensi_id)->get();
        $pdf = PDF::loadView('kesiswaan.jurnalpdf', compact('jurnal', 'hadir'));
        return $pdf->stream();
    }
}
