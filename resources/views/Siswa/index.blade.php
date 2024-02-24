@extends('layouts.siswa')
@section('title', 'Dashboard Siswa')
@section('main')
    <div class="section">
        <h1 class="fw-bold">Selamat datang, {{ $username }}</h1>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2">
                <div class="card me-2" style="width: 45%">
                    <div class="card-body">
                        <h4>Jadwal Hari Ini</h4>
                        @foreach ($ekstra as $item)
                            @if ($item)
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="fw-semibold">{{ $item->ekstra->nama_ekstra }}</h5>
                                            <p class="fw-semibold">Jadwal : </p>
                                            <p>{{ $item->hari }}</p>
                                            <p>{{ substr($item->waktu_mulai, 0, 5) }} -
                                                {{ substr($item->waktu_selesai, 0, 5) }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="card" style="width: 45%">
                    <div class="card-body">
                        <h4>Absensi Aktif</h4>
                        @foreach ($absensi as $item)
                            @if ($item != '[]')
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="fw-semibold">{{ $item[0]->ekstra->nama_ekstra }}</h5>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p class="fw-semibold">Waktu Dibuka : </p>
                                                    <p>{{ $item[0]->tanggal_mulai }} |
                                                        {{ substr($item[0]->waktu_mulai, 0, 5) }}</p>
                                                </div>
                                                <div>
                                                    <p class="fw-semibold">Waktu Ditutup : </p>
                                                    <p>{{ $item[0]->tanggal_selesai }} |
                                                        {{ substr($item[0]->waktu_selesai, 0, 5) }}</p>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@endsection
