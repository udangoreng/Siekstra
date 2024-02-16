@extends('layouts.pelatih')
@section('title', 'Absensi')
@section('main')
    <div class="section">
        <div class="card" style="width: 90%;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h2>Absensi</h2>
                    <button type="button" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Absen Sekarang
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absen as $item)
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
                                            <div class="bg-primary bg-opacity-50 text-dark text-center rounded-3 p-1">
                                                {{ $item['siswa']->kelas }}
                                            </div>
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
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="mx-3" data-bs-toggle="modal"
                                                data-bs-target="#confirmModal{{ $item['user_id'] }}">
                                                <svg width="20" height="20" viewBox="0 0 506 506" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M470.679 16.3929C448.822 -5.46431 413.491 -5.46431 391.634 16.3929L361.592 46.3343L459.301 144.043L489.342 114.002C511.2 92.1447 511.2 56.8138 489.342 34.9566L470.679 16.3929ZM172.063 235.963C165.975 242.051 161.284 249.537 158.59 257.82L129.047 346.447C126.153 355.03 128.449 364.512 134.836 370.999C141.224 377.486 150.705 379.682 159.388 376.788L248.015 347.245C256.199 344.551 263.684 339.86 269.872 333.772L436.845 166.699L339.037 68.8902L172.063 235.963ZM95.8125 58.6103C42.916 58.6103 0 101.526 0 154.423V409.923C0 462.819 42.916 505.735 95.8125 505.735H351.312C404.209 505.735 447.125 462.819 447.125 409.923V314.11C447.125 296.445 432.853 282.173 415.188 282.173C397.522 282.173 383.25 296.445 383.25 314.11V409.923C383.25 427.588 368.978 441.86 351.312 441.86H95.8125C78.1471 441.86 63.875 427.588 63.875 409.923V154.423C63.875 136.757 78.1471 122.485 95.8125 122.485H191.625C209.29 122.485 223.562 108.213 223.562 90.5478C223.562 72.8824 209.29 58.6103 191.625 58.6103H95.8125Z"
                                                        fill="#828282" />
                                                </svg>
                                            </div>

                                            <div class="modal fade" id="confirmModal{{ $item['user_id'] }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi
                                                                Absen
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="/pelatih/absen/confirm" method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <input type="text" class="form-control"
                                                                    id="exampleFormControlInput1" name="absensi_id"
                                                                    value="{{ $item->absensi_id }}" readonnly hidden>
                                                                <input type="text" class="form-control"
                                                                    id="exampleFormControlInput1" name="user_id"
                                                                    value="{{ $item['user']->id }}" readonnly hidden>
                                                                <div class="mb-3">
                                                                    <label for="exampleFormControlInput1"
                                                                        class="form-label fw-semibold">Nama Siswa</label>
                                                                    <input type="text" class="form-control"
                                                                        id="exampleFormControlInput1"
                                                                        value="{{ $item['user']->name }}" readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleFormControlInput1"
                                                                        class="form-label fw-semibold">Keterangan</label>
                                                                    <select class="form-select" name="keterangan"
                                                                        aria-label="Default select example">
                                                                        <option selected value="{{ $item->keterangan }}">
                                                                            {{ $item->keterangan }}</option>
                                                                        <option value="Hadir">Hadir</option>
                                                                        <option value="Ijin">Ijin</option>
                                                                        <option value="Sakit">Sakit</option>
                                                                        <option value="Alpha">Alpha</option>
                                                                    </select>

                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="exampleFormControlInput1"
                                                                        class="form-label fw-semibold">Status</label>
                                                                    <select class="form-select" name="status"
                                                                        aria-label="Default select example">
                                                                        <option selected value="{{ $item->status }}">
                                                                            {{ $item->status }}</option>
                                                                        <option value="Dikonfirmasi">Dikonfirmasi</option>
                                                                        <option value="Pending">Pending</option>
                                                                        <option value="Ditolak">Ditolak</option>
                                                                    </select>

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
                                            <div>
                                                <svg width="15" height="20" viewBox="0 0 511 582" fill="none"
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
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="/pelatih/absen" method="POST">
                                @csrf
                                <input type="text" name="absensi_id" value="{{ $detail->absensi_id }}" readonly
                                    hidden />
                                <input type="text" name="ekstra_id" value="{{ $detail->ekstra_id }}" readonly
                                    hidden />
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Absen</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex justify-content-between mb-3">
                                        <p>{{ $detail->absensi_id }}</p>
                                        <p>{{ now('Asia/Jakarta') }}</p>
                                    </div>
                                    <p class="fw-semibold">Deskripsi</p>
                                    <p class="mb-3">{{ $detail->deskripsi }}</p>
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
    @endsection
