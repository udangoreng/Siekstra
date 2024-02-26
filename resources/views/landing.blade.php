<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siekstra | Sistem Informasi Ekstrakurikuler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
</head>

<body>
    @include('sweetalert::alert')
    <nav class="bg-green navbar navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-white"><img src="{{ asset('image/stmj.png') }}"
                    style="width: 25px; margin-right: 1rem;" />Siekstra</a>
            <a class="d-flex justify-content-end text-white" aria-current="page" href="/login">Login</a>
        </div>
    </nav>
    <div class="mt-6 my-5 mx-5">
        <div>
            <div class="d-flex align-items-center justify-content-between mt-5">
                <div style="width: 15%"></div>
                <div style="width: 35%;" class="justify-item-center align-items-center">
                    <h2 class="fw-bold">Siekstra | </h2>
                    <h3 class="fw-semibold">Sistem Informasi Ekstrakurikuler</h3>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis in, quibusdam ab facilis deleniti
                    beatae
                    consequatur illum temporibus eligendi dolor aperiam vero cumque reprehenderit minus laboriosam eos
                    voluptate
                    id quis?
                </div>
                <div style="width: 50%;" class="d-flex align-items-center justify-content-center">
                    <img src="{{ asset('image/ekstra.png') }}" style="height: 350px;" />
                </div>
            </div>
        </div>

        <div class="d-flex mx-auto justify-content-center bg-green p-4 rounded-4 my-5" style="width: 40%;">
            <div class="text-white text-center">
                <h5>{{ count($ekstra) }}</h5>
                <p>Ekstrakurikuler</p>
            </div>
            <div style="border-left: 3px solid #ffffff; margin-right: 2.5rem; margin-left: 2.5rem;">
            </div>
            <div class="text-white text-center">
                <h5>{{ $siswa }}</h5>
                <p>Siswa Terdaftar</p>
            </div>
        </div>


        <div class="container mt-6 pt-5 mb-3">
            <h3 class="text-center">Ekstrakurikuler Siswa</h3>
            <div class="row row-cols-2 mb-3">
                @foreach ($ekstra as $item)
                    @if (array_key_exists('ekstra', $item[0]->toArray()))
                        <div class="col my-3">
                            <h6 class="fw-bold">{{ $item[0]->ekstra->nama_ekstra }}</h6>
                            <p>{{ $item[0]->ekstra->deskripsi_ekstra }}</p>
                            <div>
                                <p>Jadwal : </p>
                                <p>{{ $item[0]->hari }} | {{ substr($item[0]->waktu_mulai, 0, 5) }} -
                                    {{ substr($item[0]->waktu_selesai, 0, 5) }}
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="col my-3">
                            <h6 class="fw-bold">{{ $item[0]->nama_ekstra }}</h6>
                            <p>{{ $item[0]->deskripsi_ekstra }}</p>
                            <div>
                                <p>Jadwal : </p>
                                <p>- | -
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

    </div>
    <div class="footer p-3 bg-green">
        <p class="text-center text-white">©️ 2024 SMKN 1 JENANGAN PONOROGO</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>
