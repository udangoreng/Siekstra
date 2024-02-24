@extends('layouts.kesiswaan')
@section('title', 'Pelatih')
@section('main')
    <div class="kesiswaan-section p-3 me-4">
        <div>
            <h2 class="fw-bolder">Detail Pelatih</h2>
        </div>
        <div>
            <form method="POST" id="edit" action="/kesiswaan/pelatih/edit/{{ $pelatih->id }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">NIP</label>
                    <input name="NIP" type="text" class="form-control" value="{{ $pelatih->NIP }}">
                    <input name="user_id" type="text" class="form-control" value="{{ $pelatih->user_id }}" hidden
                        readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Nama Pelatih</label>
                    <input name="nama_pelatih" type="text" class="form-control" value="{{ $pelatih->nama_pelatih }}">
                </div>
                <div class="d-flex justify-content-between">
                    <div style="width: 50%" class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Nomor Hanphone</label>
                        <input name="nomor_hp_pelatih" type="text" class="form-control"
                            value="{{ $pelatih->nomor_hp_pelatih }}">
                    </div>
                    <div style="width: 50%" class="mb-3 ms-3 ">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Email</label>
                        <input name="email" type="email" class="form-control" value="{{ $pelatih->user->email }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Alamat</label>
                    <textarea name="alamat_pelatih" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $pelatih->alamat_pelatih }}</textarea>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Ekstrakurikuler Dilatih</label>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#assignModal">
                        <svg width="20" height="20" viewBox="0 0 510 510" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M478.125 223.125H286.875V31.875C286.875 23.4212 283.517 15.3137 277.539 9.33598C271.561 3.35826 263.454 0 255 0C246.546 0 238.439 3.35826 232.461 9.33598C226.483 15.3137 223.125 23.4212 223.125 31.875V223.125H31.875C23.4212 223.125 15.3137 226.483 9.33598 232.461C3.35826 238.439 0 246.546 0 255C0 263.454 3.35826 271.561 9.33598 277.539C15.3137 283.517 23.4212 286.875 31.875 286.875H223.125V478.125C223.125 486.579 226.483 494.686 232.461 500.664C238.439 506.642 246.546 510 255 510C263.454 510 271.561 506.642 277.539 500.664C283.517 494.686 286.875 486.579 286.875 478.125V286.875H478.125C486.579 286.875 494.686 283.517 500.664 277.539C506.642 271.561 510 263.454 510 255C510 246.546 506.642 238.439 500.664 232.461C494.686 226.483 486.579 223.125 478.125 223.125Z"
                                fill="#828282" />
                        </svg>
                    </button>
                </div>

                <div class="d-flex justify-content-between">
                    @foreach ($pelatih->ekstra as $item)
                        <input class="form-control" value={{ $item['id'] }} name="ekstra_id" readonly hidden>
                        <input name="nama_ekstra" type="text" class="form-control" value="{{ $item['nama_ekstra'] }}"
                            readonly>
                        <button formaction="/kesiswaan/pelatih/cancel/{{ $pelatih->id }}" class="btn ms-2">
                            <svg width="18" height="20" viewBox="0 0 511 582" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_14_4)">
                                    <path
                                        d="M154.212 20.1199L146 36.375H36.5C16.3109 36.375 0 52.6301 0 72.75C0 92.8699 16.3109 109.125 36.5 109.125H474.5C494.689 109.125 511 92.8699 511 72.75C511 52.6301 494.689 36.375 474.5 36.375H365L356.787 20.1199C350.628 7.72969 337.967 0 324.166 0H186.834C173.033 0 160.372 7.72969 154.212 20.1199ZM474.5 145.5H36.5L60.6813 530.848C62.5063 559.607 86.4594 582 115.317 582H395.683C424.541 582 448.494 559.607 450.319 530.848L474.5 145.5Z"
                                        fill="#828282" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_14_4">
                                        <rect width="511" height="582" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>

                        </button>
                    @endforeach
                </div>

                <input type="text" name="id" value="{{ $pelatih->id }}" readonly hidden>
                <div class="d-flex justify-content-between mt-3">
                    <a href="/kesiswaan/pelatih" class="btn btn-secondary me-2" style="width: 50%">Kembali</a>
                    <button formaction="/kesiswaan/pelatih/edit/{{ $pelatih->id }}" class="btn-green btn"
                        style="width: 50%" name="action">Simpan</button>
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
                <form action="/kesiswaan/pelatih/assign/{{ $pelatih->id }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="id" value="{{ $pelatih->user_id }}" readonly hidden>
                            <label for="exampleFormControlInput1" class="form-label">
                                Ekstrakurikuler</label>
                            <div class="mb-3 me-4">
                                <select name="ekstra_id" class="form-select" aria-label="Default select example">
                                    @foreach ($ekstra as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_ekstra }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 me-4">
                            <label class="form-label fw-semibold">Tahun Ajaran</label>
                            <select name="tahun_ajaran" class="form-select" aria-label="Default select example">
                                @foreach (range(2022, 2050) as $item)
                                    <option value="{{ $item }}/{{ $item + 1 }}">
                                        {{ $item }} / {{ $item + 1 }}
                                    </option>
                                @endforeach
                            </select>
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
