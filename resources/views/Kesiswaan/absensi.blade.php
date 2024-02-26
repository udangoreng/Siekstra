@extends('layouts.kesiswaan')
@section('title', 'Absensi')
@section('main')
    <div class="kesiswaan-section">
        <div class="d-flex justify-content-between mt-2 me-5 align-items-center">
            <h2 class="fw-bolder">Absensi Siswa</h2>
        </div>
        <form class="d-flex justify-content-between me-5 align-items-center" role="search" action="/kesiswaan/absen">
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
                        <th scope="col">Id Absensi</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Role</th>
                        <th scope="col">Ekstra</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absen as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->absensi_id }}</td>
                            <td>{{ $item['user']->name }}</td>
                            <td>
                                @if ($item['user']->role == 'Pelatih')
                                    <div class="bg-primary bg-opacity-50 text-dark text-center rounded-3">
                                        {{ $item['user']->role }}
                                    </div>
                                @else
                                    {{ $item['user']->role }}
                                @endif
                            </td>
                            <td>{{ $item['ekstra']->nama_ekstra }}</td>
                            <td>{{ substr($item->created_at, 0, 10) }}</td>
                            <td>{{ substr($item->created_at, 11, 14) }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                @if ($item->status == 'Dikonfirmasi')
                                    <div class="bg-success text-white text-center rounded-3">
                                        {{ $item->status }}
                                    </div>
                                @elseif ($item->status == 'Pending')
                                    <div class="bg-warning text-center rounded-3">
                                        {{ $item->status }}
                                    </div>
                                @else
                                    <div class="bg-danger text-white text-center rounded-3">
                                        {{ $item->status }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $absen->links() }}
        </div>
    </div>
@endsection
