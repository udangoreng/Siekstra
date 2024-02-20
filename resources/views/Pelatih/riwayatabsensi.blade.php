@extends('layouts.pelatih')
@section('title', 'Absensi')
@section('main')
    <div class="section">
        <h2>Riwayat Absensi</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
            @foreach ($absen as $item)
                <a href="/pelatih/absen/{{ $item->id }}">
                    <div class="card me-2">
                        <div class="card-body">
                            <p class="fw-semibold mb-2">{{ $item->absensi_id }}</p>
                            <p class="fw-semibold mb-2">Ekstra : {{ $item['ekstra']->nama_ekstra }}</p>
                            <div class="d-flex justify-content-between mb-3">
                                <div class="me-2">
                                    <p class="fw-semibold">Dibuka :</p>
                                    <p>{{ $item->tanggal_mulai }}</p>
                                    <p>{{ $item->waktu_mulai }}</p>
                                </div>
                                <div>
                                    <p class="fw-semibold">Ditutup :</p>
                                    <p>{{ $item->tanggal_selesai }}</p>
                                    <p>{{ $item->waktu_selesai }}</p>
                                </div>
                            </div>
                            <p class="fw-bold">Jenis Kegiatan : </p>
                            <p>{{ $item->jenis_kegiatan }}</p>
                            <p>{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
