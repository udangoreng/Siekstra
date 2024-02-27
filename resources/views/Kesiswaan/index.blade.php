@extends('layouts.kesiswaan')
@section('title', 'Kesiswaan')
@section('main')
    <div class="kesiswaan-section">
        <h2 class="fw-bold">Selamat datang, {{ $username }}</h2>
        <div class="d-flex my-5">
            <div class="card w-25 me-5">
                <div class="card-header">
                    Ekstrakurikuler
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>{{ count($ekstra) }}</p>
                    </blockquote>
                </div>
            </div>
            <div class="card w-25 me-5">
                <div class="card-header">
                    Siswa
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>{{ count($siswa) }}</p>
                    </blockquote>
                </div>
            </div>
            <div class="card w-25 me-5">
                <div class="card-header">
                    Pelatih
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>{{ count($pelatih) }}</p>
                    </blockquote>
                </div>
            </div>
            <div class="card w-25 me-5">
                <div class="card-header">
                    Jurnal
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>{{ count($jurnal) }}</p>
                    </blockquote>
                </div>
            </div>
            <div class="card w-25 me-5">
                <div class="card-header">
                    Kegiatan
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>{{ count($absen) }}</p>
                    </blockquote>
                </div>
            </div>
        </div>

        <div>
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2">
                    <div class="card">
                        <div class="card-body">
                            <h4>Ekstrakurikuler Hari Ini</h4>
                            <p>{{ now()->locale('id')->dayName }}, {{ date('d/m/Y') }}</p>
                            @foreach ($eks_today->unique('id_ekstra') as $item)
                                <div class="mb-3">
                                    <h6 class="fw-bold">{{ $item['ekstra']->nama_ekstra }}</h6>
                                    <p>{{ substr($item->waktu_mulai, 0, 5) }} | {{ substr($item->waktu_selesai, 0, 5) }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
