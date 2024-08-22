@extends('layout.main')

@section('container')
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Usia</th>
                                <th>Berat Badan</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>
                                <th>Pekerjaan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $patient->name }}</td>
                                    <td>{{ $patient->dob }}</td>
                                    <td>{{ $patient->gender }}</td>
                                    <td>{{ $patient->age }}</td>
                                    <td>{{ $patient->weight }}</td>
                                    <td>{{ $patient->address }}</td>
                                    <td>{{ $patient->phone_number }}</td>
                                    <td>{{ $patient->occupation }}</td>
                                    <td>
                                        <span class="badge bg-{{ $patient->user_id ? 'warning' : 'info' }}">
                                            {{ $patient->user_id ? 'Konsultasi Sendiri' : 'Dibantu Konsultasi' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
