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
    <div class="mt-6 mx-5">
        <div>
            <div class="d-flex align-items-center justify-content-between mt-5">
                <div style="width: 50%;">
                    <h3>Sistem Informasi Ekstrakurikuler</h3>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis in, quibusdam ab facilis deleniti
                    beatae
                    consequatur illum temporibus eligendi dolor aperiam vero cumque reprehenderit minus laboriosam eos
                    voluptate
                    id quis?
                </div>
                <div style="width: 50%;" class="d-flex align-items-center justify-content-center">
                    <img src="{{ asset('image/ekstra.png') }}" style="height: 250px;" />
                </div>
            </div>
        </div>
        {{-- <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('image/head1.jpg') }}" class="d-block w-90" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('image/head2.jpg') }}" class="d-block w-90" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('image/head3.jpg') }}" class="d-block w-90" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div> --}}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>
