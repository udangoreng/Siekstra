<?php

namespace App\Http\Controllers;

use App\Models\DetailEkstra;
use App\Models\Ekstra;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function home()
    {
        $month = Carbon::now()->month;
        if ($month >= 7){
            $thn = Carbon::now()->year."/".(Carbon::now()->year)+1;
        } else {
            $thn = ((Carbon::now()->year)-1)."/".(Carbon::now()->year);
        }
        $ekstra = [];
        $data = Ekstra::get();
        foreach ($data as $item) {
            $diikuti = DetailEkstra::with('ekstra')->where('id_ekstra', $item->id)->where('tahun_ajaran', $thn)->get();
            if($diikuti == '[]'){
                $diikuti = Ekstra::where('id', $item->id)->get();
            }
            array_push($ekstra, $diikuti);
        }
        $siswa = count(Siswa::get());
        return view('landing', compact('ekstra', 'siswa'));
    }
}
