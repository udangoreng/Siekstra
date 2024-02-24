<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pelatih extends Model
{
    use HasFactory;
    public $table = 'pelatih';
    protected $fillable = ['user_id', 'NIP', 'nama_pelatih', 'nomor_hp_pelatih', 'alamat_pelatih'];

    public function ekstra()
    {
        return $this->belongsToMany(Ekstra::class, 'ekstra_diikuti', 'user_id', 'ekstra_id', 'user_id')->withPivot('tahun_ajaran');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
