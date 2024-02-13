@extends('layouts.siswa')
@section('title', 'Ekstra Saya')
@section('main')
    <div class="section me-3">
        <h2 class="fw-bold">Ekstrakurikuler Saya</h2>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-4">
                @foreach ($ekstra as $item)
                    <div class="card mx-1 my-2" style="width: 45%">
                        <div class="card-body">
                            <h4 class="fw-semibold">{{ $item['ekstra']['nama_ekstra'] }}</h4>
                            <p>{{ $item['hari'] }}</p>
                            <p>{{ $item['waktu_mulai'] }}</p>
                            <p>{{ $item['waktu_selesai'] }}</p>
                            <button class="btn btn-secondary">Kalau gada absen abu</button>
                        </div>
                    </div>
                @endforeach
                <div class="card mx-1 my-2" style="width: 45%">
                    <div class="card-body">
                        <h4 class="fw-semibold">Nama Ekstra</h4>
                        <p>Jadwal</p>
                        <button class="btn btn-secondary">Kalau gada absen abu</button>
                    </div>
                </div>
                <div class="card mx-1 my-2" style="width: 45%">
                    <div class="card-body">
                        <h4 class="fw-semibold">Nama Ekstra</h4>
                        <p>Jadwal</p>
                        <button class="btn btn-secondary">Kalau gada absen abu</button>
                    </div>
                </div>
                <div class="card mx-1 my-2" style="width: 45%">
                    <div class="card-body">
                        <h4 class="fw-semibold">Nama Ekstra</h4>
                        <p>Jadwal</p>
                        <button class="btn btn-secondary">Kalau gada absen abu</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
