@extends('layouts.pelatih')
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
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 p-2">
                    @foreach ($absensi as $item)
                        <div class="card me-3 mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between fw-semibold mb-3">
                                    <div data-bs-toggle="modal" data-bs-target="#editAbsen{{ $item['id'] }}">
                                        <svg width="25" height="25" viewBox="0 0 483 512" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M481.238 166.6C484.438 175.3 481.738 185 474.838 191.2L431.538 230.6C432.638 238.9 433.238 247.4 433.238 256C433.238 264.6 432.638 273.1 431.538 281.4L474.838 320.8C481.738 327 484.438 336.7 481.238 345.4C476.838 357.3 471.538 368.7 465.438 379.7L460.738 387.8C454.138 398.8 446.738 409.2 438.638 419C432.738 426.2 422.938 428.6 414.138 425.8L358.438 408.1C345.038 418.4 330.238 427 314.438 433.5L301.938 490.6C299.938 499.7 292.938 506.9 283.738 508.4C269.938 510.7 255.738 511.9 241.238 511.9C226.738 511.9 212.538 510.7 198.738 508.4C189.538 506.9 182.538 499.7 180.538 490.6L168.038 433.5C152.238 427 137.438 418.4 124.038 408.1L68.4378 425.9C59.6378 428.7 49.8378 426.2 43.9378 419.1C35.8378 409.3 28.4378 398.9 21.8378 387.9L17.1378 379.8C11.0378 368.8 5.73776 357.4 1.33776 345.5C-1.86224 336.8 0.837757 327.1 7.73776 320.9L51.0378 281.5C49.9378 273.1 49.3378 264.6 49.3378 256C49.3378 247.4 49.9378 238.9 51.0378 230.6L7.73776 191.2C0.837757 185 -1.86224 175.3 1.33776 166.6C5.73776 154.7 11.0378 143.3 17.1378 132.3L21.8378 124.2C28.4378 113.2 35.8378 102.8 43.9378 93C49.8378 85.8 59.6378 83.4 68.4378 86.2L124.138 103.9C137.538 93.6 152.338 85 168.138 78.5L180.638 21.4C182.638 12.3 189.638 5.1 198.838 3.6C212.638 1.2 226.838 0 241.338 0C255.838 0 270.038 1.2 283.838 3.5C293.038 5 300.038 12.2 302.038 21.3L314.538 78.4C330.338 84.9 345.138 93.5 358.538 103.8L414.238 86.1C423.038 83.3 432.838 85.8 438.738 92.9C446.838 102.7 454.238 113.1 460.838 124.1L465.538 132.2C471.638 143.2 476.938 154.6 481.338 166.5L481.238 166.6ZM241.338 336C262.555 336 282.903 327.571 297.906 312.569C312.909 297.566 321.338 277.217 321.338 256C321.338 234.783 312.909 214.434 297.906 199.431C282.903 184.429 262.555 176 241.338 176C220.12 176 199.772 184.429 184.769 199.431C169.766 214.434 161.338 234.783 161.338 256C161.338 277.217 169.766 297.566 184.769 312.569C199.772 327.571 220.12 336 241.338 336Z"
                                                fill="#828282" />
                                        </svg>
                                    </div>

                                    <div class="modal fade" id="editAbsen{{ $item['id'] }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Absensi</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="/pelatih/absen/edit/{{ $item['id'] }}" method="POST">
                                                    @csrf
                                                    <input type="text" name="id" value="{{ $item['id'] }}" hidden
                                                        readonly>
                                                    <input type="text" name="ekstrakurikuler"
                                                        value="{{ $item['ekstra_id'] }}" hidden readonly>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label fw-semibold">Kategori</label>
                                                            <select class="form-select" name="kategori"
                                                                aria-label="Default select example">
                                                                <option value="{{ $item['kategori'] }}">
                                                                    {{ $item['kategori'] }}
                                                                </option>
                                                                <option value="Pertemuan Rutin">Pertemuan Rutin</option>
                                                                <option value="Kegiatan">Kegiatan</option>
                                                                <option value="Pendaftaran">Pendaftaran</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1"
                                                                class="form-label fw-semibold">ID Absensi</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleFormControlInput1" name="absensi_id"
                                                                value="{{ $item['absensi_id'] }}" readonly>
                                                        </div>
                                                        <div class="d-flex justify-content-between mb-3">
                                                            <div class="me-3" style="width: 50%">
                                                                <label for="exampleFormControlInput1"
                                                                    class="form-label fw-semibold">Tanggal Buka</label>
                                                                <input type="date" class="form-control"
                                                                    id="exampleFormControlInput1" name="tanggal_mulai"
                                                                    value="{{ $item['tanggal_mulai'] }}">
                                                            </div>
                                                            <div style="width: 50%">
                                                                <label for="exampleFormControlInput1"
                                                                    class="form-label fw-semibold">Tanggal Tutup</label>
                                                                <input type="date" class="form-control"
                                                                    id="exampleFormControlInput1" name="tanggal_selesai"
                                                                    value="{{ $item['tanggal_selesai'] }}">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-between mb-3">
                                                            <div class="me-3" style="width: 50%">
                                                                <label for="exampleFormControlInput1"
                                                                    class="form-label fw-semibold">Waktu Buka</label>
                                                                <input type="time" class="form-control"
                                                                    id="exampleFormControlInput1" name="waktu_mulai"
                                                                    value="{{ $item['waktu_mulai'] }}">
                                                            </div>
                                                            <div style="width: 50%">
                                                                <label for="exampleFormControlInput1"
                                                                    class="form-label fw-semibold">Waktu Tutup</label>
                                                                <input type="time" class="form-control"
                                                                    id="exampleFormControlInput1" name="waktu_selesai"
                                                                    value="{{ $item['waktu_selesai'] }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlTextarea1"
                                                                class="form-label fw-semibold">Deskripsi</label>
                                                            <textarea name="deskripsi" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $item['deskripsi'] }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-green">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>{{ $item['absensi_id'] }}</h6>
                                </div>
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
                                <a href="/pelatih/absen/{{ $item['id'] }}">
                                    <button class="btn btn-green">
                                        Lihat Absen
                                    </button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card my-2">
            <div class="card-body">
                <p class="fw-bold">Anggota</p>
                @foreach ($siswa as $item)
                    - {{ $item->nama_siswa }} <br />
                @endforeach
            </div>
        </div>

        <div class="card my-2">
            <div class="card-body">
                <p class="fw-bold">Jurnal</p <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p>Id Absensi</p>
                        <p>Tanggal buat</p>
                    </div>
                    <p>Judul</p>
                </div>
            </div>
        </div>
    </div>
@endsection
