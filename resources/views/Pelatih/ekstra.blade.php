@extends('layouts.pelatih')
@section('title', 'Ekstrakurikuler')
@section('main')
    <div class="section">
        <h2>Ekstrakurikuler Saya</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
            @foreach ($ekstra as $item)
                @if (array_key_exists('ekstra', $item))
                    <a href="/pelatih/ekstra/{{ $item['ekstra']['id'] }}/{{ str_replace('/', '-', $item['tahun_ajaran']) }}">
                        <div class="card mx-1 my-3">
                            <div class="card-body">
                                <h4 class="fw-semibold mb-2">{{ $item['ekstra']['nama_ekstra'] }}</h4>
                                <p class="fw-bold mb-2">{{ $item['hari'] }}</p>
                                <div class="d-flex mb-3">
                                    <p class="overflow-auto">{{ substr($item['waktu_mulai'], 0, 5) }}
                                    </p>
                                    <p class="mx-3">|</p>
                                    <p class="overflow-auto">
                                        {{ substr($item['waktu_selesai'], 0, 5) }}</p>
                                </div>
                                <button type="button" class="btn btn-green position-relative">
                                    Lihat Detail
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ count($item['absensi']) }}
                                    </span>
                                </button>
                            </div>
                        </div>
                    </a>
                @else
                    <a href="/pelatih/ekstra/{{ $item['id'] }}/{{ str_replace('/', '-', $thn) }}">
                        <div class="card mx-1 my-3">
                            <div class="card-body">
                                <h4 class="fw-semibold mb-2">{{ $item['nama_ekstra'] }}</h4>
                                <p class="fw-bold mb-2">-</p>
                                <div class="d-flex mb-3">
                                    <p class="overflow-auto">-
                                    </p>
                                    <p class="mx-3">|</p>
                                    <p class="overflow-auto">
                                        -</p>
                                </div>
                                <button type="button" class="btn btn-green position-relative">
                                    Lihat Detail
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ count($item['absensi']) }}
                                    </span>
                                </button>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
@endsection
