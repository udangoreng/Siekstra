@extends('layouts.kesiswaan')
@section('title', 'Siswa')
@section('main')
    <div class="kesiswaan-section p-3 me-4">
        <div>
            <h2 class="fw-bolder">Detail Siswa</h2>
        </div>
        <div>
            <form method="POST" id="edit" action="/kesiswaan/pelatih/edit/">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">NIS</label>
                    <input name="NIS" type="text" class="form-control" value="{{ $siswa->NIS }}">
                    <input name="user_id" type="text" class="form-control" value="{{ $siswa->user_id }}" hidden readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Nama Siswa</label>
                    <input name="nama_siswa" type="text" class="form-control" value="{{ $siswa->nama_siswa }}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fw-semibold">Kelas</label>
                    <input name="kelas" type="text" class="form-control" value="{{ $siswa->kelas }}">
                </div>
                <div class="d-flex justify-content-between">
                    <div style="width: 50%" class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Nomor Handphone</label>
                        <input name="nomor_hp_siswa" type="text" class="form-control"
                            value="{{ $siswa->nomor_hp_siswa }}">
                    </div>
                    <div style="width: 50%" class="mb-3 ms-3 ">
                        <label for="exampleFormControlInput1" class="form-label fw-semibold">Email</label>
                        <input name="email" type="email" class="form-control" value="{{ $email }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Alamat</label>
                    <textarea name="alamat_siswa" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $siswa->alamat_siswa }}</textarea>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label fw-semibold">Ekstrakurikuler Diikuti</label>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#assignModal">
                        <svg width="20" height="20" viewBox="0 0 510 510" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M478.125 223.125H286.875V31.875C286.875 23.4212 283.517 15.3137 277.539 9.33598C271.561 3.35826 263.454 0 255 0C246.546 0 238.439 3.35826 232.461 9.33598C226.483 15.3137 223.125 23.4212 223.125 31.875V223.125H31.875C23.4212 223.125 15.3137 226.483 9.33598 232.461C3.35826 238.439 0 246.546 0 255C0 263.454 3.35826 271.561 9.33598 277.539C15.3137 283.517 23.4212 286.875 31.875 286.875H223.125V478.125C223.125 486.579 226.483 494.686 232.461 500.664C238.439 506.642 246.546 510 255 510C263.454 510 271.561 506.642 277.539 500.664C283.517 494.686 286.875 486.579 286.875 478.125V286.875H478.125C486.579 286.875 494.686 283.517 500.664 277.539C506.642 271.561 510 263.454 510 255C510 246.546 506.642 238.439 500.664 232.461C494.686 226.483 486.579 223.125 478.125 223.125Z"
                                fill="#828282" />
                        </svg>
                    </button>
                </div>

                <div class="d-flex justify-content-between">
                    @foreach ($siswa->ekstra as $item)
                        <div class="card">
                            <div class="card-body">Meow</div>
                        </div>
                    @endforeach
                </div>

                <input type="text" name="id" value="" disabled readonly hidden>
                <div class="d-flex justify-content-between mt-3">
                    <a href="/kesiswaan/siswa" class="btn btn-secondary me-2" style="width: 50%">Kembali</a>
                    <button formaction="/kesiswaan/siswa/edit/{{ $siswa->id }}" class="btn-green btn" style="width: 50%"
                        name="action">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
