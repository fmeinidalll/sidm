@extends('layout.auth')

@section('container')
    <div class="page-content ">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row justify-content-center align-items-center " style="width: 100vw;height: 100vh;">
                    <div class="col-12 col-md-6 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="card-title text-center">Register</h1>
                            </div>
                            <div class="card-body px-3 py-0-5">
                                <div class="row">
                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-danger alert-dismissible show fade">
                                                {{ session('status') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <form action="{{ route('register_process') }}" method="post">
                                            @csrf
                                            <div class="form-group position-relative has-icon-left mb-4">
                                                <input type="text" name="name"
                                                    class="form-control form-control-xl
                                                    @error('name') is-invalid @enderror"
                                                    placeholder="Nama Lengkap" value="{{ old('name') }}">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
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
                                            <div class="form-group position-relative has-icon-left mb-4">
                                                <input type="password" name="re-password"
                                                    class="form-control form-control-xl
                                                    @error('re-password') is-invalid @enderror
                                                    "
                                                    placeholder="Konfirmasi Password">
                                                <div class="form-control-icon">
                                                    <i class="bi bi-shield-lock"></i>
                                                </div>
                                                @error('re-password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                                                Register
                                            </button>
                                            <div class=" text-center mt-4">
                                                <p>Sudah punya akun? <a href="{{ route('login') }}"
                                                        class="text-primary">Login</a></p>
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
    </div>
@endsection
