<?php

namespace App\Http\Controllers\Kesiswaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KesiswaanController extends Controller
{
    function login(){
        $data = Auth::user()->name;
        return view('kesiswaan.index', ['username' => $data]);
    }
}
