@extends('layouts.kesiswaan')
@section('title', 'Jurnal')
@section('main')
    <div class="kesiswaan-section">
        <div class="d-flex justify-content-between mt-2 me-5 align-items-center">
            <h2 class="fw-bolder">Jurnal</h2>
        </div>
        <form class="d-flex justify-content-end me-5 align-items-end" role="search" action="/kesiswaan/absen">
            <div class="me-2">
                <label for="exampleFormControlInput1" class="form-label">Tanggal Mulai</label>
                <input class="form-control" type="date" name="tanggal_mulai" aria-label="Search">
            </div>
            <div class="me-2">
                <label for="exampleFormControlInput1" class="form-label">Tanggal Selesai</label>
                <input class="form-control" type="date" name="tanggal_selesai" aria-label="Search">
            </div>
            <div class="me-2">
                <label for="exampleFormControlInput1" class="form-label">Ekstrakurikuler</label>
                <select class="form-select" name="ekstra" aria-label="Default select example">
                    <option selected>Ekstrakurikuler</option>
                    @foreach ($ekstra as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_ekstra }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex h-50 align-items-center">
                <input class="form-control me-2" type="search" placeholder="Cari" name="cari" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Cari</button>
            </div>
        </form>
        <div class="card p-3 mt-5 me-5 shadow-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Id Kegiatan</th>
                        <th scope="col">Ekstrakurikuler</th>
                        <th scope="col">Pelatih</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">jenis Kegiatan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jurnal as $item)
                        <tr>
                            <td scope="col">{{ $loop->iteration }}</td>
                            <td scope="col">{{ $item['detail']->absensi_id }}</td>
                            <td scope="col">{{ $item['ekstra']->nama_ekstra }}</td>
                            <td scope="col">{{ $item['pelatih']->nama_pelatih }}</td>
                            <td scope="col">{{ $item->judul }}</td>
                            <td scope="col">{{ $item->lokasi }}</td>
                            <td scope="col">{{ $item->jenis_kegiatan }}</td>
                            <td scope="col">{{ $item->tanggal }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="mx-3">
                                        <svg width="20" height="20" viewBox="0 0 506 506" fill="none"
                                            data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M470.679 16.3929C448.822 -5.46431 413.491 -5.46431 391.634 16.3929L361.592 46.3343L459.301 144.043L489.342 114.002C511.2 92.1447 511.2 56.8138 489.342 34.9566L470.679 16.3929ZM172.063 235.963C165.975 242.051 161.284 249.537 158.59 257.82L129.047 346.447C126.153 355.03 128.449 364.512 134.836 370.999C141.224 377.486 150.705 379.682 159.388 376.788L248.015 347.245C256.199 344.551 263.684 339.86 269.872 333.772L436.845 166.699L339.037 68.8902L172.063 235.963ZM95.8125 58.6103C42.916 58.6103 0 101.526 0 154.423V409.923C0 462.819 42.916 505.735 95.8125 505.735H351.312C404.209 505.735 447.125 462.819 447.125 409.923V314.11C447.125 296.445 432.853 282.173 415.188 282.173C397.522 282.173 383.25 296.445 383.25 314.11V409.923C383.25 427.588 368.978 441.86 351.312 441.86H95.8125C78.1471 441.86 63.875 427.588 63.875 409.923V154.423C63.875 136.757 78.1471 122.485 95.8125 122.485H191.625C209.29 122.485 223.562 108.213 223.562 90.5478C223.562 72.8824 209.29 58.6103 191.625 58.6103H95.8125Z"
                                                fill="#828282" />
                                        </svg>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Lihat Jurnal</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="form-label">Judul</label>
                                                        <input type="text" value="{{ $item->judul }}"
                                                            class="form-control" id="exampleFormControlInput1"
                                                            placeholder="name@example.com" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="form-label">Ekstrakurikuler</label>
                                                        <input type="text" value="{{ $item['ekstra']->nama_ekstra }}"
                                                            class="form-control" id="exampleFormControlInput1"
                                                            placeholder="name@example.com" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="form-label">Penulis</label>
                                                        <input type="text" value="{{ $item['pelatih']->nama_pelatih }}"
                                                            class="form-control" id="exampleFormControlInput1"
                                                            placeholder="name@example.com" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1" class="form-label">Jenis
                                                            Kegiatan</label>
                                                        <input type="text" value="{{ $item->jenis_kegiatan }}"
                                                            class="form-control" id="exampleFormControlInput1"
                                                            placeholder="name@example.com" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="form-label">Lokasi</label>
                                                        <input type="text" value="{{ $item->lokasi }}"
                                                            class="form-control" id="exampleFormControlInput1"
                                                            placeholder="name@example.com" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1"
                                                            class="form-label">Tanggal</label>
                                                        <input type="text" value="{{ $item->tanggal }}"
                                                            class="form-control" id="exampleFormControlInput1"
                                                            placeholder="name@example.com" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1"
                                                            class="form-label">Deskripsi Kegiatan</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" readonly>{{ $item->deskripsi }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="me-3">
                                        <form action="/kesiswaan/jurnal/download" method="post">
                                            @csrf
                                            <input type="text" name="type" readonly hidden />
                                            <input type="text" name="id" value={{ $item->id }} readonly
                                                hidden />
                                            <input type="text" name="month" readonly hidden />
                                            <button type="submit" style="background-color: transparent; border: none;">
                                                <svg width="25" height="25" viewBox="0 0 512 512" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_132_2)">
                                                        <path
                                                            d="M288 32C288 14.3 273.7 0 256 0C238.3 0 224 14.3 224 32V274.7L150.6 201.3C138.1 188.8 117.8 188.8 105.3 201.3C92.8 213.8 92.8 234.1 105.3 246.6L233.3 374.6C245.8 387.1 266.1 387.1 278.6 374.6L406.6 246.6C419.1 234.1 419.1 213.8 406.6 201.3C394.1 188.8 373.8 188.8 361.3 201.3L288 274.7V32ZM64 352C28.7 352 0 380.7 0 416V448C0 483.3 28.7 512 64 512H448C483.3 512 512 483.3 512 448V416C512 380.7 483.3 352 448 352H346.5L301.2 397.3C276.2 422.3 235.7 422.3 210.7 397.3L165.5 352H64ZM432 408C438.365 408 444.47 410.529 448.971 415.029C453.471 419.53 456 425.635 456 432C456 438.365 453.471 444.47 448.971 448.971C444.47 453.471 438.365 456 432 456C425.635 456 419.53 453.471 415.029 448.971C410.529 444.47 408 438.365 408 432C408 425.635 410.529 419.53 415.029 415.029C419.53 410.529 425.635 408 432 408Z"
                                                            fill="#828282" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_132_2">
                                                            <rect width="512" height="512" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>

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
                                                            Jurnal</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Yakin Menghapus Jurnal?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Kembali</button>
                                                        <a type="submit" class="btn btn-danger"
                                                            href="/kesiswaan/jurnal/delete/">Hapus</a>
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
            {{ $jurnal->links() }}
        </div>
    </div>
@endsection
