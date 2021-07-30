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
                            <h2>Dapatkan pekerjaan Anda</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->
    <!-- Job List Area Start -->
    <div class="job-listing-area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <!-- Left content -->
                <div class="col-xl-3 col-lg-3 col-md-4">
                    <div class="row">
                        <div class="col-12">
                                <div class="small-section-tittle2 mb-45">
                                <div class="ion"> <svg 
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="20px" height="12px">
                                <path fill-rule="evenodd"  fill="rgb(27, 207, 107)"
                                    d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z"/>
                                </svg>
                                </div>
                                <h4>Filter Jobs</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Job Category Listing start -->
                    <div class="job-category-listing mb-50">
                        <!-- single one -->
                        <div class="single-listing">
                            <!-- <div class="small-section-tittle2">
                                    <h4>Sort By</h4>
                            </div>
                            <div class="select-job-items2">
                                <select name="select">
                                    <option value="">None</option>
                                    <option value="">Sort 1</option>
                                    <option value="">Sort 2</option>
                                    <option value="">Sort 3</option>
                                    <option value="">Sort 4</option>
                                </select>
                            </div> -->
                            <!-- select-Categories start -->
                            <div class="select-Categories  pb-50">
                                <div class="small-section-tittle2">
                                    <h4>Job Type</h4>
                                </div>
                                <form action="{{ route('filter') }}" method="GET">
                                    @csrf
                                    <!-- <label class="container">Any
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label> -->
                                    @if(isset($jeniss))
                                            <label class="container">Full Time
                                                <input type="checkbox" name="jenis[0]" value="full time" {{ (isset($jeniss[0])) ? "checked" : '' }}>
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="container">Part Time
                                                <input type="checkbox" name="jenis[1]" value="part time" {{ (isset($jeniss[1])) ? "checked" : '' }}>
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="container">Magang
                                                <input type="checkbox" name="jenis[2]" value="magang" {{ (isset($jeniss[2])) ? "checked" : '' }}> 
                                                <span class="checkmark"></span>
                                            </label>
                                    @else
                                        <label class="container">Full Time
                                            <input type="checkbox" name="jenis[0]" value="full time">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container">Part Time
                                            <input type="checkbox" name="jenis[1]" value="part time">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container">Magang
                                            <input type="checkbox" name="jenis[2]" value="magang">
                                            <span class="checkmark"></span>
                                        </label>
                                    @endif

                                    <button type="submit" class="mt-5 btn btn-outline-primary">Filter</button>
                                </form>
                            </div>
                            <!-- select-Categories End -->
                        </div>
                        <!-- single two -->
                        <div class="single-listing">
                            <!-- <div class="small-section-tittle2">
                                    <h4>Job Location</h4>
                            </div> -->
                            <!-- Select job items start -->
                            <!-- <div class="select-job-items2">
                                <select name="select">
                                    <option value="">Anywhere</option>
                                    <option value="">Category 1</option>
                                    <option value="">Category 2</option>
                                    <option value="">Category 3</option>
                                    <option value="">Category 4</option>
                                </select>
                            </div> -->
                            <!--  Select job items End-->
                            <!-- select-Categories start -->
                            <!-- <div class="select-Categories pt-80 pb-50">
                                <div class="small-section-tittle2">
                                    <h4>Experience</h4>
                                </div>
                                <label class="container">1-2 Years
                                    <input type="checkbox" >
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">2-3 Years
                                    <input type="checkbox" checked="checked active">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">3-6 Years
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">6-more..
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div> -->
                            <!-- select-Categories End -->
                        </div>
                        <!-- single three -->
                        <!-- <div class="single-listing">
                            <div class="select-Categories pb-50">
                                <div class="small-section-tittle2">
                                    <h4>Posted Within</h4>
                                </div>
                                <label class="container">Any
                                    <input type="checkbox" >
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Today
                                    <input type="checkbox" checked="checked active">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Last 2 days
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Last 3 days
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Last 5 days
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="container">Last 10 days
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div> -->
                        <!-- <div class="single-listing">
                            <aside class="left_widgets p_filter_widgets price_rangs_aside sidebar_box_shadow">
                                <div class="small-section-tittle2">
                                    <h4>Filter Jobs</h4>
                                </div>
                                <div class="widgets_inner">
                                    <div class="range_item">
                                        <input type="text" class="js-range-slider" value="" />
                                        <div class="d-flex align-items-center">
                                            <div class="price_text">
                                                <p>Price :</p>
                                            </div>
                                            <div class="price_value d-flex justify-content-center">
                                                <input type="text" class="js-input-from" id="amount" readonly />
                                                <span>to</span>
                                                <input type="text" class="js-input-to" id="amount" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div> -->
                    </div>
                    <!-- Job Category Listing End -->
                </div>
                <!-- Right content -->
                <div class="col-xl-9 col-lg-9 col-md-8">
                    <!-- Featured_job_start -->
                    <section class="featured-job-area">
                        <div class="container">
                            <!-- Count of Job list Start -->
                            <!-- <table id="lowongan" class="w-100">
                                <thead>
                                    <th class="">Job Placement Center</th>
                                </thead>
                                <tbody> -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="count-job mb-35">
                                                <span>{{ $total }} Jobs found</span>
                                                <!-- Select job items start -->
                                                <div class="select-job-items">

                                                </div>
                                                <!--  Select job items End-->
                                            </div>
                                        </div>
                                    </div>
                                    @include('tanggal_indo')
                                    @foreach($jobs as $j)
                                    
                                    <!-- <tr>
                                        <td> -->
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
                                                            <br>
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
                                        <!-- </td>
                                    </tr> -->
                                    @endforeach
                                        
<!--                                         
                                </tbody>
                            </table> -->
                        </div>
                    </section>
                    <!-- Featured_job_end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Job List Area End -->
    <!--Pagination Start  -->
    <div class="pagination-area pb-115 text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="single-wrap d-flex justify-content-center">
                        <nav aria-label="Page navigation example">
                            {{ $jobs->links() }}
                            <!-- <ul class="pagination justify-content-start">
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link" href="#"><span class="ti-angle-right"></span></a></li>
                            </ul> -->
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