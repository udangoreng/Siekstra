<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;
    public $table = 'jurnal';
    protected $fillable = ['ekstra_id', 'pelatih_id', 'absensi_id', 'judul', 'jenis_kegiatan', 'lokasi', 'tanggal', 'deskripsi'];
}
