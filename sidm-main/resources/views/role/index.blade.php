@extends('layout.main')

@section('container')
    <div class="page-content">
        <section class="section">
            <div class="card">
                <form action="{{ route('role.store') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <h4 class="card-title">{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($hypothesis as $hypothesys)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><b> {{ $hypothesys->name }}</b></span>
                                    <a class="btn btn-primary btn-sm" data-bs-toggle="collapse"
                                        data-bs-target="#collapseExample{{ $hypothesys->id }}" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                        </svg> Tampilkan</a>
                                </li>
                                <div class="collapse list-group-item list-group-item-action"
                                    id="collapseExample{{ $hypothesys->id }}">
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Gejala</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($hypothesys->role as $item)
                                                <tr>
                                                    <td>{{ $item->evidence->code }}</td>
                                                    <td>{{ $item->evidence->name }}</td>
                                                    <td class="align-middle" style="width: 30%">
                                                        @if ($setting_type_input->input_type == 'range')
                                                            <input class="w-100" type="range"
                                                                id="rng-{{ $item->id }}" min="0"
                                                                max="{{ $values->count() - 1 }}"
                                                                value="{{ $item->value * ($values->count() - 1) }}">
                                                            <input type="hidden" id="id_role-{{ $item->id }}"
                                                                name="id_role[]" value="{{ $item->id }}">
                                                            <input type="hidden" id="in_val_evidence-{{ $item->id }}"
                                                                name="evidance_value[]" value="{{ $item->value }}">
                                                            <div class="d-flex justify-content-between">
                                                                <span>{{ $min->name }}</span>
                                                                <span
                                                                    id="rngOutput-{{ $item->id }}">{{ $item->value }}</span>
                                                                <span>{{ $max->name }}</span>
                                                            </div>
                                                        @elseif ($setting_type_input->input_type == 'select')
                                                            <input type="hidden" id="id_role-{{ $item->id }}"
                                                                name="id_role[]" value="{{ $item->id }}">
                                                            <select class="form-select" name="evidance_value[]"
                                                                id="basicSelect">
                                                                @foreach ($values as $value)
                                                                    <option value="{{ $value->value }}"
                                                                        {{ $value->value == $item->value ? 'selected' : '' }}>
                                                                        {{ $value->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <script>
                                                    var rng_{{ $item->id }} = document.getElementById("rng-{{ $item->id }}");
                                                    var ro_{{ $item->id }} = document.getElementById("rngOutput-{{ $item->id }}");
                                                    var in_val_evidence_{{ $item->id }} = document.getElementById("in_val_evidence-{{ $item->id }}");
                                                    var myRange_{{ $item->id }} = [
                                                        @foreach ($values as $value)
                                                            {{ $value->value }},
                                                        @endforeach
                                                    ];

                                                    function updateRange() {
                                                        ro_{{ $item->id }}.textContent = myRange_{{ $item->id }}[parseInt(rng_{{ $item->id }}.value, 10)]
                                                            .toFixed(2) * 100 + '%';
                                                        in_val_evidence_{{ $item->id }}.value = myRange_{{ $item->id }}[parseInt(rng_{{ $item->id }}
                                                            .value, 10)].toFixed(2);
                                                    };
                                                    window.addEventListener("DOMContentLoaded", updateRange);
                                                    rng_{{ $item->id }}.addEventListener("input", updateRange);
                                                </script>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </ul>
                        <div class="col-12 d-flex justify-content-end mb-0 mt-3">
                            <button type="submit" class="btn btn-primary me-1 mb-1 ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-save" viewBox="0 0 16 16">
                                    <path
                                        d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                                </svg> Simpan</button>
                        </div>
                </form>
            </div>
    </div>
    </section>
    </div>
@endsection
