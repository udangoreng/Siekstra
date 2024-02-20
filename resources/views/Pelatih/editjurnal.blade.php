<svg width="25" height="25" viewBox="0 0 506 506" fill="none" xmlns="http://www.w3.org/2000/svg"
    data-bs-toggle="modal" data-bs-target="#editJurnal">
    <path
        d="M470.679 16.3929C448.822 -5.46431 413.491 -5.46431 391.634 16.3929L361.592 46.3343L459.301 144.043L489.342 114.002C511.2 92.1447 511.2 56.8138 489.342 34.9566L470.679 16.3929ZM172.063 235.963C165.975 242.051 161.284 249.537 158.59 257.82L129.047 346.447C126.153 355.03 128.449 364.512 134.836 370.999C141.224 377.486 150.705 379.682 159.388 376.788L248.015 347.245C256.199 344.551 263.684 339.86 269.872 333.772L436.845 166.699L339.037 68.8902L172.063 235.963ZM95.8125 58.6103C42.916 58.6103 0 101.526 0 154.423V409.923C0 462.819 42.916 505.735 95.8125 505.735H351.312C404.209 505.735 447.125 462.819 447.125 409.923V314.11C447.125 296.445 432.853 282.173 415.188 282.173C397.522 282.173 383.25 296.445 383.25 314.11V409.923C383.25 427.588 368.978 441.86 351.312 441.86H95.8125C78.1471 441.86 63.875 427.588 63.875 409.923V154.423C63.875 136.757 78.1471 122.485 95.8125 122.485H191.625C209.29 122.485 223.562 108.213 223.562 90.5478C223.562 72.8824 209.29 58.6103 191.625 58.6103H95.8125Z"
        fill="#828282" />
</svg>


<div class="modal fade" id="editJurnal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ekstrakulikuler</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/pelatih/jurnal/{{ $jurnal->id }}" method="POST">
                @csrf
                <input type="text" class="form-control" value="{{ $jurnal['ekstra']->id }}" name="ekstra_id"
                    id="exampleFormControlInput1" readonly hidden>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Id Kegiatan</label>
                        <input type="text" class="form-control" value="{{ $jurnal['detail']->absensi_id }}"
                            id="exampleFormControlInput1" readonly>
                        <input type="text" class="form-control" value="{{ $jurnal['detail']->id }}" name="absensi_id"
                            id="exampleFormControlInput1" readonly hidden>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" value="{{ $jurnal->judul }}"
                            id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Jenis Kegiatan</label>
                        <input type="text" class="form-control" name="jenis_kegiatan"
                            value="{{ $jurnal->jenis_kegiatan }}" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" value="{{ $jurnal->lokasi }}"
                            id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ $jurnal->tanggal }}"
                            id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Kegiatan</label>
                        <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3">{{ $jurnal->deskripsi }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-green">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
