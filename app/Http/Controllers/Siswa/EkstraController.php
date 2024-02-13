<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\DetailEkstra;
use App\Models\Ekstra;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EkstraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $current_date = Carbon::now()->toDateString();
        $ekstra_diikuti = [];
        $usn = Auth::user()->id;
        $data = Siswa::with('ekstra')->where('user_id', $usn)->first();
        foreach($data->ekstra as $ekstra){
            // Sama Absensi Sekalian
            $diikuti = DetailEkstra::where('id_ekstra', $ekstra->id)->with('ekstra')->get();
            $ekstra_diikuti = array_merge($ekstra_diikuti, $diikuti->toArray());
        }
        // dd($current_date);
        return view('Siswa.ekstra', ['ekstra'=>$ekstra_diikuti]);

        // Ada Jadwal Khusus
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Add Ekstra to Siswa
        $now = Carbon::now()->month;
        if ($now == 7 || $now == 8){
            // Can open and daftar
        } else {
            // Throw unautorized error, 404 or smth
            // Kesiswaan bisa edit anggota
        }
    }

    /**
     * Store a newly created resource in storage.
     */

     // Add Ekstra to Siswa
    public function store(Request $request)
    {
        //
    }

    public function absensi()
    {
        // Untuk Absen
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
