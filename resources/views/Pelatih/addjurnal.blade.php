<button type="button" class="btn btn-green" data-bs-toggle="modal" data-bs-target="#addJurnal">
    Tambah Jurnal
</button>


<div class="modal fade" id="addJurnal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ekstrakulikuler</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/pelatih/jurnal/add" method="POST">
                @csrf
                <input type="text" class="form-control" value="{{ $detail->ekstra_id }}" name="ekstra_id"
                    id="exampleFormControlInput1" readonly>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Id Kegiatan</label>
                        <input type="text" class="form-control" value="{{ $detail->absensi_id }}"
                            id="exampleFormControlInput1" readonly>
                        <input type="text" class="form-control" value="{{ $detail->id }}" name="absensi_id"
                            id="exampleFormControlInput1" readonly hidden>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Jenis Kegiatan</label>
                        <input type="text" class="form-control" name="jenis_kegiatan" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Kegiatan</label>
                        <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3"></textarea>
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
