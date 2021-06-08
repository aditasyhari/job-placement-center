@extends('layout.app')

@section('css')

<style>
    .input-form {
        width: 78% !important;
    }

    .search-form button {
        width: 100%;
        height: 70px;
    }
</style>
@endsection
@section('content')

    <!-- Hero Area End -->
    <!-- Job List Area Start -->
    <div class="job-listing-area pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Right content -->
                <div class="col-xl-10 col-lg-10 col-md-8">
                    <!-- Featured_job_start -->
                    <section class="featured-job-area">
                        <div class="container">
                            <!-- <div class="row">
                                <div class="col-lg-12">
                                    <div class="section-tittle text-center">
                                        <span>Hasil</span>
                                        <h2>Pencarian</h2>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="count-job mb-35">
                                        <form id="search" action="{{ route('search') }}" class="search-box w-100" method="GET">
                                            @csrf
                                            <div class="input-form">
                                                <input type="text" name="search" placeholder="Masukkan keyword lowongan" value="{{ $keyword }}" required>
                                            </div>
                                            <div class="search-form">
                                                <button type="submit" class="btn btn-primary">Cari</button>
                                            </div>	
                                        </form>	
                                        <span class="mt-3 ml-2">{{ $total }} Jobs found</span>
                                        <!-- Select job items start -->
                                        <div class="select-job-items">

                                        </div>
                                        <!--  Select job items End-->
                                    </div>
                                </div>
                            </div>
                            @include('tanggal_indo')
                            @foreach($jobs as $j)
  
                                <?php
                                    $p = \App\InfoCompany::firstWhere('id_user', $j->id_user);
                                ?>
                                <div class="single-job-items mb-30">
                                    <div class="job-items">
                                        <div class="company-img">
                                            <a disabled>
                                                <img src="{{ asset('img/profile/'.$p->profile) }}" class="" alt="Logo Perusahaan"
                                                    style="
                                                        max-width: 100px;
                                                        max-height: 100px;
                                                    "
                                                >
                                            </a>
                                        </div>
                                        <div class="job-tittle">
                                            <?php
                                                $id = Illuminate\Support\Facades\Crypt::encryptString($j->id);
                                            ?>
                                            <a href="{{ route('lokerDetail', ['id' => $id]) }}" class="cursor-link"><h4>{{ $j->posisi }}</h4></a>
                                            <ul>
                                                <li>{{ $p->nama }}</li>
                                                <li><i class="fas fa-calendar"></i>Deadline: {{ tanggal_indonesia($j->deadline) }}</li>
                                                <li class="text-capitalize">{{ $j->jenis }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="items-link f-right">
                                        <?php
                                            $today = strtotime(date("Y-m-d"));
                                            $deadline = strtotime($j->deadline);
                                        ?>
                                        @if($today > $deadline)
                                            <button type="button" class="btn btn-danger" disabled>Ditutup</a>
                                        @else
                                            @auth
                                                <form action="{{ route('ApplyStore') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id_pelamar" value="{{ Auth()->user()->id }}">
                                                    <input type="hidden" name="id_company" value="{{ $p->id_user }}">
                                                    <input type="hidden" name="id_job" value="{{ $j->id }}">
                                                    <button type="submit" class="btn btn-primary">Apply</a>
                                                </form>
                                            @endauth

                                            @guest
                                                <a class="" disabled>Apply</a>
                                                <span>Silahkan login</span>
                                            @endguest
                                        @endif
                                    </div>
                                </div>
       
                            @endforeach

                        </div>
                    </section>
                    <!-- Featured_job_end -->
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
                            {{ $jobs->withQueryString()->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Pagination End  -->
@endsection
@section('js')
<script>
    function detail() {
        $('#detailForm').submit();
    }
</script>

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