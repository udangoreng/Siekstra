<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Siekstra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
</head>

<body>
    <div class="bg-green">
        <div class="d-flex align-items-center justify-content-center" style="height: 100vh">
            <div class="card shadow p-5 bg-body rounded">
                <div class="login d-flex">
                    <img src="{{ asset('image/login.png') }}" style="height: 250px" class="me-5" />
                    <div class="d-flex flex-column">
                        <div class="d-flex">
                            <img src="{{ asset('image/stmj.png') }}" style="height: 30px" />
                            <h3 class="ms-3">Login</h3>
                        </div>
                        @if ($errors->any())
                            <div>
                                <div class="alert alert-danger mt-2" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <form action="" method="POST">
                            @csrf
                            <label class="fw">Username</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-control"
                                placeholder="Username">
                            <label class="fw mt-3">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <button class="btn-green btn mt-4" style="width: 100%">Login <svg class="ms-3"
                                    width="15" height="15" viewBox="0 0 500 438" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M343.75 62.5H406.25C423.535 62.5 437.5 76.4648 437.5 93.75V343.75C437.5 361.035 423.535 375 406.25 375H343.75C326.465 375 312.5 388.965 312.5 406.25C312.5 423.535 326.465 437.5 343.75 437.5H406.25C458.008 437.5 500 395.508 500 343.75V93.75C500 41.9922 458.008 0 406.25 0H343.75C326.465 0 312.5 13.9648 312.5 31.25C312.5 48.5352 326.465 62.5 343.75 62.5ZM334.57 240.82C346.777 228.613 346.777 208.789 334.57 196.582L209.57 71.582C197.363 59.375 177.539 59.375 165.332 71.582C153.125 83.7891 153.125 103.613 165.332 115.82L237.012 187.5H31.25C13.9648 187.5 0 201.465 0 218.75C0 236.035 13.9648 250 31.25 250H237.012L165.332 321.68C153.125 333.887 153.125 353.711 165.332 365.918C177.539 378.125 197.363 378.125 209.57 365.918L334.57 240.918V240.82Z"
                                        fill="white" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    </div>
</body>

</html>
