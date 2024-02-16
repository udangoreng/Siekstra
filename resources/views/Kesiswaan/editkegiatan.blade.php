@extends('layouts.kesiswaan')
@section('title', 'Absensi')
@section('main')
    <div class="kesiswaan-section p-3 me-4">
        <div>
            <h2 class="fw-bolder">Detail Absensi</h2>
        </div>
        <div>
            <form method="POST" action="/kesiswaan/kegiatan/edit/{{ $absen->id }}">
                @csrf
                <input type="text" name="id" value="{{ $absen->id }}" readonly hidden>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Id Absensi</label>
                    <input name="id_absensi" type="text" class="form-control" value="{{ $absen->absensi_id }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Ekstrakurikuler</label>
                    <select class="form-select" name="ekstrakurikuler" aria-label="Default select example">
                        <option selected value="{{ $absen->ekstra->id }}">{{ $absen->ekstra->nama_ekstra }}</option>
                        @foreach ($ekstra as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_ekstra }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Kategori</label>
                    <select class="form-select" name="kategori" aria-label="Default select example">
                        <option value="{{ $absen->kategori }}">{{ $absen->kategori }}</option>
                        <option value="Pertemuan Rutin">Pertemuan Rutin</option>
                        <option value="Kegiatan">Kegiatan</option>
                        <option value="Pendaftaran">Pendaftaran</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <div class="me-3" style="width: 50%">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Tanggal Buka</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal_mulai"
                            value="{{ $absen->tanggal_mulai }}">
                    </div>
                    <div style="width: 50%">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Tanggal Tutup</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal_selesai"
                            value="{{ $absen->tanggal_selesai }}">
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <div class="me-3" style="width: 50%">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Waktu Buka</label>
                        <input type="time" class="form-control" id="exampleFormControlInput1" name="waktu_mulai"
                            value="{{ $absen->waktu_mulai }}">
                    </div>
                    <div style="width: 50%">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Waktu Tutup</label>
                        <input type="time" class="form-control" id="exampleFormControlInput1" name="waktu_selesai"
                            value="{{ $absen->waktu_selesai }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $absen->deskripsi }}</textarea>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="/kesiswaan/kegiatan" class="btn btn-secondary me-2" style="width: 50%">Kembali</a>
                    <button class="btn btn-green ms-2" style="width: 50%">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
