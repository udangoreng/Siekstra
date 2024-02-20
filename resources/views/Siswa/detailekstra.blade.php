@extends('layouts.siswa')
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
                @foreach ($absensi as $item)
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 p-2">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="d-flex justify-content-end fw-semibold mb-3">{{ $item['absensi_id'] }}</h6>
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
                                <button type="button" class="btn btn-green" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $item['id'] }}">
                                    Absen Sekarang
                                </button>

                                <div class="modal fade" id="exampleModal{{ $item['id'] }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="/siswa/absen" method="POST">
                                                @csrf
                                                <input type="text" name="absensi_id" value="{{ $item['absensi_id'] }}"
                                                    readonly hidden />
                                                <input type="text" name="ekstra_id" value="{{ $item['ekstra_id'] }}"
                                                    readonly hidden />
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Absen</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <p>{{ $item['absensi_id'] }}</p>
                                                        <p>{{ now('Asia/Jakarta') }}</p>
                                                    </div>
                                                    <p class="fw-semibold">Deskripsi</p>
                                                    <p class="mb-3">{{ $item['deskripsi'] }}</p>
                                                    <div>
                                                        <label class="fw-semibold">Keterangan</label><br />
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="keterangan"
                                                                id="inlineRadio1" value="Hadir">
                                                            <label class="form-check-label" for="inlineRadio1">Hadir</label>
                                                        </div><br />
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="keterangan"
                                                                id="inlineRadio2" value="Sakit">
                                                            <label class="form-check-label" for="inlineRadio2">Sakit</label>
                                                        </div><br />
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="keterangan"
                                                                id="inlineRadio3" value="Ijin">
                                                            <label class="form-check-label" for="inlineRadio3">Ijin</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-green">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                    @if ($item->nama_siswa == $user)
                        - {{ $item->nama_siswa }} (Saya) <br />
                    @else
                        - {{ $item->nama_siswa }} <br />
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
