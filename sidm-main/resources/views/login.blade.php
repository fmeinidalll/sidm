@extends('layout.auth')

@section('container')
    <section class="row w-100">
        <div class="col-12 col-lg-12 w-100">
            <div class="row justify-content-center align-items-center w-100 ">
                <div class="col-12 col-md-6 mx-auto w-100">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title text-center "><b>HALAMAN LOGIN SIDM</b></h1>
                            <hr style="border-color: blue;">
                            <p class="text-center mb-0">Selamat Datang di Sistem Deteksi Dini Diabetes Melitus Puskesmas Sumbersari</p>
                        </div>
                        <div class="card-body px-1 py-0-5">
                            <div class="row">
                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-danger alert-dismissible show fade">
                                            {{ session('status') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible show fade">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <form action="{{ route('login_process') }}" method="post">
                                        @csrf
                                        <div class="form-group position-relative has-icon-left mb-4">
                                            <input type="email" name="email"
                                                class="form-control form-control-xl
                                                    @error('email') is-invalid @enderror"
                                                placeholder="Email" value="{{ old('email') }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group position-relative has-icon-left mb-4">
                                            <input type="password" name="password"
                                                class="form-control form-control-xl
                                                @error('password') is-invalid @enderror"
                                                placeholder="Password">
                                            <div class="form-control-icon">
                                                <i class="bi bi-shield-lock"></i>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                                            Masuk
                                        </button>
                                        <div class=" text-center mt-4">
                                            <p>Sudah punya akun? <a href="{{ route('register') }}"
                                                    class="text-primary">Daftar</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
