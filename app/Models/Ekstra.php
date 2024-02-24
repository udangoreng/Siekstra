<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstra extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'ekstra';
    protected $fillable = ['kode_ekstra', 'nama_ekstra', 'deskripsi_ekstra'];

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'ekstra_diikuti', 'ekstra_id', 'user_id', 'id', 'user_id')->withPivot('tahun_ajaran');
    }

    public function pelatih()
    {
        return $this->belongsToMany(Pelatih::class, 'ekstra_diikuti', 'ekstra_id', 'user_id', 'id', 'user_id')->withPivot('tahun_ajaran');
    }

    public function absensi()
    {
        return $this->hasMany(DetailAbsen::class, 'ekstra_id', 'id');
    }

    public function detail()
    {
        return $this->hasMany(DetailEkstra::class, 'ekstra_id', 'id');
    }
}
