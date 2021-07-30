@extends('layout.app')

@section('css')
<link href="{{ asset('assets/DataTables/datatables.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>

<style>
    .input-form {
        width: 78% !important;
    }

</style>
@endsection
@section('content')
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ asset('assets/img/hero/about.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>{{ $job->posisi }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- job post company Start -->
        <div class="job-post-company pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-between">
                    <!-- Left Content -->
                    <div class="col-xl-7 col-lg-8">
                        <!-- job single -->
                        @include('tanggal_indo')
                        <?php
                            $p = \App\InfoCompany::firstWhere('id_user', $job->id_user);
                            $u = \App\User::find($job->id_user);
                        ?>
                        <div class="single-job-items mb-50">
                            <div class="job-items">
                                <div class="company-img company-img-details">
                                    <a disabled>
                                        <img src="{{ asset('img/profile/'.$p->profile) }}" class="" alt="Logo Perusahaan"
                                            style="
                                                max-width: 100px;
                                                max-height: auto;
                                            "
                                        >
                                    </a>
                                </div>
                                <div class="job-tittle">
                                    <a href="#">
                                        <h4>{{ $job->posisi }}</h4>
                                    </a>
                                    
                                    <ul>
                                        <li>{{ $p->nama }}</li>
                                        <li><i class="fas fa-calendar"></i>Deadline: {{ tanggal_indonesia($job->deadline) }}</li>
                                        <li class="text-capitalize">{{ $job->jenis }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                          <!-- job single End -->
                       
                        <div class="job-post-details">
                            <div class="post-details1 mb-50">
                                <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4>Tentang Perusahaan</h4>
                                </div>
                                <p>{{ $p->desc }}</p>
                            </div>
                            
                            <div class="post-details2  mb-50">
                                 <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4>Deskripsi Pekerjaan</h4>
                                </div>
                                <div>{!! $job->desc !!}</div>
                            </div>
                           
                        </div>

                    </div>
                    <!-- Right Content -->
                    <div class="col-xl-4 col-lg-4">
                        <div class="post-details3  mb-50">
                            <!-- Small Section Tittle -->
                           <div class="small-section-tittle">
                               <h4>Job Overview</h4>
                           </div>
                          <ul>
                              <?php 
                                $posting = date_format($job->created_at, "Y-m-d");
                            ?>
                              <li>Diposting : <span>{{ tanggal_indonesia($posting) }}</span></li>
                              <li>Kategori : <span>Full time</span></li>
                              <li>Deadline : <span>{{ tanggal_indonesia($job->deadline) }}</span></li>
                          </ul>
                         <div class="apply-btn2">
                            <!-- <a href="#" class="btn">Apply Now</a> -->
                            <?php
                                $today = strtotime(date("Y-m-d"));
                                $deadline = strtotime($job->deadline);
                            ?>

                            @if($today > $deadline)
                                <button type="button" class="btn btn-danger" disabled>Ditutup</a>
                            @else
                                @auth
                                    <form action="{{ route('ApplyStore') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_pelamar" value="{{ Auth()->user()->id }}">
                                        <input type="hidden" name="id_company" value="{{ $p->id_user }}">
                                        <input type="hidden" name="id_job" value="{{ $job->id }}">
                                        <button type="submit" class="btn btn-primary">Apply Now</a>
                                    </form>
                                @endauth

                                @guest
                                    <a class="btn btn-secondary bg-light" disabled>Apply</a>
                                    <span class="ml-3 text-secondary">Silahkan login.</span>
                                @endguest
                            @endif
                         </div>
                       </div>
                       
                        <div class="post-details4  mb-50">
                            <!-- Small Section Tittle -->
                           <div class="small-section-tittle">
                               <h4>Informasi Perusahaan</h4>
                           </div>
                            <ul>
                                <div class="row">
                                    <div class="col-3">

                                        <span>Nama</span>
                                        <span>Email</span>
                                        @if($p->fax != null)
                                            <span>Fax</span>
                                        @endif
                                        @if($p->web != null)
                                            <span>Web</span>
                                        @endif
                                        <span>Telp</span>
                                        <span>Alamat</span>
                                    </div>
                                    <div class="col">
                                        <span>:  {{ $p->nama }} </span>
                                        <span>:  {{ $u->email }}</span>
                                        @if($p->fax != null)
                                            <span>:  {{ $p->fax }}</span>
                                        @endif
                                        @if($p->web != null)
                                            <span>:  {{ $p->web }}</span>
                                        @endif
                                        <span>:  {{ $p->no_telp }}</span>
                                        <span>:  {{ $p->alamat }}</span>
                                    </div>
                                </div>
                            </ul>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- job post company End -->
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