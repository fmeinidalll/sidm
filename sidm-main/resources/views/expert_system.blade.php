@extends('layout.main')

@section('container')
    @php
        $required = '<span class="text-danger">*</span> ';
    @endphp
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-danger alert-dismissible show fade">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form class="form form-vertical" method="post" action="{{ route('expert-system-post') }}">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="name" class="form-label">Nama {!! $required !!}</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Nama"
                                        value="{{ old('name', $data['name'] ?? '') }}" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="dob" class="form-label">Tanggal Lahir {!! $required !!}</label>
                                    <input type="date" name="dob" id="dob"
                                        class="form-control @error('dob') is-invalid @enderror"
                                        value="{{ old('dob', $data['dob'] ?? '') }}" />
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="gender" class="form-label">Jenis Kelamin {!! $required !!}</label>
                                    <select name="gender" id="gender"
                                        class="form-select @error('gender') is-invalid @enderror">
                                        <option value="Male"
                                            {{ old('gender', $data['gender'] ?? '') == 'Male' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="Female"
                                            {{ old('gender', $data['gender'] ?? '') == 'Female' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="address" class="form-label">Alamat</label>
                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address', $data['address'] ?? '') }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <style>
                                    .table-custom td, .table-custom th {padding: 6px; }
                                </style>

                                <div class="col-12 mb-3">
                                    <table class="table table-custom" style="font-size: 0.79rem;">
                                        <strong>Petunjuk Pengisian:</strong>
                                            <tbody>
                                                <tr>
                                                    <th>Sering BAK (Poliuri)</th>
                                                    <th>Sering Lapar (Polifagia)</th>
                                                    <th>Sering Haus (Polidipsia)</th>
                                                </tr>
                                                <tr>
                                                    <td>Tidak Pernah : Tidak BAK</td>
                                                    <td>Tidak Pernah : Tidak lapar</td>
                                                    <td>Tidak Pernah : Tidak haus</td>
                                                </tr>
                                                <tr>
                                                    <td>Jarang : 1-5 kali perhari</td>
                                                    <td>Jarang : 1-2 kali makan perhari</td>
                                                    <td>Jarang : 1-5 gelas perhari</td>
                                                </tr>
                                                <tr>
                                                    <td>Cukup Sering : 6-7 kali perhari</td>
                                                    <td>Cukup Sering : 3-4 kali makan perhari</td>
                                                    <td>Cukup Sering : 8-10 gelas perhari</td>
                                                </tr>
                                                <tr>
                                                    <td>Sering : 8-10 kali perhari</td>
                                                    <td>Sering : 5-6 kali makan perhari</td>
                                                    <td>Sering : 15-20 gelas perhari</td>
                                                </tr>
                                                <tr>
                                                    <td>Sangat Sering : lebih 10 kali perhari</td>
                                                    <td>Sangat Sering : lebih 6 kali makan perhari</td>
                                                    <td>Sangat Sering : lebih 20 gelas perhari</td>
                                                </tr>
                                                <tr>
                                                    <td> </td>
                                                    <td> </td>
                                                    <td> </td>
                                                </tr>
                                                <tr>
                                                    <th>Penurunan Berat Badan</th>
                                                    <th>Pusing, Mual, Muntah, Lelah, Lemas, Kantuk,
                                                    </br>Gatal, Kesemutan, Pandangan Kabur, Nyeri Otot</th>
                                                    <th>Luka Sulit Sembuh, Mudah Infeksi</th>
                                                </tr>
                                                <tr>
                                                    <td>Tidak Pernah : tidak mengalami penurunan (BB stabil)</td>
                                                    <td>Tidak Pernah : tindak mengalami gejala tersebut</td>
                                                    <td>Tidak Pernah : tidak mengalami luka dan infeksi</td>
                                                </tr>
                                                <tr>
                                                    <td>Jarang : 0.1-0.4 kg perminggu</td>
                                                    <td>Jarang : 1-3 kali pertiga hari</td>
                                                    <td>Jarang : 3-7 hari</td>
                                                </tr>
                                                <tr>
                                                    <td>Cukup Sering : 0.5-1 kg perminggu</td>
                                                    <td>Cukup Sering : 4-6 kali pertiga hari</td>
                                                    <td>Cukup Sering : 1-2 minggu</td>
                                                </tr>
                                                <tr>
                                                    <td>Sering : 2-5 kg perminggu</td>
                                                    <td>Sering : 7-9 kali pertiga hari</td>
                                                    <td>Sering : 1-3 bulan</td>
                                                </tr>
                                                <tr>
                                                    <td>Sangat Sering : lebih 5 kg perminggu</td>
                                                    <td>Sangat Sering : lebih 9 kali pertiga hari</td>
                                                    <td>Sangat Sering : lebih 3 bulan</td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Gejala</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>G0001</td>
                                            <td>Usia</td>
                                            <td class="d-flex">
                                                <select class="form-select" id="age">
                                                    <option value="0" selected>0 - 20 Tahun</option>
                                                    <option value="1">Lebih dari 20 Tahun</option>
                                                </select>
                                            </td>
                                        </tr>
                                        @php
                                            $iteration = 2;
                                        @endphp
                                        @foreach ($evidences as $evidence)
                                            @php
                                                $hidden = false;
                                                if ($evidence->code == 'G0001' || $evidence->code == 'G0002') {
                                                    $hidden = true;
                                                    $iteration--;
                                                }
                                            @endphp
                                            <tr class="{{ $hidden ? 'd-none' : '' }}">
                                                <td>{{ $iteration++ }}</td>
                                                <td>{{ $evidence->code }}</td>
                                                <td>
                                                    {{ $evidence->name }}
                                                    <input type="hidden" id="in_id_evidence-{{ $evidence->id }}"
                                                        name="id_evidence[]" value="{{ $evidence->id }}">
                                                </td>
                                                <td class="align-middle" style="width: 30%">
                                                    @if (in_array($evidence->code, ['G0006', 'G0008', 'G0020']))
                                                        <select class="form-select" name="evidance_value[]"
                                                            id="chk-{{ $evidence->code }}">
                                                            <option value="0">
                                                                Tidak
                                                            </option>
                                                            <option value="1">
                                                                Iya
                                                            </option>
                                                        </select>
                                                    @else
                                                        @if ($setting_type_input->input_type == 'range')
                                                            <input class="w-100" type="range" type="range"
                                                                id="rng-{{ $evidence->id }}" min="0"
                                                                max="{{ $values->count() - 1 }}" value="0">
                                                            <input type="hidden" id="in_val_evidence-{{ $evidence->id }}"
                                                                name="evidance_value[]" value="">
                                                            <div class="d-flex justify-content-between">
                                                                <span>{{ $min->name }}</span>
                                                                <span
                                                                    id="rngOutput-{{ $evidence->id }}">{{ $evidence->value }}</span>
                                                                <span>{{ $max->name }}</span>
                                                            </div>
                                                        @elseif ($setting_type_input->input_type == 'select')
                                                            <select class="form-select" name="evidance_value[]"
                                                                id="chk-{{ $evidence->code }}">
                                                                @foreach ($values as $value)
                                                                    <option value="{{ $value->value }}">
                                                                        {{ $value->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="col-12 mb-3">
                                    <label for="already_treatment" class="form-label">Sudah Berobat?</label>
                                    <select class="form-select  @error('address') is-invalid @enderror"
                                        name="already_treatment" id="already_treatment">
                                        <option value="1"
                                            {{ old('address', $data['already_treatment'] ?? 0) == 1 ? 'selected' : '' }}>
                                            Sudah</option>
                                        <option value="0"
                                            {{ old('address', $data['already_treatment'] ?? 0) == 0 ? 'selected' : '' }}>
                                            Belum</option>
                                    </select>
                                    @error('already_treatment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3 d-none" id="result_treatment_wrapper">
                                    <label for="result_treatment" class="form-label">Nilai Gula Darah Puasa
                                        {!! $required !!}</label>
                                    <input type="text" name="result_treatment" id="result_treatment"
                                        class="form-control @error('result_treatment') is-invalid @enderror"
                                        placeholder="Nilai Gula Darah"
                                        value="{{ old('result_treatment', $data['result_treatment'] ?? '0') }}" />
                                    @error('result_treatment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3 d-none" id="random_treatment_wrapper">
                                    <label for="random_treatment" class="form-label">Nilai Gula Darah Sewaktu
                                        {!! $required !!}</label>
                                    <input type="text" name="random_treatment" id="random_treatment"
                                        class="form-control @error('random_treatment') is-invalid @enderror"
                                        placeholder="Nilai Gula Darah Acak"
                                        value="{{ old('random_treatment', $data['random_treatment'] ?? '0') }}" />
                                    @error('random_treatment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
                                            <path
                                                d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5zm0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065l.087-.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8 4.617 4.322zm.344 7.646.087.065-.087-.065z" />
                                        </svg> Proses
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    @foreach ($evidences as $evidence)
        <script>
            var rng_{{ $evidence->id }} = document.getElementById("rng-{{ $evidence->id }}");
            var ro_{{ $evidence->id }} = document.getElementById("rngOutput-{{ $evidence->id }}");
            var in_val_evidence_{{ $evidence->id }} = document.getElementById("in_val_evidence-{{ $evidence->id }}");
            var myRange_{{ $evidence->id }} = [
                @foreach ($values as $value)
                    {{ $value->value }},
                @endforeach
            ];

            function updateRange() {
                ro_{{ $evidence->id }}.textContent = myRange_{{ $evidence->id }}[parseInt(rng_{{ $evidence->id }}.value, 10)]
                    .toFixed(2) * 100 + '%';
                in_val_evidence_{{ $evidence->id }}.value = myRange_{{ $evidence->id }}[parseInt(rng_{{ $evidence->id }}
                    .value, 10)].toFixed(2);
            };
            window.addEventListener("DOMContentLoaded", updateRange);
            rng_{{ $evidence->id }}.addEventListener("input", updateRange);
        </script>
    @endforeach
    <script>
        let ageInput = document.querySelector('#age');
        let chkunder20 = document.querySelector('#chk-G0001');
        let chkover20 = document.querySelector('#chk-G0002');
        chkover20.value = 0;
        chkunder20.value = 1;
        ageInput.addEventListener('change', function() {
            if (ageInput.value == 0) {
                chkunder20.value = 1;
                chkover20.value = 0;
            } else {
                chkunder20.value = 0;
                chkover20.value = 1;
            }
        });
    </script>
    <script>
        let alreadyTreatment = document.querySelector('#already_treatment');
        let resultTreatment = document.querySelector('#result_treatment_wrapper');
        alreadyTreatment.addEventListener('change', function() {
            if (alreadyTreatment.value == 1) {
                resultTreatment.classList.remove('d-none');
            } else {
                resultTreatment.classList.add('d-none');
            }
        });
    </script>
    <script>
        let randomTreatment = document.querySelector('#random_treatment_wrapper');
        alreadyTreatment.addEventListener('change', function() {
            if (alreadyTreatment.value == 1) {
                randomTreatment.classList.remove('d-none');
            } else {
                randomTreatment.classList.add('d-none');
            }
        });
    </script>
@endsection
