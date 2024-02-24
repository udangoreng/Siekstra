<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <h2>Laporan Absensi Siswa</h2>
    <div style="border-bottom: 8px double #000000; margin-bottom: 1rem;"></div>
    <div>
        <table class="table">
            <tr>
                <td>Absensi Tanggal</td>
                <td> : </td>
                <td>{{ $detail->tanggal_mulai }} - {{ $detail->tanggal_selesai }}</td>
            </tr>
            <tr>
                <td>Kategori Absensi</td>
                <td> : </td>
                <td>{{ $detail->kategori }}</td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td> : </td>
                <td>{{ $detail->deskripsi }}</td>
            </tr>
        </table>
    </div>
    <div style="border-bottom: 3px solid #d8d6d6; margin-right: 2.5rem; margin-bottom: 1.5rem; margin-top: 1.5rem;">
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Kelas</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absen as $item)
                {{ $item }}
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['siswa']->nama_siswa }}</td>
                    <td>{{ $item['siswa']->kelas }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
            @foreach ($siswa as $item)
                <tr>
                    <td>-</td>
                    <td>{{ $item->nama_siswa }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td>Belum Melakukan Absensi</td>
                    <td>-</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
