<?php

namespace App\Http\Controllers\Pelatih;

use App\Http\Controllers\Controller;
use App\Models\Pelatih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelatihController extends Controller
{
    function login(){
        $usn = Auth::user()->name;
        $ekstra = Pelatih::with('ekstra')->where('user_id', Auth::user()->id)->first();
        return view('pelatih.index', ['username'=> $usn, 'data'=>$ekstra]);
    }

    public function profil(){
        $user = Auth::user();
        $data = Pelatih::where('user_id', $user->id)->with('ekstra')->first();
        return view('Pelatih.profil', ['user'=> $user, 'data'=>$data]);
    }
}
