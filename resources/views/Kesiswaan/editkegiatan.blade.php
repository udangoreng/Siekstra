@extends('layouts.kesiswaan')
@section('title', 'Absensi')
@section('main')
    <div class="kesiswaan-section p-3 me-4">
        <div class="d-flex">
            <div class="me-2">
                <a href="/kesiswaan/kegiatan">
                    <svg width="15" height="27" viewBox="0 0 225 385" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.375 169.475C-3.125 181.975 -3.125 202.275 9.375 214.775L169.375 374.775C181.875 387.275 202.175 387.275 214.675 374.775C227.175 362.275 227.175 341.975 214.675 329.475L77.275 192.075L214.575 54.675C227.075 42.175 227.075 21.875 214.575 9.375C202.075 -3.125 181.775 -3.125 169.275 9.375L9.275 169.375L9.375 169.475Z"
                            fill="#828282" />
                    </svg>
                </a>
            </div>
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
                @if (!($absen->tanggal_mulai < date('Y-m-d') && $absen->tanggal_selesai < date('Y-m-d')))
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $absen->deskripsi }}</textarea>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="/kesiswaan/kegiatan" class="btn btn-secondary me-2" style="width: 50%">Kembali</a>
                        <button class="btn btn-green ms-2" style="width: 50%">Simpan</button>
                    </div>
                @endif
            </form>
        </div>

        @if ($absen->tanggal_mulai < date('Y-m-d') && $absen->tanggal_selesai < date('Y-m-d'))
            <div class="mt-3">
                <label for="exampleFormControlInput1" class="form-label fw-semibold">Daftar Absensi Siswa : </label>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Waktu</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absensi as $item)
                            <tr>
                                <td scope="col">{{ $loop->iteration }}</td>
                                <td scope="col">
                                    @if ($item['user']->role == 'Pelatih')
                                        <div class="bg-primary bg-opacity-50 text-dark text-center rounded-3 p-1">
                                            {{ $item['user']->name }}
                                        </div>
                                    @else
                                        {{ $item['user']->name }}
                                    @endif
                                </td>
                                <td scope="col">
                                    @if ($item['user']->role != 'Pelatih')
                                        {{ $item['siswa']->kelas }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td scope="col">{{ substr($item->created_at, 11, 14) }}</td>
                                <td scope="col">{{ $item->keterangan }}</td>
                                <td scope="col">
                                    @if ($item->status == 'Dikonfirmasi')
                                        <div class="bg-success text-white text-center rounded-3 p-1">
                                            {{ $item->status }}
                                        </div>
                                    @elseif ($item->status == 'Pending')
                                        <div class="bg-warning text-center rounded-3 p-1">
                                            {{ $item->status }}
                                        </div>
                                    @else
                                        <div class="bg-danger text-white text-center rounded-3 p-1">
                                            {{ $item->status }}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @foreach ($siswa as $item)
                            <tr>
                                <td scope="col"> - </td>
                                <td scope="col">
                                    {{ $item->nama_siswa }}
                                </td>
                                <td scope="col">
                                    {{ $item->kelas }}
                                </td>
                                <td scope="col"> - </td>
                                <td scope="col">Belum Melakukan Absensi</td>
                                <td scope="col">
                                    -
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="table table-borderless"
                    style="padding: 0 !important; margin: 0 !important; border-spacing: 0px;">
                    <tr style="padding: 0 !important; margin: 0 !important;">
                        <td style="padding: 0 !important; margin: 0 !important;">Jumlah Seluruh Siswa</td>
                        <td style="padding: 0 !important; margin: 0 !important;">:</td>
                        <td style="padding: 0 !important; margin: 0 !important;">{{ count($all) }}</td>
                    </tr>
                    <tr style="padding: 0 !important; margin: 0 !important;">
                        <td style="padding: 0 !important; margin: 0 !important;">Jumlah Siswa Terabsen</td>
                        <td style="padding: 0 !important; margin: 0 !important;">:</td>
                        <td style="padding: 0 !important; margin: 0 !important;">{{ count($absensi) }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 0 !important; margin: 0 !important;">Keterangan</td>
                        <td>Hadir</td>
                        <td>Sakit</td>
                        <td>Ijin</td>
                        <td>Alpha</td>
                        <td>Belum Absensi</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ count($absensi->where('keterangan', 'Hadir')) }}</td>
                        <td>{{ count($absensi->where('keterangan', 'Sakit')) }}</td>
                        <td>{{ count($absensi->where('keterangan', 'Ijin')) }}</td>
                        <td>{{ count($absensi->where('keterangan', 'Alpha')) }}</td>
                        <td>{{ count($siswa) }}</td>
                    </tr>
                </table>
            </div>
        @endif
    @endsection
