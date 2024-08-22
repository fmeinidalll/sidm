@extends('layout.main')

@section('container')
    @php
        $required = '<span class="text-danger">*</span> ';
    @endphp
    <div class="page-content">
        <a href="{{ route('report.user.print', [
            'date_start' => $date_start,
            'date_end' => $date_end,
        ]) }}"
            type="button" class="btn btn-primary">
            Cetak PDF
        </a>
        <section class="section mt-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Laporan Pengguna</h4>
                </div>
                <div class="card-body w-50">
                    <form action="{{ route('report.user.index') }}" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label for="date_start" class="col-sm-3 col-form-label">Periode Awal </label>
                            <div class="col-sm-9">
                                <input type="date" name="date_start" id="date_start"
                                    class="form-control @error('date_start') is-invalid @enderror"
                                    placeholder="Periode Awal" value="{{ $date_start }}" />
                                @error('date_start')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="date_end" class="col-sm-3 col-form-label">Periode Akhir </label>
                            <div class="col-sm-9">
                                <input type="date" name="date_end" id="date_end"
                                    class="form-control @error('date_end') is-invalid @enderror" placeholder="Periode Akhir"
                                    value="{{ $date_end }}" />
                                @error('date_end')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="hypothesis" class="col-sm-3 col-form-label">Penyakit </label>
                            <div class="col-sm-9">
                                <select class="form-select form-select-md @error('hypothesis') is-invalid @enderror"
                                    name="hypothesis" id="hypothesis">
                                    <option value="" selected>Semua Penyakit </option>
                                    @foreach ($hypothesis as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $hypothesis_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('hypothesis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                            &nbsp;
                            Filter
                        </button>
                        <a type="button" href="{{ route('report.user.index') }}" class="btn btn-warning">
                            <i class="bi bi-reset"></i>
                            &nbsp;
                            Reset
                        </a>
                    </form>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Laporan Pengguna</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
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
                                        <td>{{ $value->result_treatment ? 'Gula Darah Puasa : ' .  $value->result_treatment . ' dan Gula Darah Sewaktu : ' . ($history->random_treatment ?? 0) : 'Belum' }}
                                        </td>
                                        <td>
                                            @foreach ($historyDetail as $detail)
                                                @php
                                                    if (!$detail->value) {
                                                        continue;
                                                    }
                                                @endphp
                                                <span class="badge bg-primary">{{ $detail->evidence->name }}
                                                    ({{ $detail->value }})
                                                </span>
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
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
