<div class="az-header">
    <div class="container">
    <div class="az-header-left">
        <a href="{{ url('/') }}" class="az-logo"><span></span> jpc</a>
        <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
    </div><!-- az-header-left -->
    <div class="az-header-menu">
        <div class="az-header-menu-header">
            <a href="{{ url('/') }}" class="az-logo"><span></span> jpc</a>
            <a href="" class="close">&times;</a>
        </div><!-- az-header-menu-header -->
        <ul class="nav">
        @switch(Auth()->user()->role)
            @case(1)
                <li class="nav-item active show">
                    <a href="{{ route('admin') }}" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link with-sub"><i class="typcn typcn-document"></i> Pages</a>
                    <nav class="az-menu-sub">
                        <a href="" class="nav-link">Sign In</a>
                        <a href="" class="nav-link">Sign Up</a>
                    </nav>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i> Lowongan</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link"><i class="typcn typcn-user-outline"></i> User</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link"><i class="typcn typcn-th-large-outline"></i> Perusahaan</a>
                </li>
                @break
            @case(2)
                <li class="nav-item active">
                    <a href="{{ route('user') }}" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Riwayat Apply</a>
                </li>
                @break
            @case(3)
                <li class="nav-item active">
                    <a href="{{ route('company') }}" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('C-jobs') }}" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i> Post Jobs</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('C-pelamar') }}" class="nav-link"><i class="typcn typcn-user-outline"></i> Pelamar</a>
                </li>
                @break
            @default
        @endswitch
        </ul>
    </div><!-- az-header-menu -->
    <div class="az-header-right">
        <div class="dropdown az-header-notification">
            <a href="" class="new"><i class="typcn typcn-bell"></i></a>
        <div class="dropdown-menu">
            <div class="az-dropdown-header mg-b-20 d-sm-none">
            <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
            </div>
            <h6 class="az-notification-title">Notifications</h6>
            <p class="az-notification-text">You have 2 unread notification</p>
            <div class="az-notification-list">
            <div class="media new">
                <div class="az-img-user"><img src="../img/faces/face2.jpg" alt=""></div>
                <div class="media-body">
                <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                <span>Mar 15 12:32pm</span>
                </div><!-- media-body -->
            </div><!-- media -->
            <div class="media new">
                <div class="az-img-user online"><img src="../img/faces/face3.jpg" alt=""></div>
                <div class="media-body">
                <p><strong>Joyce Chua</strong> just created a new blog post</p>
                <span>Mar 13 04:16am</span>
                </div><!-- media-body -->
            </div><!-- media -->
            <div class="media">
                <div class="az-img-user"><img src="../img/faces/face4.jpg" alt=""></div> 
                <div class="media-body">
                <p><strong>Althea Cabardo</strong> just created a new blog post</p>
                <span>Mar 13 02:56am</span>
                </div><!-- media-body -->
            </div><!-- media -->
            <div class="media">
                <div class="az-img-user"><img src="../img/faces/face5.jpg" alt=""></div>
                <div class="media-body">
                <p><strong>Adrian Monino</strong> added new comment on your photo</p>
                <span>Mar 12 10:40pm</span>
                </div><!-- media-body -->
            </div><!-- media -->
            </div><!-- az-notification-list -->
            <div class="dropdown-footer"><a href="">View All Notifications</a></div>
        </div><!-- dropdown-menu -->
        </div><!-- az-header-notification -->
        <div class="dropdown az-profile-menu">
            <?php
            if(Auth()->user()->role == 2) {
                $info = \App\InfoUser::firstWhere('id_user', Auth()->user()->id);
            }else {
                $info = \App\InfoCompany::firstWhere('id_user', Auth()->user()->id);
            }
            ?>

            <a href="" class="az-img-user"><img src="{{ asset('img/profile/'.$info->profile) }}" alt=""></a>
            <div class="dropdown-menu">
                <div class="az-dropdown-header d-sm-none">
                    <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <div class="az-header-profile">
                    <div class="az-img-user">
                        <img src="{{ asset('img/profile/'.$info->profile) }}" alt="">
                    </div><!-- az-img-user -->
                    <h6>{{Auth()->user()->name}}</h6>
                    <span>
                        @switch(Auth()->user()->role)
                            @case(1)
                                Admin
                                @break
                            @case(2)
                                User (Alumni)
                                @break
                            @default
                                Perusahaan
                        @endswitch
                    </span>
                </div><!-- az-header-profile -->

                <a href="" class="dropdown-item"><i class="typcn typcn-key"></i> Change Password</a>
                @switch(Auth()->user()->role)
                    @case(1)
                        @break
                    @case(2)
                        <a href="{{ route('U-profile') }}" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
                        @break
                    @default
                        <a href="{{ route('C-profile') }}" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
                @endswitch
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div><!-- dropdown-menu -->
        </div>
    </div><!-- az-header-right -->
    </div><!-- container -->
</div><!-- az-header -->