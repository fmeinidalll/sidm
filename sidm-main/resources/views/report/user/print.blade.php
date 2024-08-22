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
    <h3 class="text-center">LAPORAN PENGGUNA</h3>
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
                <th>Nama</th>
                <th>Usia</th>
                <th>Alamat</th>
                <th>Pengobatan</th>
                <th>Gejala</th>
                <th>Hasil Deteksi</th>
                <th>Rekomendasi</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $value)
                @php
                    $historyDetail = $value->historyDetails;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->patient->age }}</td>
                    <td>{{ $value->patient->address }}</td>
                    <td>{{ $value->result_treatment ? 'Gula Darah Puasa : ' . $value->result_treatment . ' dan Gula Darah Sewaktu : ' . ($history->random_treatment ?? 0) : 'Belum' }}</td>
                    <td>
                        @foreach ($historyDetail as $detail)
                            @php
                                if (!$detail->value) {
                                    continue;
                                }
                            @endphp
                            {{ $detail->evidence->name }}
                            ({{ $detail->value }})
                            <br>
                        @endforeach
                    </td>
                    <td>{{ $value->hypothesis->name }}</td>
                    <td>{{ $value->hypothesis->solution }}</td>
                    <td>{{ $value->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">
                        Laporan Pengguna Tidak Ditemukan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
