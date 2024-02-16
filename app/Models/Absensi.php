<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    public $table = 'absensi';
    protected $fillable = ['absensi_id', 'user_id', 'ekstra_id', 'status', 'keterangan'];

    public function detail()
    {
        return $this->belongsTo(DetailAbsen::class, 'absensi_id', 'absensi_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'user_id', 'user_id');
    }

    public function ekstra()
    {
        return $this->belongsTo(Ekstra::class, 'ekstra_id', 'id');
    }
}
