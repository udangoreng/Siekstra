<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;
    public $table = 'jurnal';
    protected $fillable = ['ekstra_id', 'user_id', 'absensi_id', 'judul', 'jenis_kegiatan', 'lokasi', 'tanggal', 'deskripsi'];

    public function detail()
    {
        return $this->belongsTo(DetailAbsen::class, 'absensi_id', 'id');
    }

    public function ekstra()
    {
        return $this->belongsTo(Ekstra::class, 'ekstra_id', 'id');
    }

    public function pelatih()
    {
        return $this->belongsTo(Pelatih::class, 'user_id', 'user_id');
    }
}
