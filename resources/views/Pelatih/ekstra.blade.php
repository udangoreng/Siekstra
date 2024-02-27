@extends('layouts.pelatih')
@section('title', 'Ekstrakurikuler')
@section('main')
    <div class="section">
        <div class="d-flex justify-content-between">
            <h2>Ekstrakurikuler Diikuti</h2>
            <div class="d-flex justify-content-end mb-3">
                <form method="get" action="/pelatih/ekstra">
                    @csrf
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="me-2">
                            <label class="form-label fw-semibold">Tahun Ajaran</label>
                            <select name="cari" class="form-select" aria-label="Default select example">
                                <option value="{{ $thn }}" selected>
                                    {{ $thn }}
                                </option>
                                @foreach ($thn_diikuti as $item)
                                    <option value="{{ $item->tahun_ajaran }}">
                                        {{ $item->tahun_ajaran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-green">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
            @foreach ($ekstra as $item)
                @if (array_key_exists('ekstra', $item))
                    <a
                        href="/pelatih/ekstra/{{ $item['ekstra']['id'] }}/{{ str_replace('/', '-', $item['tahun_ajaran']) }}">
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
                                    @if (count($item['absensi']) > 0)
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($item['absensi']) }}
                                        </span>
                                    @endif
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
