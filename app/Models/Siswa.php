<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    public $table = 'siswa';
    protected $fillable = ['user_id', 'NIS', 'nama_siswa', 'kelas', 'tahun_pelajaran', 'nomor_hp_siswa', 'alamat_siswa', 'nilai'];

    public function ekstra()
    {
        return $this->belongsToMany(Ekstra::class, 'ekstra_diikuti', 'user_id', 'ekstra_id', 'user_id')->withPivot('tahun_ajaran');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
