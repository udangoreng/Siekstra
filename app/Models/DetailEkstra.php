<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailEkstra extends Model
{
    use HasFactory;
    public $table='detail_ekstra';
    protected $fillable = ['id_ekstra', 'pelatih_id', 'tahun_ajaran', 'hari', 'waktu_mulai', 'waktu_selesai'];

    public function ekstra()
    {
        return $this->belongsTo(Ekstra::class, 'id_ekstra', 'id');
    }
}
