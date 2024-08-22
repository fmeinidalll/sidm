<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - SIDM</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('mazer/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('mazer/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('mazer/vendors/chartjs/Chart.min.css') }}">

    <link rel="stylesheet" href="{{ asset('mazer/vendors/simple-datatables/style.css') }}">

    <link rel="stylesheet" href="{{ asset('mazer/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('mazer/images/favicon.svg') }}" type="image/x-icon">
</head>

<body class="bg-white">
    <div class="d-flex justify-content-center align-items-center" style="width: 100vw;height: 100vh;">
        <div class="w-50 d-flex justify-content-center align-items-center ">
            <img src="/mazer/images/loginn.jpg" alt="Logo" srcset="" style="width: 50vw;height:35vw;" />
        </div>
        <div class=" d-flex justify-content-center align-items-center"style="height: 100vh; width:40%">
            @yield('container')
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
