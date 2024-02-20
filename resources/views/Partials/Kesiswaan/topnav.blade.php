<nav class="bg-green navbar navbar-expand-md">
    <div class="container-fluid">
        <div class="navbar-logo d-flex ms-3 mt-2 mb-1 text-white justify-content-center align-items-center">
            <img class="me-4" src="{{ asset('image/stmj.png') }}" width="40px">
            <h4>Siekstra</h4>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ms-auto justify-content-end align-items-center me-2">
                <div class="dropdown">
                    <a class="dropdown-toggle text-white" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <svg width="30" height="30" viewBox="0 0 512 512" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_64_4)">
                                <path
                                    d="M399 384.2C376.9 345.8 335.4 320 288 320H224C176.6 320 135.1 345.8 113 384.2C148.2 423.4 199.2 448 256 448C312.8 448 363.8 423.3 399 384.2ZM0 256C0 188.105 26.9714 122.99 74.9807 74.9807C122.99 26.9714 188.105 0 256 0C323.895 0 389.01 26.9714 437.019 74.9807C485.029 122.99 512 188.105 512 256C512 323.895 485.029 389.01 437.019 437.019C389.01 485.029 323.895 512 256 512C188.105 512 122.99 485.029 74.9807 437.019C26.9714 389.01 0 323.895 0 256ZM256 272C275.096 272 293.409 264.414 306.912 250.912C320.414 237.409 328 219.096 328 200C328 180.904 320.414 162.591 306.912 149.088C293.409 135.586 275.096 128 256 128C236.904 128 218.591 135.586 205.088 149.088C191.586 162.591 184 180.904 184 200C184 219.096 191.586 237.409 205.088 250.912C218.591 264.414 236.904 272 256 272Z"
                                    fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_64_4">
                                    <rect width="512" height="512" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        {{-- <li><a class="dropdown-item" href="#">Profil</a></li> --}}
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
