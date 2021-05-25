<header>
    <!-- Header Start -->
    <div class="header-area header-transparrent">
        <div class="headder-top header-sticky">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-2">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="{{ url('/') }}"><img src="assets/img/logo/logo2.png" alt=""></a>
                        </div>  
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="menu-wrapper">
                            <!-- Main-menu -->
                            <div class="main-menu">
                                <nav class="d-none d-lg-block">
                                    <ul id="navigation">
                                        <li><a href="{{ url('/') }}">Home</a></li>
                                        <li><a href="">Cari Lowongan</a></li>
                                        <!-- <li><a href="">About</a></li> -->
                                    </ul>
                                </nav>
                            </div>          
                            <!-- Header-btn -->
                            <div class="header-btn d-none f-right d-lg-block">
                                <!-- <a href="#" class="btn head-btn1">Register</a>
                                <a href="#" class="btn head-btn2">Login</a> -->
                                @if (Route::has('login'))
                                    @auth
                                        @if (Auth()->user()->role == 1)
                                            <a href="{{ url('/admin') }}" class="btn head-btn2">Dashboard</a>
                                        @elseif(Auth()->user()->role == 2)
                                            <a href="{{ url('/user') }}" class="btn head-btn2">Dashboard</a>
                                        @elseif(Auth()->user()->role == 3)
                                            <a href="{{ url('/company') }}" class="btn head-btn2">Dashboard</a>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn head-btn2">Login</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="btn head-btn1">Register</a>
                                        @endif
                                    @endauth
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>