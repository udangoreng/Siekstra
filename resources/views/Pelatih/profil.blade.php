@extends('layouts.pelatih')
@section('title', 'Profil')
@section('main')
    <div class="section me-3">
        <div class="d-flex justify-content-between">
            <h2 class="fw-bold">Profil Saya</h2>
            <div>
                <a href="/logout">
                    <button class="btn btn-green">
                        <div class="d-flex">
                            <p class="text-white me-2">Logout</p>
                            <svg width="25" height="21" viewBox="0 0 500 438" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M343.75 62.5H406.25C423.535 62.5 437.5 76.4648 437.5 93.75V343.75C437.5 361.035 423.535 375 406.25 375H343.75C326.465 375 312.5 388.965 312.5 406.25C312.5 423.535 326.465 437.5 343.75 437.5H406.25C458.008 437.5 500 395.508 500 343.75V93.75C500 41.9922 458.008 0 406.25 0H343.75C326.465 0 312.5 13.9648 312.5 31.25C312.5 48.5352 326.465 62.5 343.75 62.5ZM334.57 240.82C346.777 228.613 346.777 208.789 334.57 196.582L209.57 71.582C197.363 59.375 177.539 59.375 165.332 71.582C153.125 83.7891 153.125 103.613 165.332 115.82L237.012 187.5H31.25C13.9648 187.5 0 201.465 0 218.75C0 236.035 13.9648 250 31.25 250H237.012L165.332 321.68C153.125 333.887 153.125 353.711 165.332 365.918C177.539 378.125 197.363 378.125 209.57 365.918L334.57 240.918V240.82Z"
                                    fill="white" />
                            </svg>
                        </div>
                    </button>
                </a>
            </div>
        </div>
        <div>
            <form method="POST" action="/pelatih/edit/{{ $data->id }}">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Nama</label>
                    <input type="text" value="{{ $data->nama_pelatih }}" name="nama_pelatih" class="form-control"
                        id="exampleFormControlInput1">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">NIP</label>
                    <input type="text" value="{{ $data->NIP }}" class="form-control" name="NIP"
                        id="exampleFormControlInput1">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="alamat_pelatih" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $data->alamat_pelatih }}</textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="mb-3 me-2" style="width: 50%">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Nomor HP</label>
                        <input type="text" value="{{ $data->nomor_hp_pelatih }}" name="nomor_hp_pelatih"
                            id="exampleFormControlInput1" class="form-control">
                    </div>
                    <div class="mb-3" style="width: 50%">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Email</label>
                        <input type="email" value="{{ $data->user->email }}" id="exampleFormControlInput1" name="email"
                            class="form-control">
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Ekstrakurikuler Diikuti</label>
                        @foreach ($data['ekstra'] as $item)
                            <p> - {{ $item->nama_ekstra }} ({{ $item->pivot->tahun_ajaran }})</p>
                        @endforeach
                    </div>
                </div>
                <input hidden readonly name="id" value="{{ $data->id }}">
                <input hidden readonly name="user_id" value="{{ $data->user_id }}">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-green mt-3 w-50">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
