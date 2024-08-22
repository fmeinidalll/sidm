@extends('layout.main')

@section('container')
    @php
        $required = '<span class="text-danger">*</span> ';
    @endphp
    <div class="page-content">
        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('biodata.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama {!! $required !!}</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Nama"
                                        value="{{ old('name', $data['name'] ?? '') }}" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="dob" class="form-label">Tanggal Lahir {!! $required !!}</label>
                                    <input type="date" name="dob" id="dob"
                                        class="form-control @error('dob') is-invalid @enderror"
                                        value="{{ old('dob', $data['dob'] ?? '') }}" />
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="gender" class="form-label">Jenis Kelamin {!! $required !!}</label>
                                    <select name="gender" id="gender"
                                        class="form-select @error('gender') is-invalid @enderror">
                                        <option value="Male"
                                            {{ old('gender', $data['gender'] ?? '') == 'Male' ? 'selected' : '' }}>Laki Laki
                                        </option>
                                        <option value="Female"
                                            {{ old('gender', $data['gender'] ?? '') == 'Female' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="age" class="form-label">Umur</label>
                                    <input type="number" name="age" id="age"
                                        class="form-control @error('age') is-invalid @enderror" placeholder="Umur"
                                        value="{{ old('age', $data['age'] ?? '') }}" />
                                    @error('age')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="weight" class="form-label">Berat Badan</label>
                                    <input type="number" name="weight" id="weight"
                                        class="form-control @error('weight') is-invalid @enderror" placeholder="Berat Badan"
                                        value="{{ old('weight', $data['weight'] ?? '') }}" />
                                    @error('weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <input type="text" name="address" id="address"
                                        class="form-control @error('address') is-invalid @enderror" placeholder="Alamat"
                                        value="{{ old('address', $data['address'] ?? '') }}" />
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Nomer HP</label>
                                    <input type="text" name="phone_number" id="phone_number"
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        placeholder="Nomer HP"
                                        value="{{ old('phone_number', $data['phone_number'] ?? '') }}" />
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="occupation" class="form-label">Pekerjaan</label>
                                    <input type="text" name="occupation" id="occupation"
                                        class="form-control @error('occupation') is-invalid @enderror"
                                        placeholder="Pekerjaan"
                                        value="{{ old('occupation', $data['occupation'] ?? '') }}" />
                                    @error('occupation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
