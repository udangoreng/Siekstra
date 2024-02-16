@extends('layouts.kesiswaan')
@section('title', 'Absensi')
@section('main')
    <div class="kesiswaan-section">
        <div class="d-flex justify-content-between mt-2 me-5 align-items-center">
            <h2 class="fw-bolder">Daftar Absensi</h2>
            @include('Kesiswaan.addabsensi')
        </div>
        <div class="card p-3 mt-5 me-5 shadow-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Id Absensi</th>
                        <th scope="col">Ekstrakurikuler</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Tanggal Dibuka</th>
                        <th scope="col">Tanggal Ditutup</th>
                        <th scope="col">Jam Dibuka</th>
                        <th scope="col">Jam Ditutup</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absen as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->absensi_id }}</td>
                            <td>{{ $item->ekstra->nama_ekstra }}</td>
                            <td>{{ $item->kategori }}</td>
                            <td>{{ $item->tanggal_mulai }}</td>
                            <td>{{ $item->tanggal_selesai }}</td>
                            <td>{{ $item->waktu_mulai }}</td>
                            <td>{{ $item->waktu_selesai }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="/kesiswaan/kegiatan/{{ $item->id }}">
                                        <div class="mx-3">
                                            <svg width="20" height="20" viewBox="0 0 506 506" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M470.679 16.3929C448.822 -5.46431 413.491 -5.46431 391.634 16.3929L361.592 46.3343L459.301 144.043L489.342 114.002C511.2 92.1447 511.2 56.8138 489.342 34.9566L470.679 16.3929ZM172.063 235.963C165.975 242.051 161.284 249.537 158.59 257.82L129.047 346.447C126.153 355.03 128.449 364.512 134.836 370.999C141.224 377.486 150.705 379.682 159.388 376.788L248.015 347.245C256.199 344.551 263.684 339.86 269.872 333.772L436.845 166.699L339.037 68.8902L172.063 235.963ZM95.8125 58.6103C42.916 58.6103 0 101.526 0 154.423V409.923C0 462.819 42.916 505.735 95.8125 505.735H351.312C404.209 505.735 447.125 462.819 447.125 409.923V314.11C447.125 296.445 432.853 282.173 415.188 282.173C397.522 282.173 383.25 296.445 383.25 314.11V409.923C383.25 427.588 368.978 441.86 351.312 441.86H95.8125C78.1471 441.86 63.875 427.588 63.875 409.923V154.423C63.875 136.757 78.1471 122.485 95.8125 122.485H191.625C209.29 122.485 223.562 108.213 223.562 90.5478C223.562 72.8824 209.29 58.6103 191.625 58.6103H95.8125Z"
                                                    fill="#828282" />
                                            </svg>
                                        </div>
                                    </a>
                                    <div>
                                        <div data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
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
                                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Hapus
                                                            Absensi</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Yakin Menghapus Absensi?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Kembali</button>
                                                        <a type="submit" class="btn btn-danger"
                                                            href="/kesiswaan/kegiatan/delete/{{ $item->id }}">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
