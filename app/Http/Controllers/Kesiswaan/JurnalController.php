<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index()
    {
        $jurnal = Jurnal::with('detail', 'ekstra', 'pelatih')->paginate(25);
        return view('Kesiswaan.jurnal', ['jurnal' => $jurnal]);
    }

    public function show(string $id)
    {
        $jurnal = Jurnal::with('detail', 'ekstra', 'pelatih')->where('id', $id)->first();
        return view('Pelatih.detailjurnal', ['jurnal' => $jurnal]);
    }
}
