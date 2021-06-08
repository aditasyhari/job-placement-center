@extends('layout.app')

@section('css')

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
                            <h2>Perusahaan Terdaftar</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="our-services pt-5">
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
                            <h5><a>{{ $c->nama }}</a></h5>
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
                        <!-- <a href="" class="border-btn2">Browse All</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Pagination Start  -->
    <div class="pagination-area pb-115 text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            {{ $companies->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Pagination End  -->

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