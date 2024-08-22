<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - SIDM</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/mazer/images/favicon.svg') }}">
    {{-- favicon --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('mazer/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('mazer/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('mazer/vendors/chartjs/Chart.min.css') }}">

    <link rel="stylesheet" href="{{ asset('mazer/vendors/simple-datatables/style.css') }}">

    <link rel="stylesheet" href="{{ asset('mazer/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('/mazer/images/favicon.svg') }}" type="image/x-icon">

</head>

<body>
    <div id="app">
        @include('layout.sidebar')
        <div id="main" class="layout-navbar">
            <header class="mb-3">
                <nav class="navbar navbar-expand navbar-light ">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="ms-5">
                            {{-- <h4> SISTEM DETEKSI DINI DM
                                PUSKESMAS SUMBERSARI</h4> --}}
                        </div>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            </ul>
                            @if (auth()->check())
                                <div class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                        <div class="user-menu d-flex">
                                            <div class="user-name text-end me-3">
                                                <h6 class="mb-0 text-gray-600">{{ auth()->user()->name }}</h6>
                                                <p class="mb-0 text-sm text-gray-600">{{ auth()->user()->level }}</p>
                                            </div>
                                            <div class="user-img d-flex align-items-center">
                                                <div class="avatar bg-primary">
                                                    <span
                                                        class="avatar-content">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <h6 class="dropdown-header">Halo,
                                                {{ explode(' ', auth()->user()->name)[0] }}</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('profile') }}"><i
                                                    class="icon-mid bi bi-person me-2"></i> Profile Saya</a></li>
                                        <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                                    class="icon-mid bi bi-box-arrow-left me-2"></i> Keluar</a></li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content" style="padding-top: 0px;">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @yield('container')

            </div>
        </div>
    </div>

    <script src="{{ asset('mazer/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('mazer/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('mazer/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="{{ asset('mazer/vendors/ckeditor/ckeditor.js') }}"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    {{-- <script src="{{ asset('mazer/vendors/apexcharts/apexcharts.js')}}"></script>
    <script src="{{ asset('mazer/js/pages/dashboard.js')}}"></script> --}}

    <script src="{{ asset('mazer/js/main.js') }}"></script>




</body>

</html>
