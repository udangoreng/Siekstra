@extends('layouts.pelatih')
@section('title', 'Jurnal')
@section('main')
    <div class="section">
        <div class="d-flex justify-content-between mb-3">
            <div class="d-flex">
                <a class="me-3" href="/pelatih/jurnal">
                    <svg width="15" height="27" viewBox="0 0 225 385" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.375 169.475C-3.125 181.975 -3.125 202.275 9.375 214.775L169.375 374.775C181.875 387.275 202.175 387.275 214.675 374.775C227.175 362.275 227.175 341.975 214.675 329.475L77.275 192.075L214.575 54.675C227.075 42.175 227.075 21.875 214.575 9.375C202.075 -3.125 181.775 -3.125 169.275 9.375L9.275 169.375L9.375 169.475Z"
                            fill="#828282" />
                    </svg>
                </a>
                <h2>Jurnal</h2>
            </div>
            <div class="d-flex me-5">
                <div class="me-3">
                    <form action="/pelatih/jurnal/download" method="post">
                        @csrf
                        <input type="text" name="type" readonly hidden />
                        <input type="text" name="id" value={{ $jurnal->id }} readonly hidden />
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
                <div class="me-3">
                    @include('pelatih.editjurnal')
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
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                    <div class="col">
                        <div class="mb-3">
                            <p class="fw-semibold">Kegiatan ID</p>
                            <p>{{ $jurnal['detail']->absensi_id }}</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <p class="fw-semibold">Nama Ekstrakurikuler</p>
                            <p>{{ $jurnal['ekstra']->nama_ekstra }}</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <p class="fw-semibold">Lokasi</p>
                            <p>{{ $jurnal->lokasi }}</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <p class="fw-semibold">Jenis Kegiatan</p>
                            <p>{{ $jurnal->jenis_kegiatan }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div style="border-bottom: 3px solid #d8d6d6; margin-right: 2.5rem; margin-bottom: 1.5rem; margin-top: 0.5rem;">
            </div>
            <div class="mb-3">
                <h5 class="fw-semibold">Deskripsi Kegiatan</h5>
                <p style="white-space: pre-line; text-align: justify; margin-right: 2.5rem;">{{ $jurnal->deskripsi }}</p>
            </div>
            <div style="border-bottom: 3px solid #d8d6d6; margin-right: 2.5rem; margin-bottom: 1.5rem; margin-top: 0.5rem;">
            </div>
            <div>
                <h5 class="fw-semibold">Daftar Absensi Siswa</h5>
                <div class="table-responsive">
                    <table class="table" style="width: 60%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hadir as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item['siswa']->nama_siswa }}</td>
                                    <td>{{ $item['siswa']->kelas }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
