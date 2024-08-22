@extends('layout.print')

@push('styles')
    <style>
        table.report td {
            border: 1px solid black;
            padding: 5px;
            color: black !important;
        }

        table.report th {
            padding: 5px;
            color: black !important;
            border: 1px solid black;
            text-align: center;
        }

        table.report thead {
            /* background-color: #007CFF; */
            border: 1px solid black;
            color: black !important;
        }

        .bg-gray {
            background-color: #F4F7FA;
        }
    </style>
@endpush
@section('container')
    <h3 class="text-center">LAPORAN PENYAKIT DIABETES MELITUS</h3>
    <br>
    <br>
    @if ($date_start && $date_end)
        <h6>
            Tanggal : {{ date('d-m-Y', strtotime($date_start)) }} s/d {{ date('d-m-Y', strtotime($date_end)) }}</br>
        </h6>
        </br>
    @else
        <h6>
            Tanggal : Keseluruhan</br>
        </h6>
        <br>
    @endif
    <table class="table table-striped report" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Penyakit</th>
                <th>Nama Penyakit</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $value)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $value->code }}</td>
                    <td>{{ $value->name }}</td>
                    <td class="text-center">{{ $value->history_count }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Laporan Penyakit Tidak Ditemukan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
