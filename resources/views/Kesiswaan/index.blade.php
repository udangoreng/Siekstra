@extends('layouts.kesiswaan')
@section('title', 'Kesiswaan')
@section('main')
    <div class="kesiswaan-section">
        <h2 class="fw-bold">Selamat datang, {{ $username }}</h2>
        <div class="d-flex mt-3">
            <div class="p-3 bg-info bg-opacity-10 border-start border-info border-5 me-5">
                <h4>Ekstrakurikuler</h4>
                {{ count($ekstra) }}
            </div>

            <div class="p-3 bg-danger bg-opacity-10 border-start border-danger border-5 me-5">
                <h4>Pelatih</h4>
                {{ count($pelatih) }}
            </div>

            <div class="p-3 bg-warning bg-opacity-10 border-start border-warning border-5 me-5">
                <h4>Siswa</h4>
                {{ count($siswa) }}
            </div>

            <div class="p-3 bg-success bg-opacity-10 border-start border-success border-5 me-5">
                <h4>Jurnal</h4>
                {{ count($jurnal) }}
            </div>

            <div class="p-3 bg-primary bg-opacity-10 border-start border-primary border-5 me-5">
                <h4>Kegiatan</h4>
                {{ count($absen) }}
            </div>
        </div>

        {{ now()->locale('id')->dayName }}
    </div>
@endsection
