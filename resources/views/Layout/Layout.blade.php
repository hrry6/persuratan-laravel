<html>

<head>
    @vite(['resources/sass/app.scss','resources/js/app.js'])
    <title>@yield('title')</title>
    @yield('header')

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /* Show it is fixed to the top */
        body {
            min-height: 75rem;
            padding-top: 4.5rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light navbar-dark bg-dark color-dark fixed-top p-3">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Thunder Mail</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      
          <div class=" collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto ">
              <li class="nav-item">
                <a class="nav-link mx-2 active" aria-current="page" href="{{ url('dashboard/surat') }}">Dashboard</a>
              </li>
              @if (Auth::check() && Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link mx-2 active" href="{{ url('managemen-user/user') }}">Data User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2 active" href="{{ url('jenis-surat/surat') }}">Data Jenis Surat</a>
                </li>
              @endif
              <li class="nav-item">
                <a class="nav-link mx-2 active" href="{{ url('transaksi-surat') }}">Transaksi Surat</a>
              </li>
            </ul>
            <form method="get" action="/logout" class="navbar-nav ms-auto d-none d-lg-inline-flex">        
                @csrf
                <input type="submit" class="btn btn-danger" value="logout">
            </form>
          </div>
        </div>
      </nav>
    {{-- <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Thunder Mail</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('dashboard/surat') }}">Dashboard</a>
                    </li>
                    @if (Auth::check() && Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('managemen-user/user') }}">Data User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('jenis-surat/surat') }}">Data Jenis Surat</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('transaksi-surat') }}">Transaksi Surat</a>
                    </li>
                </ul>
                <form method="get" action="/logout">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="logout">
                </form>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav> --}}

    <div class="container">
        @include('layout.flash-message')
        <br>
        <br>
        @yield('content')
    </div>
</body>
<footer>
    @yield('footer')
</footer>
<html>