@extends('layouts.pelatih')
@section('title', 'Jurnal')
@section('main')
    <div class="section">
        <h2 class="mb-3">Jurnal</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
            @foreach ($jurnal as $item)
                <a href="/pelatih/jurnal/{{ $item->id }}" class="text-dark">
                    <div class="card me-3">
                        <div class="card-body">
                            <div>
                                <div class="d-flex justify-content-end">
                                    <p>{{ $item->tanggal }}</p>
                                </div>
                                <h5 class="fw-bold mb-1">{{ $item->judul }}</h5>
                                <p>Penulis : <b>{{ $item['pelatih']->nama_pelatih }}</b>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
