<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_absen', function (Blueprint $table) {
            $table->id();
            $table->string('absensi_id');
            $table->foreignId('ekstra_id')->constrained('ekstra')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('kategori', ['Pertemuan Rutin', 'Kegiatan', 'Khusus'])->default('Pertemuan Rutin');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_absen');
    }
};
