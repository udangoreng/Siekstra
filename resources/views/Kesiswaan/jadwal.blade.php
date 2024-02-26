@extends('layouts.kesiswaan')
@section('title', 'Jadwal')
@section('main')
    <div class="kesiswaan-section">
        <div class="d-flex justify-content-between mb-3">
            <h2>Jadwal Ekstrakurikuler</h2>
            <div class="d-flex justify-content-end me-3">
                <form method="get" action="">
                    @csrf
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="me-2">
                            <label class="form-label fw-semibold">Tahun Ajaran</label>
                            <select name="cari" class="form-select" aria-label="Default select example">
                                <option value="{{ $thn }}" selected>
                                    {{ $thn }}
                                </option>
                                @foreach (range(substr($thn, 0, 4) - 2, substr($thn, 0, 4) + 2) as $item)
                                    <option value="{{ $item }}/{{ $item + 1 }}">
                                        {{ $item }} / {{ $item + 1 }}
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
        <div class="container">
            <div class="row row-cols-3">
                @foreach ($hari as $h)
                    <div class="col mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">{{ $h }}</h5>
                                @foreach ($ekstra as $item)
                                    @if ($item->hari == $h)
                                        <div>
                                            <div class="d-flex justify-content-between">
                                                <h6 class="fw-bold">{{ $item['ekstra']->nama_ekstra }}</h6>
                                                <div class="d-flex">
                                                    @if (now()->locale('id')->dayName == $item->hari)
                                                        <div class="me-2">
                                                            <svg width="20" height="20" viewBox="0 0 510 510"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#addAbsen{{ $item->id }}">
                                                                <path
                                                                    d="M478.125 223.125H286.875V31.875C286.875 23.4212 283.517 15.3137 277.539 9.33598C271.561 3.35826 263.454 0 255 0C246.546 0 238.439 3.35826 232.461 9.33598C226.483 15.3137 223.125 23.4212 223.125 31.875V223.125H31.875C23.4212 223.125 15.3137 226.483 9.33598 232.461C3.35826 238.439 0 246.546 0 255C0 263.454 3.35826 271.561 9.33598 277.539C15.3137 283.517 23.4212 286.875 31.875 286.875H223.125V478.125C223.125 486.579 226.483 494.686 232.461 500.664C238.439 506.642 246.546 510 255 510C263.454 510 271.561 506.642 277.539 500.664C283.517 494.686 286.875 486.579 286.875 478.125V286.875H478.125C486.579 286.875 494.686 283.517 500.664 277.539C506.642 271.561 510 263.454 510 255C510 246.546 506.642 238.439 500.664 232.461C494.686 226.483 486.579 223.125 478.125 223.125Z"
                                                                    fill="#828282" />
                                                            </svg>
                                                        </div>

                                                        <div class="modal fade" id="addAbsen{{ $item->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                            Modal title</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <form action="/kesiswaan/kegiatan/add" method="POST">
                                                                        <div class="modal-body">
                                                                            @csrf
                                                                            <div class="mb-3">
                                                                                <label for="exampleFormControlInput1"
                                                                                    class="form-label fw-semibold">Ekstrakurikuler</label>
                                                                                <input type="text" class="form-control"
                                                                                    value="{{ $item['ekstra']->nama_ekstra }}"
                                                                                    id="exampleFormControlInput1" readonly>
                                                                                <input type="text" class="form-control"
                                                                                    name="ekstrakurikuler"
                                                                                    value="{{ $item['ekstra']->id }}"
                                                                                    id="exampleFormControlInput1" readonly
                                                                                    hidden>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="exampleFormControlInput1"
                                                                                    class="form-label fw-semibold">Kategori</label>
                                                                                <select class="form-select" name="kategori"
                                                                                    aria-label="Default select example">
                                                                                    <option value="Pertemuan Rutin">
                                                                                        Pertemuan Rutin</option>
                                                                                    <option value="Kegiatan">Kegiatan
                                                                                    </option>
                                                                                    <option value="Pendaftaran">Pendaftaran
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex justify-content-between mb-3">
                                                                                <div class="me-3" style="width: 50%">
                                                                                    <label for="exampleFormControlInput1"
                                                                                        class="form-label fw-semibold">Tanggal
                                                                                        Dibuka</label>
                                                                                    <input type="date"
                                                                                        class="form-control"
                                                                                        name="tanggal_mulai"
                                                                                        id="exampleFormControlInput1">
                                                                                </div>
                                                                                <div style="width: 50%">
                                                                                    <label for="exampleFormControlInput1"
                                                                                        class="form-label fw-semibold">Tanggal
                                                                                        Ditutup</label>
                                                                                    <input type="date"
                                                                                        class="form-control"
                                                                                        name="tanggal_selesai"
                                                                                        id="exampleFormControlInput1">
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex justify-content-between mb-3">
                                                                                <div class="me-3" style="width: 50%">
                                                                                    <label for="exampleFormControlInput1"
                                                                                        class="form-label fw-semibold">Waktu
                                                                                        Dibuka</label>
                                                                                    <input type="time"
                                                                                        class="form-control"
                                                                                        name="waktu_mulai"
                                                                                        id="exampleFormControlInput1">
                                                                                </div>
                                                                                <div style="width: 50%">
                                                                                    <label for="exampleFormControlInput1"
                                                                                        class="form-label fw-semibold">Waktu
                                                                                        Ditutup</label>
                                                                                    <input type="time"
                                                                                        class="form-control"
                                                                                        name="waktu_selesai"
                                                                                        id="exampleFormControlInput1">
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="exampleFormControlTextarea1"
                                                                                    class="form-label">Deskripsi
                                                                                    Absensi</label>
                                                                                <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger"
                                                                                data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit"
                                                                                class="btn btn-green">Simpan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <svg width="20" height="20" viewBox="0 0 483 512"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editJadwal{{ $item['ekstra']->id }}">
                                                            <path
                                                                d="M481.238 166.6C484.438 175.3 481.738 185 474.838 191.2L431.538 230.6C432.638 238.9 433.238 247.4 433.238 256C433.238 264.6 432.638 273.1 431.538 281.4L474.838 320.8C481.738 327 484.438 336.7 481.238 345.4C476.838 357.3 471.538 368.7 465.438 379.7L460.738 387.8C454.138 398.8 446.738 409.2 438.638 419C432.738 426.2 422.938 428.6 414.138 425.8L358.438 408.1C345.038 418.4 330.238 427 314.438 433.5L301.938 490.6C299.938 499.7 292.938 506.9 283.738 508.4C269.938 510.7 255.738 511.9 241.238 511.9C226.738 511.9 212.538 510.7 198.738 508.4C189.538 506.9 182.538 499.7 180.538 490.6L168.038 433.5C152.238 427 137.438 418.4 124.038 408.1L68.4378 425.9C59.6378 428.7 49.8378 426.2 43.9378 419.1C35.8378 409.3 28.4378 398.9 21.8378 387.9L17.1378 379.8C11.0378 368.8 5.73776 357.4 1.33776 345.5C-1.86224 336.8 0.837757 327.1 7.73776 320.9L51.0378 281.5C49.9378 273.1 49.3378 264.6 49.3378 256C49.3378 247.4 49.9378 238.9 51.0378 230.6L7.73776 191.2C0.837757 185 -1.86224 175.3 1.33776 166.6C5.73776 154.7 11.0378 143.3 17.1378 132.3L21.8378 124.2C28.4378 113.2 35.8378 102.8 43.9378 93C49.8378 85.8 59.6378 83.4 68.4378 86.2L124.138 103.9C137.538 93.6 152.338 85 168.138 78.5L180.638 21.4C182.638 12.3 189.638 5.1 198.838 3.6C212.638 1.2 226.838 0 241.338 0C255.838 0 270.038 1.2 283.838 3.5C293.038 5 300.038 12.2 302.038 21.3L314.538 78.4C330.338 84.9 345.138 93.5 358.538 103.8L414.238 86.1C423.038 83.3 432.838 85.8 438.738 92.9C446.838 102.7 454.238 113.1 460.838 124.1L465.538 132.2C471.638 143.2 476.938 154.6 481.338 166.5L481.238 166.6ZM241.338 336C262.555 336 282.903 327.571 297.906 312.569C312.909 297.566 321.338 277.217 321.338 256C321.338 234.783 312.909 214.434 297.906 199.431C282.903 184.429 262.555 176 241.338 176C220.12 176 199.772 184.429 184.769 199.431C169.766 214.434 161.338 234.783 161.338 256C161.338 277.217 169.766 297.566 184.769 312.569C199.772 327.571 220.12 336 241.338 336Z"
                                                                fill="#828282" />
                                                        </svg>

                                                        <div class="modal fade" id="editJadwal{{ $item['ekstra']->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="exampleModalLabel">Edit Jadwal</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <form
                                                                        action="/kesiswaan/jadwal/edit/{{ $item->id }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <div class="mb-3">
                                                                                <input type="text" class="form-control"
                                                                                    name="id"
                                                                                    value="{{ $item->id }}"
                                                                                    id="exampleFormControlInput1" readonly
                                                                                    hidden>
                                                                                <label for="exampleFormControlInput1"
                                                                                    class="form-label fw-semibold">Hari</label>
                                                                                <select class="form-select" name="hari"
                                                                                    aria-label="Default select example">
                                                                                    <option value="{{ $item->hari }}">
                                                                                        {{ $item->hari }}</option>
                                                                                    <option value="Senin">Senin
                                                                                    </option>
                                                                                    <option value="Selasa">Selasa
                                                                                    </option>
                                                                                    <option value="Rabu">Rabu
                                                                                    </option>
                                                                                    <option value="Kamis">Kamis
                                                                                    </option>
                                                                                    <option value="Jumat">Jumat
                                                                                    </option>
                                                                                    <option value="Sabtu">Sabtu
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="d-flex mb-3">
                                                                                <div class="me-3" style="width: 50%">
                                                                                    <label for="exampleFormControlInput1"
                                                                                        class="form-label fw-semibold">Waktu
                                                                                        Dibuka</label>
                                                                                    <input type="time"
                                                                                        class="form-control"
                                                                                        name="waktu_mulai"
                                                                                        value="{{ $item->waktu_mulai }}"
                                                                                        id="exampleFormControlInput1">
                                                                                </div>
                                                                                <div style="width: 50%">
                                                                                    <label for="exampleFormControlInput1"
                                                                                        class="form-label fw-semibold">Waktu
                                                                                        Selesai</label>
                                                                                    <input type="time"
                                                                                        class="form-control"
                                                                                        name="waktu_selesai"
                                                                                        value="{{ $item->waktu_selesai }}"
                                                                                        id="exampleFormControlInput1">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Batal</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-green">Simpan</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <p>{{ substr($item->waktu_mulai, 0, 5) }}</p>
                                                <p class="mx-2">|</p>
                                                <p>{{ substr($item->waktu_selesai, 0, 5) }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
