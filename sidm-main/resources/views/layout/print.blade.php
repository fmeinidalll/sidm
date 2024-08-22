<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $title }} - SIDM</title>
    <link rel="stylesheet" href="{{ 'mazer/css/bootstrap.css' }}">
    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            color: black;
            margin: 0px;
            padding: 0px;
        }

        .flex {
            display: flex;
        }

        hr.new1 {
            border: 2px solid black;
            margin: 10px 0px 0px 0px;
            opacity: 1;
        }

        hr.new2 {
            border: 1px solid black;
            margin: 2px 0px 50px 0px;
        }

        @page {
            margin: 180px 50px;
        }

        #header {
            position: fixed;
            left: 0px;
            top: -180px;
            right: 0px;
            height: 150px;
            text-align: center;
        }

        #footer {
            position: fixed;
            left: 0px;
            bottom: -180px;
            right: 0px;
            height: 50px;
        }

        #footer .page:after {
            content: counter(page, upper-roman);
        }
    </style>

    @stack('styles')
</head>

<body class="bg-white">
    <div id="header">
        <div class="mx-5">
            <div class="text-center w-full position-relative">
                <div class="position-absolute top-0 left-0">
                    <img src="mazer/images/logo/kabjember.png" alt="Logo" class="float-left" srcset=""
                        style="width: 6rem;height:6rem;" />
                </div>
                <div class="mt-2">
                    <h2>UPTD PUSKESMAS SUMBERSARI</h2>
                    <p>Jl. Let. Jend. Panjaitan No.42 Telp (0331) 337344 Jember</p>
                    <h2>SUMBERSARI</h2>
                </div>
            </div>
        </div>
        <strong>
            <p class="text-end">Kode Pos 68121</p>
        </strong>
        <hr class="new1">
        <hr class="new2 ">
    </div>
    <div id="footer">
        {{-- generate code uniq document --}}
        <table class="table">
            <tr>
                <td>
                    doc: {{ $document['code'] }}
                </td>
                <td class="text-end">
                    {{ $document['date'] }}
                </td>
            </tr>
        </table>
    </div>
    <div id="content">
        @yield('container')
    </div>
</body>

</html>
