<?php

use App\Http\Controllers\Kesiswaan\AbsensiController;
use App\Http\Controllers\Kesiswaan\EkstraController as EkstraController;
use App\Http\Controllers\Kesiswaan\KesiswaanController as KesiswaanController;
use App\Http\Controllers\Kesiswaan\PelatihController as PelatihController;
use App\Http\Controllers\Kesiswaan\SiswaController as SiswaController;
use App\Http\Controllers\Pelatih\EkstraController as PelatihEkstraController;
use App\Http\Controllers\Pelatih\PelatihController as PelatihPelatihController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\Siswa\EkstraController as SiswaEkstraController;
use App\Http\Controllers\Siswa\SiswaController as SiswaSiswaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [SessionController::class, 'index']);
    Route::post('/login', [SessionController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/home', function () {
        return redirect('logout');
    });
    Route::prefix('kesiswaan')->middleware('role:Kesiswaan')->group(function(){
        Route::get('', [KesiswaanController::class, 'login']);

        Route::prefix('ekstra')->group(function(){
            Route::get('', [EkstraController::class, 'index']);
            Route::get('{id}', [EkstraController::class, 'show']);
            Route::get('delete/{id}', [EkstraController::class, 'destroy']);
            Route::post('add', [EkstraController::class, 'store']);
            Route::post('edit/{id}', [EkstraController::class, 'update']);
        });

        Route::prefix('pelatih')->group(function(){
            Route::get('', [PelatihController::class, 'index']);
            Route::get('{id}', [PelatihController::class, 'show']);
            Route::get('delete/{id}', [PelatihController::class, 'destroy']);
            Route::post('/add', [PelatihController::class, 'store']);
            Route::post('/edit/{id}', [PelatihController::class, 'update']);
            Route::post('/assign/{id}', [PelatihController::class, 'assign']);
            Route::post('/cancel/{id}', [PelatihController::class, 'cancel']);
        });

        Route::prefix('siswa')->group(function(){
            Route::get('', [SiswaController::class, 'index']);
            Route::get('{id}', [SiswaController::class, 'show']);
            Route::get('delete/{id}', [SiswaController::class, 'destroy']);
            Route::post('/add', [SiswaController::class, 'store']);
            Route::post('/edit/{id}', [SiswaController::class, 'update']);
        });

        Route::prefix('absensi')->group(function(){
            Route::get('', [AbsensiController::class, 'absensi']);
        });

        Route::prefix('kegiatan')->group(function(){
            Route::get('', [AbsensiController::class, 'kegiatan']);
            Route::post('/add', [AbsensiController::class, 'store']);
        });
    });

    Route::prefix('pelatih')->middleware('role:Pelatih')->group(function(){
        Route::get('', [PelatihPelatihController::class, 'login']);

        Route::prefix('ekstra')->group(function(){
            Route::get('', [PelatihEkstraController::class, 'index']);
        });
    });

    Route::prefix('siswa')->middleware('role:Siswa')->group(function(){
        Route::get('', [SiswaSiswaController::class, 'login']);
        Route::get('/ekstra', [SiswaEkstraController::class, 'index']);
        Route::get('/profil', [SiswaSiswaController::class, 'profil']);
        Route::get('/test', [SiswaEkstraController::class, 'create']);
        Route::post('/edit/{id}', [SiswaSiswaController::class, 'update']);
    });


    Route::get('/logout', [SessionController::class, 'logout']);
});