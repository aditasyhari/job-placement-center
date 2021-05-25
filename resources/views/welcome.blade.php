@extends('layout.app')
@section('css')
<style>
    .input-form {
        width: 78% !important;
    }

    .hero__caption h1 {
        text-shadow: 0px 0px 5px rgba(255,255,255,0.5);
    }
</style>
@endsection

@section('content')
<div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="slider-active">
        <div class="single-slider slider-height d-flex align-items-center" data-background="assets/img/hero/bg-bisnis.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-9 col-md-10">
                        <div class="hero__caption">
                            <h1>Cari Lowongan Kerja Disini</h1>
                        </div>
                    </div>
                </div>
                <!-- Search Box -->
                <div class="row">
                    <div class="col-xl-8">
                        <!-- form -->
                        <form action="#" class="search-box">
                            <div class="input-form">
                                <input type="text" placeholder="Masukkan keyword lowongan">
                            </div>
                            <div class="search-form">
                                <a href="#">Cari</a>
                            </div>	
                        </form>	
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="featured-job-area feature-padding">
    <div class="container">
        <!-- Section Tittle -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Baru - Baru Ini</span>
                    <h2>Lowongan Kerja</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-10">
                @include('tanggal_indo')
                @foreach($jobs as $j)
                <!-- single-job-content -->
                <?php
                    $p = \App\InfoCompany::firstWhere('id_user', $j->id_user);
                ?>
                <div class="single-job-items mb-30">
                    <div class="job-items">
                        <div class="company-img">
                            <a href="">
                                <img src="{{ asset('img/profile/'.$p->profile) }}" class="" alt="Logo Perusahaan"
                                    style="
                                        max-width: 100px;
                                        max-height: 100px;
                                    "
                                >
                            </a>
                        </div>
                        <div class="job-tittle">
                            <a href="" class="text-capitalize"><h4>{{ $j->posisi }}</h4></a>
                            <ul>
                                <li>{{ $p->nama }}</li>
                                <li><i class="fas fa-calendar"></i>Deadline: {{ tanggal_indonesia($j->deadline) }}</li>
                                <li class="text-capitalize">{{ $j->jenis }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="items-link f-right">
                        @auth
                            <form action="{{ route('ApplyStore') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_user" value="{{ Auth()->user()->id }}">
                                <input type="hidden" name="id_job" value="{{ $j->id }}">
                                <button type="submit" class="btn btn-primary">Apply</a>
                            </form>
                        @endauth

                        @guest
                            <a class="" disabled>Apply</a>
                            <span>Silahkan login</span>
                        @endguest
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="browse-btn2 text-center mt-50">
                    <a href="" class="border-btn2">Browse All</a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="apply-process-area apply-bg pt-150 pb-150" data-background="assets/img/gallery/how-applybg.png">
    <div class="container">
        <!-- Section Tittle -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle white-text text-center">
                    <span>Apply Loker</span>
                    <h2>Alur Rekrutmen</h2>
                </div>
            </div>
        </div>
        <!-- Apply Process Caption -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-process text-center mb-30">
                    <div class="process-ion">
                        <span class="flaticon-search"></span>
                    </div>
                    <div class="process-cap">
                        <h5>1. Cari Loker</h5>
                        <p>Cari lowongan pekerjaan yang sesuai dengan anda disini</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-process text-center mb-30">
                    <div class="process-ion">
                        <span class="flaticon-curriculum-vitae"></span>
                    </div>
                    <div class="process-cap">
                        <h5>2. Melamar Pekerjaan</h5>
                        <p>Submit lamaran anda pada lowongan kerja yang anda minati.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-process text-center mb-30">
                    <div class="process-ion">
                        <span class="flaticon-tour"></span>
                    </div>
                    <div class="process-cap">
                        <h5>3. Dapatkan Pekerjaan</h5>
                        <p>Setelah perusahaan menerima lamaran anda, selamat anda mendapat pekerjaan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="our-services section-pad-t30">
    <div class="container">
        <!-- Section Tittle -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <span>Kerjasama</span>
                    <h2>Perusahaan Terdaftar</h2>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-contnet-center">
        @foreach($companies as $c)
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                <div class="single-services text-center mb-30">
                    <div class="services-ion">
                        <!-- <span class="flaticon-tour"></span> -->
                        <img src="{{ asset('img/profile/'.$c->profile) }}" class="mb-2" alt="Logo Perusahaan"
                            style="
                                
                                max-height: 50px;
                            "
                        >
                    </div>
                    <div class="services-cap">
                        <h5><a href="">{{ $c->nama }}</a></h5>
                        <!-- <span>(653)</span> -->
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        <!-- More Btn -->
        <!-- Section Button -->
        <div class="row">
            <div class="col-lg-12">
                <div class="browse-btn2 text-center mt-50">
                    <a href="" class="border-btn2">Browse All</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@if(session('status'))
    <script>
        $(function() {
            $('#staticBackdrop').modal('show');
        });
    </script>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Pemberitahuan !!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                {{ session('status') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>
@endif
@endsection