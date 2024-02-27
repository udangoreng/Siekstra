@extends('layouts.kesiswaan')
@section('title', 'Ekstrakurikuler')
@section('main')
    <div class="kesiswaan-section p-3 me-2" style="width: 100%">
        <div class="d-flex">
            <div class="me-2">
                <a href="/kesiswaan/ekstra">
                    <svg width="15" height="27" viewBox="0 0 225 385" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.375 169.475C-3.125 181.975 -3.125 202.275 9.375 214.775L169.375 374.775C181.875 387.275 202.175 387.275 214.675 374.775C227.175 362.275 227.175 341.975 214.675 329.475L77.275 192.075L214.575 54.675C227.075 42.175 227.075 21.875 214.575 9.375C202.075 -3.125 181.775 -3.125 169.275 9.375L9.275 169.375L9.375 169.475Z"
                            fill="#828282" />
                    </svg>
                </a>
            </div>
            <h2 class="fw-bolder">Detail Ekstrakurikuler</h2>
        </div>
        <div>
            <div class="d-flex justify-content-end mb-1">
                <form method="POST" action="/kesiswaan/ekstra/{{ $id }}">
                    @csrf
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="me-2">
                            <label class="form-label fw-semibold">Tahun Ajaran</label>
                            <select name="tahun_ajaran" class="form-select" aria-label="Default select example">
                                <option value="{{ $thn }}" selected>{{ $thn }}
                                </option>
                                @foreach (range(2020, 2024) as $item)
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
            <form method="POST" action="/kesiswaan/ekstra/edit/{{ $id }}">
                @csrf
                @if ($ekstra['ekstra'])
                    <input type="text" name="id" value="{{ $ekstra['ekstra']->id }}" readonly hidden>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Nama Ekstra</label>
                        <input name="nama_ekstra" type="text" class="form-control"
                            value="{{ $ekstra['ekstra']->nama_ekstra }}">
                    </div>
                    <div class="d-flex mb-3 justify-content-between">
                        <div class="me-3" style="width: 65%;">
                            <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Kode
                                Ekstrakurikuler</label>
                            <input name="kode_ekstra" class="form-control" id="exampleFormControlTextarea1" rows="3"
                                value="{{ $ekstra['ekstra']->kode_ekstra }}">
                        </div>
                        <div style="width: 35%;">
                            <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Tahun Ajaran</label>
                            <input name="tahun_ajaran" type="text" class="form-control"
                                value="{{ $ekstra->tahun_ajaran }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi_ekstra" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $ekstra['ekstra']->deskripsi_ekstra }}</textarea>
                    </div>
                @else
                    <input type="text" name="id" value="{{ $ekstra->id }}" readonly hidden>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Nama Ekstra</label>
                        <input name="nama_ekstra" type="text" class="form-control" value="{{ $ekstra->nama_ekstra }}">
                    </div>
                    <div class="d-flex mb-3 justify-content-between">
                        <div class="me-3" style="width: 65%;">
                            <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Kode
                                Ekstrakurikuler</label>
                            <input name="kode_ekstra" class="form-control" id="exampleFormControlTextarea1" rows="3"
                                value="{{ $ekstra->kode_ekstra }}">
                        </div>
                        <div style="width: 35%;">
                            <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Tahun Ajaran</label>
                            <input name="tahun_ajaran" type="text" class="form-control" value="{{ $thn }}"
                                readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi_ekstra" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $ekstra->deskripsi_ekstra }}</textarea>
                    </div>
                @endif

                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label fw-semibold">Pelatih</label>
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#assignModal">
                            <svg width="20" height="20" viewBox="0 0 510 510" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M478.125 223.125H286.875V31.875C286.875 23.4212 283.517 15.3137 277.539 9.33598C271.561 3.35826 263.454 0 255 0C246.546 0 238.439 3.35826 232.461 9.33598C226.483 15.3137 223.125 23.4212 223.125 31.875V223.125H31.875C23.4212 223.125 15.3137 226.483 9.33598 232.461C3.35826 238.439 0 246.546 0 255C0 263.454 3.35826 271.561 9.33598 277.539C15.3137 283.517 23.4212 286.875 31.875 286.875H223.125V478.125C223.125 486.579 226.483 494.686 232.461 500.664C238.439 506.642 246.546 510 255 510C263.454 510 271.561 506.642 277.539 500.664C283.517 494.686 286.875 486.579 286.875 478.125V286.875H478.125C486.579 286.875 494.686 283.517 500.664 277.539C506.642 271.561 510 263.454 510 255C510 246.546 506.642 238.439 500.664 232.461C494.686 226.483 486.579 223.125 478.125 223.125Z"
                                    fill="#828282" />
                            </svg>
                        </button>
                    </div>
                    @if (count($pelatih) < 1)
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="nama_pelatih"
                            value="-" readonly>
                    @else
                        <div class="card">
                            <div class="card-body">
                                @foreach ($pelatih as $pelatih)
                                    <a class="text-black"
                                        href="/kesiswaan/pelatih/{{ $pelatih->id }}">{{ $pelatih->nama_pelatih }}</a>
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
                            @if (count($siswa) < 1)
                                -
                            @else
                                @foreach ($siswa as $siswa)
                                    <a class="text-black"
                                        href="/kesiswaan/siswa/{{ $siswa->id }}">{{ $siswa->nama_siswa }}</a>
                                    <br />
                                @endforeach
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
    <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Tambah
                        Ekstrakurikuler</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/kesiswaan/ekstra/assign/{{ $ekstra->id_ekstra }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="tahun_pelajaran"
                                value="{{ $ekstra->tahun_pelajaran ? $ekstra->tahun_pelajaran : $thn }}" readonly hidden>
                            <input type="text" name="ekstra_id" value="{{ $ekstra->id_ekstra }}" readonly hidden>
                            <label for="exampleFormControlInput1" class="form-label">
                                Nama Guru</label>
                            <div class="mb-3 me-4">
                                <input class="form-control" name="id" list="datalistOptions" id="exampleDataList"
                                    placeholder="Cari Atau Pilih Pelatih">
                                <datalist id="datalistOptions">
                                    @foreach ($guru as $item)
                                        <option value="{{ $item->user_id }}"> - {{ $item->nama_pelatih }}</option>
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
