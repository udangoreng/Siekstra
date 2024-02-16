@extends('layouts.pelatih')
@section('title', 'Ekstrakurikuler')
@section('main')
    <div class="section me-3">
        @if (array_key_exists('ekstra', $ekstra->toArray()))
            <h2 class="fw-bold">{{ $ekstra['ekstra']->nama_ekstra }}</h2>
        @else
            <h2 class="fw-bold">{{ $ekstra->nama_ekstra }}</h2>
        @endif
        <h6 class="fw-bold">
            Pelatih :
            @foreach ($pelatih as $item)
                {{ $item->nama_pelatih }}.
            @endforeach
        </h6>
        @if (array_key_exists('ekstra', $ekstra->toArray()))
            <div class="card my-3">
                <div class="card-body">
                    <div class="mb-3">
                        <p class="fw-bold">Deskripsi</p>
                        {{ $ekstra['ekstra']->deskripsi_ekstra }}
                    </div>
                    <div class="mb-3">
                        <p class="fw-bold">Jadwal</p>
                        <p class="fw-semibold">{{ $ekstra->hari }}</p>
                        {{ substr($ekstra->waktu_mulai, 0, 5) }} - {{ substr($ekstra->waktu_selesai, 0, 5) }}
                    </div>
                </div>
            </div>
        @else
            <div class="card my-3">
                <div class="card-body">
                    <div class="mb-3">
                        <p class="fw-bold">Deskripsi</p>
                        {{ $ekstra->deskripsi_ekstra }}
                    </div>
                    <div class="mb-3">
                        <p class="fw-bold">Jadwal</p>
                        <p class="fw-semibold">-</p>
                        -
                    </div>
                </div>
            </div>
        @endif
        <div class="card my-2">
            <div class="card-body">
                <p class="fw-bold mb-3">Absensi</p>
                <p>Modal add absensi</p>
                @foreach ($absensi as $item)
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 p-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between fw-semibold mb-3">
                                    <p>Modal edit Absensi</p>
                                    <h6>{{ $item['absensi_id'] }}</h6>
                                </div>
                                <p class="mb-3">{{ $item['deskripsi'] }}</p>
                                <div class="d-flex mb-3">
                                    <div class="me-4">
                                        <p class="fw-semibold">Dibuka</p>
                                        <p>{{ $item['tanggal_mulai'] }} |
                                            {{ substr($item['waktu_mulai'], 0, 5) }}</p>
                                    </div>
                                    <div>
                                        <p class="fw-semibold">Ditutup</p>
                                        <p>{{ $item['tanggal_selesai'] }} | {{ substr($item['waktu_selesai'], 0, 5) }}</p>
                                    </div>
                                </div>
                                <a href="/pelatih/absen/{{ $item['id'] }}">
                                    <button class="btn btn-green">
                                        Lihat Absen
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card my-2">
            <div class="card-body">
                <p class="fw-bold">Anggota</p>
                @foreach ($siswa as $item)
                    {{ $item->nama_siswa }}
                @endforeach
            </div>
        </div>
    @endsection
