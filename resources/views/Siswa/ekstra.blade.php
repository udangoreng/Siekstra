@extends('layouts.siswa')
@section('title', 'Ekstra Saya')
@section('main')
    <div class="section me-3">
        <div class="container mt-3">
            <div class="card p-3 my-3">
                <div class="d-flex justify-content-between">
                    <h2>Ekstrakurikuler Saya</h2>
                    <div class="d-flex justify-content-end mb-3">
                        <form method="POST" action="/">
                            @csrf
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="me-2">
                                    <label class="form-label fw-semibold">Tahun Ajaran</label>
                                    <select name="tahun_ajaran" class="form-select" aria-label="Default select example">
                                        <option value="{{ $siswa->tahun_pelajaran }}" selected>{{ $siswa->tahun_pelajaran }}
                                        </option>
                                        @foreach (range(substr($siswa->tahun_pelajaran, 0, 4), substr($siswa->tahun_pelajaran, 0, 4) + 2) as $item)
                                            <option value="{{ $item }}/{{ $item + 1 }}">
                                                {{ $item }} / {{ $item + 1 }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button class="btn btn-green">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                    @if (count($ekstra) >= 1)
                        @foreach ($ekstra as $item)
                            @if (array_key_exists('ekstra', $item))
                                <a
                                    href="/siswa/ekstra/{{ $item['ekstra']['id'] }}/{{ str_replace('/', '-', $item['tahun_ajaran']) }}">
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
                                <a href="/siswa/ekstra/{{ $item['id'] }}/{{ str_replace('/', '-', $thn) }}">
                                    <div class="card mx-1 my-3">
                                        <div class="card-body">
                                            <h4 class="fw-semibold mb-2">{{ $item['nama_ekstra'] }}</h4>
                                            <p class="fw-bold mb-2"> - </p>
                                            <div class="d-flex mb-3">
                                                <p class="overflow-auto">-</p>
                                                <p class="mx-3">|</p>
                                                <p class="overflow-auto">-</p>
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
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="card p-3 my-3">
                <h2>Kegiatan / Khusus</h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                    @foreach ($khusus as $item)
                        <div class="card mx-1 my-3">
                            <div class="card-body">
                                <a href="/siswa/detail/{{ $item['ekstra']['id'] }}">
                                    <h4 class="fw-semibold text-black mb-2">{{ $item['ekstra']['nama_ekstra'] }}</h4>
                                    <p class="text-black">{{ $item['deskripsi'] }}</p>
                                </a>
                                @if ($item['kategori'] == 'Khusus')
                                    <button type="button" class="btn btn-green mt-3" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $item['ekstra']['id'] }}">
                                        Lihat Detail
                                    </button>

                                    <div class="modal fade" id="exampleModal{{ $item['ekstra']['id'] }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mendaftar Ekstra
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="/siswa/ekstra/daftar" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p class="fw-bold mb-4">Mendaftar Ke Ekstrakurikuler Ini?</p>
                                                        <input type="text" name="ekstra_id"
                                                            value="{{ $item['ekstra']['id'] }}" readonly hidden>
                                                        <input type="text" name="user_id" value="{{ $siswa->user_id }}"
                                                            readonly hidden>
                                                        <div class="mb-3">
                                                            <label class="form-label">Ekstrakurikuler</label>
                                                            <input type="text" name="" class="form-control"
                                                                value="{{ $item['ekstra']['nama_ekstra'] }}" readonly>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Siswa</label>
                                                            <input type="text" name="" class="form-control"
                                                                value="{{ $siswa->nama_siswa }}" readonly>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Tahun Ajaran</label>
                                                            <input type="text" name="tahun_ajaran" class="form-control"
                                                                value="{{ $thn }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button class="btn btn-green" type="submit">Daftar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
