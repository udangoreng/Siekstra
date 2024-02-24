<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    function index(){
        return view('login');
    }

    function login(request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ],[
            'username.required' => 'Username Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
        ]);

        $credentials = [
            'username'=>$request->username,
            'password'=>$request->password,
        ];

        if(Auth::attempt($credentials)){
            if(Auth::user()->role == 'Siswa'){
                return redirect('/siswa');
            }
            else if(Auth::user()->role == 'Pelatih'){
                return redirect('/pelatih');
            }
            else if(Auth::user()->role == 'Kesiswaan'){
                return redirect('/kesiswaan');
            } else{
                return redirect('/login')->withErrors('Kesalahan!');
            }
        } else{
            return redirect('/login')->withErrors('Username atau Password Salah!');
        }
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function username()
    {
        return 'username';
    }

    public function roleRedir()
    {
        if(Auth::user()->role == 'Siswa'){
            return redirect('/siswa');
        }
        else if(Auth::user()->role == 'Pelatih'){
            return redirect('/pelatih');
        }
        else if(Auth::user()->role == 'Kesiswaan'){
            return redirect('/kesiswaan');
        } else{
            return redirect('/login')->withErrors('Kesalahan!');
        }
    }

}
