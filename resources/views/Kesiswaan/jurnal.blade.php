@extends('layouts.kesiswaan')
@section('title', 'Jurnal')
@section('main')
    <div class="kesiswaan-section">
        <div class="d-flex justify-content-between mt-2 me-5 align-items-center">
            <h2 class="fw-bolder">Jurnal</h2>
        </div>
        <form class="d-flex justify-content-end me-5 align-items-end" role="search" action="/kesiswaan/jurnal">
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
                                        <svg width="20" height="20" viewBox="0 0 512 512" fill="none"
                                            data-bs-toggle="modal" data-bs-target="#jurnalModal{{ $item->id }}"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_142_2)">
                                                <path
                                                    d="M256 512C323.895 512 389.01 485.029 437.019 437.019C485.029 389.01 512 323.895 512 256C512 188.105 485.029 122.99 437.019 74.9807C389.01 26.9714 323.895 0 256 0C188.105 0 122.99 26.9714 74.9807 74.9807C26.9714 122.99 0 188.105 0 256C0 323.895 26.9714 389.01 74.9807 437.019C122.99 485.029 188.105 512 256 512ZM216 336H240V272H216C202.7 272 192 261.3 192 248C192 234.7 202.7 224 216 224H264C277.3 224 288 234.7 288 248V336H296C309.3 336 320 346.7 320 360C320 373.3 309.3 384 296 384H216C202.7 384 192 373.3 192 360C192 346.7 202.7 336 216 336ZM256 128C264.487 128 272.626 131.371 278.627 137.373C284.629 143.374 288 151.513 288 160C288 168.487 284.629 176.626 278.627 182.627C272.626 188.629 264.487 192 256 192C247.513 192 239.374 188.629 233.373 182.627C227.371 176.626 224 168.487 224 160C224 151.513 227.371 143.374 233.373 137.373C239.374 131.371 247.513 128 256 128Z"
                                                    fill="#828282" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_142_2">
                                                    <rect width="512" height="512" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="jurnalModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Jurnal</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body mx-5">
                                                    <h5 class="mb-3">{{ $item->judul }}</h5>
                                                    <table style="width: 100%">
                                                        <tr>
                                                            <td>Ekstrakurikuler</td>
                                                            <td>:</td>
                                                            <td>{{ $item['ekstra']->nama_ekstra }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Penulis</td>
                                                            <td>:</td>
                                                            <td>{{ $item['pelatih']->nama_pelatih }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanggal Ditulis</td>
                                                            <td>:</td>
                                                            <td>{{ $item->tanggal }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>ID Kegiatan</td>
                                                            <td>:</td>
                                                            <td>{{ $item['detail']->absensi_id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jenis Kegiatan</td>
                                                            <td>:</td>
                                                            <td>{{ $item->jenis_kegiatan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Lokasi</td>
                                                            <td>:</td>
                                                            <td>{{ $item->lokasi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Deskripsi Kegiatan</td>
                                                            <td>:</td>
                                                        </tr>
                                                    </table>
                                                    <div>
                                                        <p style="white-space: pre-line; text-align: justify;">
                                                            {{ $item->deskripsi }}</p>
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

                                    {{-- <div>
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
                                    </div> --}}
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
