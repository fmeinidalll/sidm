@extends('layout.main')

@section('container')
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    @foreach ($hypothesyes as $hypothesis)
                    <!-- menampilkan 1 tabel -->
                 
                        <h6>Penyakit : {{ $hypothesis->name }} </h6>
                        <div class="table-responsive">
                            <table class="w-100 table-bordered mb-0 js-serial">
                                <thead>
                                    <tr>
                                        <th>Gejala</th>
                                        <th>CF Pakar</th>
                                        <th>CF Pengguna</th>
                                        <th>CF(H|E)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $arrid = 0; ?>
                                    <?php $cf_old = 0; ?>
                                    @foreach ($roles as $key => $role)
                                        @if ($hypothesis->id == $role->hypothesis_id)
                                            <?php $ard = $arrid++; ?>
                                            @if ($historyDetail[$ard]->value != 0)
                                                <tr>
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
                                        <td colspan="3">CF Kombinasi</td>
                                        <td class="text-end">{{ number_format($cf_old, 7, '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">CF Hasil (%)</td>
                                        <td class="text-end">{{ number_format($cf_old * 100, 6, '.', '') }} %</td>
                                    </tr>

                                </tbody>
                            </table>
                            <hr>
                        </div>
                        <?php
                        $menu[] = [
                            'id' => $hypothesis->id,
                            'nama' => $hypothesis->name,
                            'hsl' => number_format($cf_old * 100, 6, '.', ''),
                            'slsi' => $hypothesis->solution,
                        ];
                        ?>
                       
                    @endforeach
                    <?php
                    $b = 0;
                    foreach ($menu as $index => $record) {
                        if ($record['hsl'] > $b) {
                            $a = $record['id'];
                            $b = $record['hsl'];
                            $c = $record['nama'];
                            $d = $record['slsi'];
                        }
                    }

                    ?>
                    <p>
                    <h6>Kesimpulan : </h6>
                    Nama : {{ $patient->name }}</br>
                    Pengobatan :
                    {{ $history->result_treatment ? 'Gula Darah Puasa : ' . $history->result_treatment . ' dan Gula Darah Sewaktu : ' . ($history->random_treatment ?? 0) : 'Belum'  }}</br>
                    Hasil : {{ $c }} dengan nilai {{ $b }} %</br>

                    <!-- penambahan logika pengelompokan -->
                    <?php
                        $classification = '';
                        $percentage = $cf_old * 100;

                        ?>

                    Rekomendasi :

                    <ul>
                        <!-- Loop untuk menampilkan setiap poin solusi -->
                        @foreach(explode('-', $d) as $point)
                        <!-- Menghilangkan poin yang kosong pada solusi -->
                            @if(trim($point) !== '')
                                <li>{{ trim($point) }}</li>
                            @endif
                        @endforeach
                    </ul>
                    <hr>
                    <div class="d-flex gap-1">
                        <a href="{{ route('history.print', $history->id) }}"
                            class="btn btn-success d-flex justify-content-center align-items-center"
                            style="width: fit-content" target="_blank">
                            <i class="bi bi-printer"></i>
                            &nbsp;
                            Cetak</a>
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                    </div>
                    <hr>
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
