@extends('layouts.siswa')
@section('title', 'Absensi')
@section('main')
    <div class="section">
        <h2>Riwayat Absensi</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
            @foreach ($absen as $item)
                <div class="card">
                    <div class="card-body">
                        <p>{{ $item['detail']->absensi_id }}</p>
                        <p>{{ $item['ekstra']->nama_ekstra }}</p>
                        <p>{{ $item['detail']->deskripsi }}</p>
                        <p>{{ substr($item->created_at, 0, 10) }} | {{ substr($item->created_at, 11, 14) }}</p>
                        <p>{{ $item->status }}</p>
                        <p>{{ $item->keterangan }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
