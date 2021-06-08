<?php

    $month = \Carbon\Carbon::now()->month;
    $year = \Carbon\Carbon::now()->year;
    
    $totalUser = \App\InfoUser::whereNotNull('nim')->count();
    $totalCompany = \App\InfoCompany::whereNotNull('npwp')->count();
    $totalLoker = \App\Job::whereYear('created_at', $year)->whereMonth('created_at', $month)->count();
?>

<footer>
    <!-- Footer Start-->
    <div class="footer-area footer-bg ">
        <div class="container">
            
            <!--  -->
            <div class="row footer-wejed justify-content-between">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-logo mb-20">
                        <a href="{{ url('/') }}"><img src="{{ asset('assets/img/logo/logo2-footer.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                <div class="footer-tittle-bottom">
                    <span>{{ $totalUser }}</span>
                    <p>User</p>
                </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                    <div class="footer-tittle-bottom">
                        <span>{{ $totalCompany }}</span>
                        <p>Perusahaan</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                    <!-- Footer Bottom Tittle -->
                    <div class="footer-tittle-bottom">
                        <span>{{ $totalLoker }}</span>
                        <p>Lowongan Bulan Ini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer-bottom area -->
    <div class="footer-bottom-area footer-bg">
        <div class="container">
            <div class="footer-border">
                    <div class="row d-flex justify-content-center align-items-center">
                        <!-- <div class="col-xl-10 col-lg-10 "> -->
                            <div class="footer-copy-right">
                                <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Job Placement Center</p>
                            </div>
                        <!-- </div> -->
                    </div>
            </div>
        </div>
    </div>
    <!-- Footer End-->
</footer>