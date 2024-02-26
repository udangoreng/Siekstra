<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Kesiswaan\AbsensiController;
use App\Http\Controllers\Kesiswaan\EkstraController as EkstraController;
use App\Http\Controllers\Kesiswaan\JadwalController;
use App\Http\Controllers\Kesiswaan\JurnalController;
use App\Http\Controllers\Kesiswaan\KesiswaanController as KesiswaanController;
use App\Http\Controllers\Kesiswaan\PelatihController as PelatihController;
use App\Http\Controllers\Kesiswaan\SiswaController as SiswaController;
use App\Http\Controllers\Pelatih\AbsensiController as PelatihAbsensiController;
use App\Http\Controllers\Pelatih\EkstraController as PelatihEkstraController;
use App\Http\Controllers\Pelatih\JurnalController as PelatihJurnalController;
use App\Http\Controllers\Pelatih\PelatihController as PelatihPelatihController;
use App\Http\Controllers\Pelatih\SiswaController as PelatihSiswaController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\Siswa\AbsensiController as SiswaAbsensiController;
use App\Http\Controllers\Siswa\EkstraController as SiswaEkstraController;
use App\Http\Controllers\Siswa\SiswaController as SiswaSiswaController;
use App\Models\Jurnal;
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

Route::get('', [Controller::class, 'home']);

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [SessionController::class, 'index']);
    Route::post('/login', [SessionController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [SessionController::class, 'roleRedir']);

    Route::prefix('kesiswaan')->middleware('role:Kesiswaan')->group(function(){
        Route::get('', [KesiswaanController::class, 'login']);

        Route::prefix('absen')->group(function(){
            Route::get('', [AbsensiController::class, 'absensi']);
        });

        Route::prefix('ekstra')->group(function(){
            Route::get('', [EkstraController::class, 'index']);
            Route::get('{id}/{thn}', [EkstraController::class, 'show']);
            Route::get('delete/{id}', [EkstraController::class, 'destroy']);
            Route::post('add', [EkstraController::class, 'store']);
            Route::post('{id}', [EkstraController::class, 'redir']);
            Route::post('/assign/{id}', [EkstraController::class, 'assign']);
            Route::post('/edit/{id}', [EkstraController::class, 'update']);

        });

        Route::prefix('jadwal')->group(function() {
            Route::get('', [JadwalController::class, 'index']);
            Route::post('edit/{id}', [JadwalController::class, 'update']);
        });

        Route::prefix('jurnal')->group(function() {
            Route::get('', [JurnalController::class, 'index']);
            Route::post('download', [JurnalController::class, 'toPDF']);
        });

        Route::prefix('kegiatan')->group(function(){
            Route::get('', [AbsensiController::class, 'kegiatan']);
            Route::get('{id}', [AbsensiController::class, 'show']);
            Route::post('/add', [AbsensiController::class, 'store']);
            Route::get('delete/{id}', [AbsensiController::class, 'destroy']);
            Route::post('/edit/{id}', [AbsensiController::class, 'update']);
        });

        Route::prefix('kesiswaan')->group(function(){
            Route::get('', [KesiswaanController::class, 'index']);
            Route::get('delete/{id}', [KesiswaanController::class, 'destroy']);
            Route::post('/add', [KesiswaanController::class, 'store']);
            Route::post('/{id}', [KesiswaanController::class, 'update']);
        });

        Route::prefix('pelatih')->group(function(){
            Route::get('', [PelatihController::class, 'index']);
            Route::get('{id}', [PelatihController::class, 'show']);
            Route::get('delete/{id}', [PelatihController::class, 'destroy']);
            Route::post('/add', [PelatihController::class, 'store']);
            Route::post('/assign/{id}', [PelatihController::class, 'assign']);
            Route::post('/edit/{id}', [PelatihController::class, 'update']);
            Route::post('/cancel/{id}', [PelatihController::class, 'cancel']);
        });

        Route::prefix('siswa')->group(function(){
            Route::get('', [SiswaController::class, 'index']);
            Route::get('{id}', [SiswaController::class, 'show']);
            Route::get('delete/{id}', [SiswaController::class, 'destroy']);
            Route::post('/add', [SiswaController::class, 'store']);
            Route::post('/edit/{id}', [SiswaController::class, 'update']);
            Route::post('/cancel/{id}', [SiswaController::class, 'cancel']);
        });

    });

    Route::prefix('pelatih')->middleware('role:Pelatih')->group(function(){
        Route::get('', [PelatihPelatihController::class, 'login']);
        Route::get('/profil', [PelatihPelatihController::class, 'profil']);
        Route::post('/edit/{id}', [PelatihPelatihController::class, 'update']);

        Route::prefix('absen')->group(function(){
            Route::get('', [PelatihAbsensiController::class, 'index']);
            Route::get('{id}', [PelatihAbsensiController::class, 'show']);
            Route::post('', [PelatihAbsensiController::class, 'absen']);
            Route::post('absen', [PelatihAbsensiController::class, 'absenSiswa']);
            Route::post('/confirm', [PelatihAbsensiController::class, 'confirm']);
            Route::post('download', [PelatihAbsensiController::class, 'toPDF']);
            Route::post('edit/{id}', [PelatihAbsensiController::class, 'update']);
        });

        Route::prefix('ekstra')->group(function(){
            Route::get('', [PelatihEkstraController::class, 'index']);
            Route::get('{id}/{thn}', [PelatihEkstraController::class, 'show']);
        });

        Route::prefix('siswa')->group(function(){
            Route::get('/{id}', [PelatihSiswaController::class, 'show']);
            Route::get('{id}/{thn}', [PelatihEkstraController::class, 'show']);
            Route::post('edit/{id}', [PelatihSiswaController::class, 'update']);
        });

        Route::prefix('jurnal')->group(function(){
            Route::get('', [PelatihJurnalController::class, 'index']);
            Route::get('{id}', [PelatihJurnalController::class, 'show']);
            Route::get('delete/{id}', [PelatihJurnalController::class, 'destroy']);
            Route::post('add', [PelatihJurnalController::class, 'store']);
            Route::post('download', [PelatihJurnalController::class, 'toPDF']);
            Route::post('{id}', [PelatihJurnalController::class, 'update']);
        });

    });

    Route::prefix('siswa')->middleware('role:Siswa')->group(function(){
        Route::get('', [SiswaSiswaController::class, 'login']);
        Route::get('/profil', [SiswaSiswaController::class, 'profil']);
        Route::post('/edit/{id}', [SiswaSiswaController::class, 'update']);
        
        Route::prefix('absen')->group(function(){
            Route::get('', [SiswaAbsensiController::class, 'show']);
            Route::get('/riwayat', [SiswaAbsensiController::class, 'index']);
            Route::post('', [SiswaAbsensiController::class, 'absen']);
         });

        Route::prefix('ekstra')->group(function(){
            Route::get('', [SiswaEkstraController::class, 'index']);
            Route::get('{id}/{thn}', [SiswaEkstraController::class, 'show']);
            Route::post('/daftar', [SiswaEkstraController::class, 'daftar']);
        });
        
    });


    Route::get('/logout', [SessionController::class, 'logout']);
});