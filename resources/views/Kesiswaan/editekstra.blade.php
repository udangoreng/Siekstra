@extends('layouts.kesiswaan')
@section('title', 'Ekstrakurikuler')
@section('main')
    <div class="kesiswaan-section p-3 me-4">
        <div>
            <h2 class="fw-bolder">Detail Ekstrakurikuler</h2>
        </div>
        <div>
            <div class="d-flex justify-content-end mb-3">
                <div class="d-flex justify-content-between align-items-end" style="width: 35%;">
                    <div>
                        <label class="form-label fw-semibold">Tahun Ajaran</label>
                        <select name="tahun_ajaran" class="form-select" aria-label="Default select example">
                            <option value="-" selected>{{ $ekstra->tahun_ajaran ? $ekstra->tahun_ajaran : '-' }}
                            </option>
                            <option name="tahun_ajaran" value="1">2023/2024</option>
                            <option value="2">2022/2023</option>
                        </select>
                    </div>
                    <div>
                        <button class="btn btn-green">Cari</button>
                    </div>
                </div>
            </div>
            <form method="POST" action="/kesiswaan/ekstra/edit/{{ $id }}">
                @csrf
                <input name="tahun_ajaran" readonly hidden value="{{ $ekstra->tahun_ajaran }}">
                <input type="text" name="id" value="{{ $ekstra->id }}" readonly hidden>

                <div class="d-flex mb-3 justify-content-between">
                    <div class="me-3" style="width: 65%;">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Nama Ekstra</label>
                        <input name="nama_ekstra" type="text" class="form-control" value="{{ $ekstra->nama_ekstra }}">
                    </div>
                    <div style="width: 35%;">
                        <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Kode Ekstrakurikuler</label>
                        <input name="kode_ekstra" class="form-control" id="exampleFormControlTextarea1" rows="3"
                            value="{{ $ekstra->kode_ekstra }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi_ekstra" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $ekstra->deskripsi_ekstra }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pelatih</label>
                    @if (count($ekstra->pelatih) < 1)
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="nama_pelatih"
                            value="-" readonly>
                    @else
                        <div class="card">
                            <div class="card-body">
                                @foreach ($ekstra->pelatih as $pelatih)
                                    <a class="text-black"
                                        href="/kesiswaan/pelatih/{{ $pelatih['id'] }}">{{ $pelatih['nama_pelatih'] }}</a>
                                    <br />
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Anggota</label>
                    <div class="card">
                        <div class="card-body">
                            @if (count($ekstra->pelatih) < 1)
                                -
                            @else
                                @foreach ($ekstra->siswa as $siswa)
                                    <a class="text-black"
                                        href="/kesiswaan/siswa/{{ $siswa['id'] }}">{{ $siswa['nama_siswa'] }}</a>
                                    <br />
                                @endforeach>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-4">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Hari</label>
                        <select name="hari" class="form-select" aria-label="Default select example">
                            <option value="{{ $ekstra->hari }}" selected>{{ $ekstra->hari ? $ekstra->hari : '-' }}
                            </option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>
                    <div class="mb-3 me-4">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Jam Mulai</label>
                        <input type="time" class="form-control" id="exampleFormControlInput1" name="waktu_mulai"
                            value="{{ $ekstra->waktu_mulai ? $ekstra->waktu_mulai : '-' }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Jam Selesai</label>
                        <input type="time" class="form-control" id="exampleFormControlInput1" name="waktu_selesai"
                            value="{{ $ekstra->waktu_selesai ? $ekstra->waktu_selesai : '-' }}">
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <a href="/kesiswaan/ekstra" class="btn btn-secondary me-2" style="width: 50%">Kembali</a>
                    <button class="btn btn-green ms-2" style="width: 50%">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
