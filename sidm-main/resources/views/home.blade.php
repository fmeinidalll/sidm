@extends('layout.main')

@section('container')
    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6">
                            <div class="row g-3">
                                <div class="col-20 text-end">
                                    <img class="img-fluid rounded w-75 wow zoomIn" style="width: 40vw;height:25vw;" src="mazer/images/about-1.png">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h5 class="section-title ff-secondary text-start text-primary fw-normal">Tentang Sistem</h5>
                            <h3 class="mb-4">Selamat Datang di </i>{{ $setting->title }}</h3>
                            <div class="card-body" style="text-align: justify;">
                                 <?php echo $setting->description; ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </section>
    </div>
@endsection
