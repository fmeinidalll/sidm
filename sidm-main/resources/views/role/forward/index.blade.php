@extends('layout.main')

@section('container')
    <div class="page-content">
        <section class="section">
            <div class="card">
                <form action="{{ route('role.forward.store') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <h4 class="card-title">{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Gejala</th>
                                        <th scope="col">Gejala</th>
                                        @foreach ($hypothesis as $value)
                                            <th scope="col">{{ $value->name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $value)
                                        <tr class="">
                                            <td scope="row">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $value->code }}
                                            </td>
                                            <td>
                                                {{ $value->name }}
                                            </td>
                                            @foreach ($value->roles as $item)
                                                <th scope="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="{{ $value->id . '|' . $item->hypothesis_id }}"
                                                            id="none|{{ $value->id . '|' . $item->hypothesis_id }}"
                                                            value=""
                                                            {{ $item->condition == null ? 'checked' : '' }} />
                                                        <label class="form-check-label"
                                                            for="and|{{ $value->id . '|' . $item->hypothesis_id }}">
                                                            NONE
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="{{ $value->id . '|' . $item->hypothesis_id }}"
                                                            id="and|{{ $value->id . '|' . $item->hypothesis_id }}"
                                                            value="and"
                                                            {{ $item->condition == 'and' ? 'checked' : '' }} />
                                                        <label class="form-check-label"
                                                            for="and|{{ $value->id . '|' . $item->hypothesis_id }}">
                                                            AND
                                                        </label>
                                                    </div>
                                                </th>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
