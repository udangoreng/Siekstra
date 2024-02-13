<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAbsen extends Model
{
    use HasFactory;
    public $table='detail_absen';
    protected $fillable = ['absensi_id', 'ekstra_id', 'kategori', 'tanggal_mulai', 'tanggal_selesai', 'waktu_mulai', 'waktu_selesai'];

    public function ekstra()
    {
        return $this->belongsTo(Ekstra::class, 'ekstra_id', 'id');
    }
}
