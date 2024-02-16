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
        Schema::create('jurnal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ekstra_id')->constrained('ekstra')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pelatih_id')->constrained('pelatih')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('absensi_id')->constrained('pelatih')->onDelete('cascade')->onUpdate('cascade');
            $table->string('judul');
            $table->string('jenis_kegiatan');
            $table->string('lokasi');
            $table->date('tanggal');
            $table->string('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal');
    }
};
