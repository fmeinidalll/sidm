@extends('layout.print')

@push('styles')
    <style>
        table.history td {
            border: 1px solid black;
            padding: 5px;
            color: black;
        }

        table.history th {
            padding: 5px;
        }

        table.history thead {
            background-color: #007CFF;
            border: 1px solid #007CFF;
            color: white !important;
        }

        .bg-gray {
            background-color: #F4F7FA;
        }
    </style>
@endpush
@section('container')
    <h3 class="text-center">LAPORAN HASIL KONSULTASI</h3>
    <br>
    <br>
    <h6>
        Nama : {{ $patient->name }}</br>
        Usia : {{ $patient->age }}</br>
        Alamat : {{ $patient->address }}</br>
    </h6>
    </br>
    <div class="table-responsive">
        <table class="w-100 table-bordered mb-0 js-serial history">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Gejala</th>
                    <th>Gejala</th>
                    <th>CF Pakar</th>
                    <th>CF Pengguna</th>
                    <th>CF(H|E)</th>
                </tr>
            </thead>
            <tbody>
                <?php $arrid = 0; ?>
                <?php $cf_old = 0; ?>
                <?php $no = 1; ?>
                @foreach ($roles as $key => $role)
                    @if ($hypothesis->id == $role->hypothesis_id)
                        <?php $ard = $arrid++; ?>
                        @if ($historyDetail[$ard]->value != 0)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $role->evidence->code }}</td>
                                <td>{{ $role->evidence->name }}</td>
                                <td class="text-end">{{ $role->value }}</td>
                                <td class="text-end">{{ $historyDetail[$ard]->value }}</td>
                                <td class="text-end">
                                    {{ $cfhe = $role->value * $historyDetail[$ard]->value }}</td>
                            </tr>
                            <?php $cf_old === 1 ? $cfhe : ($cf_old = $cf_old + $cfhe * (1 - $cf_old)); ?>
                        @endif
                    @endif
                @endforeach
                <tr>
                    <td colspan="5">CF Kombinasi</td>
                    <td class="text-end">{{ number_format($cf_old, 7, '.', '') }}</td>
                </tr>
                <tr>
                    <td colspan="5">CF Hasil (%)</td>
                    <td class="text-end">{{ number_format($cf_old * 100, 6, '.', '') }} %</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>

    <?php
    $percentage = number_format($cf_old * 100, 6, '.', '');
    $classification = '';
    if ($percentage >= 75){
        $classification = 'Resiko Tinggi';
    } elseif ($percentage >= 50 && $percentage <75) {
        $classification = 'Resiko Sedang';
    } else {
        $classification = 'Resiko Rendah';
    }

    $menu = [
        'id' => $hypothesis->id,
        'nama' => $hypothesis->name,
        'hsl' => number_format($cf_old * 100, 6, '.', ''),
        'slsi' => $hypothesis->solution,
    ];
    ?>
    <div class="w-full p-5 bg-gray">
        <h5>Hasil Diagnosa : </h5></br>
        <h1 class="text-center">
            {{ $menu['nama'] }}</br>{{ $menu['hsl'] }} %</br>
        </h1></br>
        <h5>Pengobatan : <br>
            {{ $history->result_treatment ? 'Gula Darah Puasa : ' . $history->result_treatment : 'Belum' }}
            <br>
            {{ $history->result_treatment ? 'Gula Darah Sewaktu : ' . ($history->random_treatment ?? 0) : 'Belum' }}
        </h5>
    </div>
    <br>
    <table class="w-100 table-bordered mb-0 js-serial history">
        <tbody>
            <tr>
                <td>
                    <h6>Solusi</h6></br>
                    <ul>
                        <!-- Loop untuk menampilkan setiap poin solusi -->
                        @foreach(explode('-', $menu['slsi']) as $point)
                            @if(trim($point) !== '')
                                <li>{{ trim($point) }}</li>
                            @endif
                        @endforeach
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
