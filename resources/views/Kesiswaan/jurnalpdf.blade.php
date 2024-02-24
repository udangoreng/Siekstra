<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jurnal Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div>
        <h2>Laporan Kegiatan</h2>
        <div style="border-bottom: 8px double #000000; margin-bottom: 1rem;"></div>
        @foreach ($jurnal as $item)
            <div>
                <h1 class="fw-bold">{{ $item->judul }}</h1>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Penulis</td>
                            <td>:</td>
                            <td>{{ $item['pelatih']->nama_pelatih }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Ditulis</td>
                            <td>:</td>
                            <td>{{ $item->tanggal }}</td>
                        </tr>
                        <tr>
                            <td>ID Kegiatan</td>
                            <td>:</td>
                            <td>{{ $item['detail']->absensi_id }}</td>
                        </tr>
                        <tr>
                            <td>Ekstrakurikuler</td>
                            <td>:</td>
                            <td>{{ $item['ekstra']->nama_ekstra }}</td>
                        </tr>
                        <tr>
                            <td>Lokasi</td>
                            <td>:</td>
                            <td>{{ $item->lokasi }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kegiatan</td>
                            <td>:</td>
                            <td>{{ $item->jenis_kegiatan }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div
                style="border-bottom: 3px solid #d8d6d6; margin-right: 2.5rem; margin-bottom: 1.5rem; margin-top: 0.5rem;">
            </div>
            <div class="mb-3">
                <h5 class="fw-semibold">Deskripsi Kegiatan</h5>
                <p style="white-space: pre-line; text-align: justify; margin-right: 2.5rem;">
                    {{ $item->deskripsi }}</p>
            </div>

            <div
                style="border-bottom: 3px solid #d8d6d6; margin-right: 2.5rem; margin-bottom: 1.5rem; margin-top: 0.5rem;">
            </div>
            <div class="page-break"></div>

            <div>
                <h2 class="fw-semibold">Absensi Siswa</h2>
                <table style="width: 100;">
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
        @endforeach
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
