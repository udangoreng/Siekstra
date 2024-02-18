@extends('layouts.pelatih')
@section('title', 'Jurnal')
@section('main')
    <div class="section">
        <div class="d-flex justify-content-between mb-3">
            <h2>Jurnal</h2>
            <div class="d-flex me-5">
                <div class="me-3">
                    <svg width="25" height="25" viewBox="0 0 506 506" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M470.679 16.3929C448.822 -5.46431 413.491 -5.46431 391.634 16.3929L361.592 46.3343L459.301 144.043L489.342 114.002C511.2 92.1447 511.2 56.8138 489.342 34.9566L470.679 16.3929ZM172.063 235.963C165.975 242.051 161.284 249.537 158.59 257.82L129.047 346.447C126.153 355.03 128.449 364.512 134.836 370.999C141.224 377.486 150.705 379.682 159.388 376.788L248.015 347.245C256.199 344.551 263.684 339.86 269.872 333.772L436.845 166.699L339.037 68.8902L172.063 235.963ZM95.8125 58.6103C42.916 58.6103 0 101.526 0 154.423V409.923C0 462.819 42.916 505.735 95.8125 505.735H351.312C404.209 505.735 447.125 462.819 447.125 409.923V314.11C447.125 296.445 432.853 282.173 415.188 282.173C397.522 282.173 383.25 296.445 383.25 314.11V409.923C383.25 427.588 368.978 441.86 351.312 441.86H95.8125C78.1471 441.86 63.875 427.588 63.875 409.923V154.423C63.875 136.757 78.1471 122.485 95.8125 122.485H191.625C209.29 122.485 223.562 108.213 223.562 90.5478C223.562 72.8824 209.29 58.6103 191.625 58.6103H95.8125Z"
                            fill="#828282" />
                    </svg>
                </div>
                <div>
                    <svg width="20" height="25" viewBox="0 0 511 582" fill="none" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" xmlns="http://www.w3.org/2000/svg">
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

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Jurnal</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Yakin Menghapus Jurnal?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <a type="submit" class="btn btn-danger"
                                        href="/pelatih/jurnal/delete/{{ $jurnal->id }}">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h4 class="fw-bold">{{ $jurnal->judul }}</h4>
            <div class="d-flex mb-3">
                <p class="fw-semibold"> Penulis : {{ $jurnal['pelatih']->nama_pelatih }}</p>
                <p class="mx-2">|</pc>
                <p>{{ $jurnal->tanggal }}</p>
            </div>
            <div>
                <div class="d-flex mb-3">
                    <div class="me-5">
                        <p class="fw-semibold">Kegiatan ID</p>
                        <p>{{ $jurnal['detail']->absensi_id }}</p>
                    </div>
                    <div>
                        <p class="fw-semibold">Nama Ekstrakurikuler</p>
                        <p>{{ $jurnal['ekstra']->nama_ekstra }}</p>
                    </div>
                </div>
                <div class="mb-3">
                    <p class="fw-semibold">Lokasi</p>
                    <p>{{ $jurnal->lokasi }}</p>
                </div>
                <div class="mb-3">
                    <p class="fw-semibold">Jenis Kegiatan</p>
                    <p>{{ $jurnal->jenis_kegiatan }}</p>
                </div>
            </div>
            <div class="mb-5">
                <p class="fw-semibold">Deskripsi</p>
                {{ $jurnal->deskripsi }}
            </div>
            <div>
                List Kehadiran
            </div>
        </div>
    </div>
@endsection
