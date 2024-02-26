@extends('layouts.siswa')
@section('title', 'Absensi')
@section('main')
    <div class="section">
        <h2>Riwayat Absensi</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
            @foreach ($absen as $item)
                <div class="card me-3 mb-3">
                    <div class="card-body">
                        <p class="fw-bold">{{ $item->absensi_id }}</p>
                        <p>{{ $item['ekstra']->nama_ekstra }}</p>
                        <p>{{ $item['detail'] ? $item['detail']->deskripsi : '-' }}</p>
                        <div class="my-3">
                            <p>Waktu Absensi:</p>
                            <p> {{ substr($item->created_at, 0, 10) }} | {{ substr($item->created_at, 11, 14) }}
                            </p>
                        </div>
                        <p>Keterangan : {{ $item->keterangan }}</p>
                        <div class="d-flex">
                            @if ($item->status == 'Dikonfirmasi')
                                <div class="p-1 bg-success text-white text-center rounded-3">
                                    {{ $item->status }}
                                </div>
                            @elseif ($item->status == 'Pending')
                                <div class="p-1 bg-warning text-center rounded-3">
                                    {{ $item->status }}
                                </div>
                            @else
                                <div class="p-1 bg-danger text-white text-center rounded-3">
                                    {{ $item->status }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <h4>Jumlah Absensi</h4>
            @foreach ($banyak as $item)
                <div class="mb-3">
                    <p>Ekstra : {{ $item['ekstra'] }}</p>
                    <p>Total Kehadiran : {{ $item['absen'] }} / {{ $item['semua'] }} |
                        {{ substr($item['persen'], 0, 3) }}%
                    </p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
