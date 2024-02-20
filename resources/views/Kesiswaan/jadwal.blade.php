@extends('layouts.kesiswaan')
@section('title', 'Jadwal')
@section('main')
    <div class="kesiswaan-section">
        <div class="container">
            <div class="row row-cols-3">
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center">Senin</h5>
                            @foreach ($ekstra as $item)
                                @if ($item->hari == 'Senin')
                                    <div class="d-flex">
                                        <div>
                                            <h6 class="fw-bold">{{ $item['ekstra']->nama_ekstra }}</h6>
                                            <div class="d-flex">
                                                <p>{{ substr($item->waktu_mulai, 0, 5) }}</p>
                                                <p class="mx-2">|</p>
                                                <p>{{ substr($item->waktu_selesai, 0, 5) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center">Selasa</h5>
                            @foreach ($ekstra as $item)
                                @if ($item->hari == 'Selasa')
                                    <div class="d-flex">
                                        <div>
                                            <h6 class="fw-bold">{{ $item['ekstra']->nama_ekstra }}</h6>
                                            <div class="d-flex">
                                                <p>{{ substr($item->waktu_mulai, 0, 5) }}</p>
                                                <p class="mx-2">|</p>
                                                <p>{{ substr($item->waktu_selesai, 0, 5) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center">Rabu</h5>
                            @foreach ($ekstra as $item)
                                @if ($item->hari == 'Rabu')
                                    <div class="d-flex">
                                        <div>
                                            <h6 class="fw-bold">{{ $item['ekstra']->nama_ekstra }}</h6>
                                            <div class="d-flex">
                                                <p>{{ substr($item->waktu_mulai, 0, 5) }}</p>
                                                <p class="mx-2">|</p>
                                                <p>{{ substr($item->waktu_selesai, 0, 5) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center">Kamis</h5>
                            @foreach ($ekstra as $item)
                                @if ($item->hari == 'Kamis')
                                    <div class="d-flex">
                                        <div>
                                            <h6 class="fw-bold">{{ $item['ekstra']->nama_ekstra }}</h6>
                                            <div class="d-flex">
                                                <p>{{ substr($item->waktu_mulai, 0, 5) }}</p>
                                                <p class="mx-2">|</p>
                                                <p>{{ substr($item->waktu_selesai, 0, 5) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center">Jum'at</h5>
                            @foreach ($ekstra as $item)
                                @if ($item->hari == 'Jumat')
                                    <div class="d-flex">
                                        <div>
                                            <h6 class="fw-bold">{{ $item['ekstra']->nama_ekstra }}</h6>
                                            <div class="d-flex">
                                                <p>{{ substr($item->waktu_mulai, 0, 5) }}</p>
                                                <p class="mx-2">|</p>
                                                <p>{{ substr($item->waktu_selesai, 0, 5) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center">Sabtu</h5>
                            @foreach ($ekstra as $item)
                                @if ($item->hari == 'Sabtu')
                                    <div class="d-flex">
                                        <div>
                                            <h6 class="fw-bold">{{ $item['ekstra']->nama_ekstra }}</h6>
                                            <div class="d-flex">
                                                <p>{{ substr($item->waktu_mulai, 0, 5) }}</p>
                                                <p class="mx-2">|</p>
                                                <p>{{ substr($item->waktu_selesai, 0, 5) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
