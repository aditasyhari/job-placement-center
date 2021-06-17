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
                <li class="nav-item {{ request()->routeIs('admin') ? 'active' : '' }}">
                    <a href="{{ route('admin') }}" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
                </li>
                <li class="nav-item {{ request()->routeIs('jobs.index') ? 'active' : '' }}">
                    <a href="{{ route('jobs.index') }}" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i> Lowongan</a>
                </li>
                <li class="nav-item {{ request()->routeIs(['users.index', 'users.show']) ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="nav-link"><i class="typcn typcn-user-outline"></i> User</a>
                </li>
                <li class="nav-item {{ request()->routeIs(['companies.index', 'companies.show']) ? 'active' : '' }}">
                    <a href="{{ route('companies.index') }}" class="nav-link"><i class="typcn typcn-th-large-outline"></i> Perusahaan</a>
                </li>
                <li class="nav-item {{ request()->routeIs(['applications.index', 'companies.show']) ? 'active' : '' }}">
                    <a href="{{ route('applications.index') }}" class="nav-link"><i class="typcn typcn-document"></i> Apply</a>
                </li>
                <li class="nav-item {{ request()->routeIs('notifications.index') ? 'active' : '' }}">
                    <a href="{{ route('notifications.index') }}" class="nav-link"><i class="typcn typcn-bell"></i> Notifikasi</a>
                </li>
                @break
            @case(2)
                <li class="nav-item {{ request()->routeIs('user') ? 'active' : '' }}">
                    <a href="{{ route('user') }}" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
                </li>
                <li class="nav-item {{ request()->routeIs('loker') ? 'active' : '' }}">
                    <a href="{{ route('loker') }}" class="nav-link"><i class="typcn typcn-briefcase"></i> Cari Loker</a>
                </li>
                <li class="nav-item {{ request()->routeIs(['U-pending', 'U-ditolak', 'U-diterima']) ? 'active' : '' }}">
                    <a href="" class="nav-link with-sub"><i class="typcn typcn-document"></i> Riwayat Apply</a>
                    <nav class="az-menu-sub">
                        <a href="{{ route('U-pending') }}" class="nav-link">Pending</a>
                        <a href="{{ route('U-ditolak') }}" class="nav-link">Ditolak</a>
                        <a href="{{ route('U-diterima') }}" class="nav-link">Diterima</a>
                    </nav>
                </li>
                
                @break
            @case(3)
                <li class="nav-item {{ request()->routeIs('company') ? 'active' : '' }}">
                    <a href="{{ route('company') }}" class="nav-link "><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
                </li>
                <li class="nav-item {{ request()->routeIs('C-jobs') ? 'active' : '' }}">
                    <a href="{{ route('C-jobs') }}" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i> Post Jobs</a>
                </li>
                <li class="nav-item {{ request()->is('company/pelamar*') ? 'active' : '' }}">
                    <a href="{{ route('C-pelamar') }}" class="nav-link"><i class="typcn typcn-user-outline"></i> Pelamar</a>
                </li>
                
                @break
            @default
        @endswitch
        </ul>
    </div><!-- az-header-menu -->
    <div class="az-header-right">
        <div class="dropdown az-header-notification">
            @switch(Auth()->user()->role)
                @case(2)
                    <?php 
                        $notif = \App\Application::where('id_pelamar', Auth()->user()->id)
                                        ->whereIn('status', ['ditolak', 'diterima'])
                                        ->where('baca_pelamar', false)
                                        ->orderBy('id', 'desc')
                                        ->skip(0)
                                        ->take(5)
                                        ->get();

                        $jml_notif = \App\Application::where('id_pelamar', Auth()->user()->id)
                                        ->whereIn('status', ['ditolak', 'diterima'])
                                        ->where('baca_pelamar', false)
                                        ->count();
                    ?>
                    @break
                @case(3)
                    <?php 
                        $notif = \App\Application::where('id_company', Auth()->user()->id)
                                        ->where('baca_perusahaan', false)
                                        ->orderBy('id', 'desc')
                                        ->skip(0)
                                        ->take(5)
                                        ->get();
                        
                        $jml_notif = \App\Application::where('id_company', Auth()->user()->id)
                                        ->where('baca_perusahaan', false)
                                        ->count();
                    ?>
                    @break
            @endswitch
            @if(isset($jml_notif))
                @if($jml_notif != 0)
                    <a href="" class="new"><i class="typcn typcn-bell"></i></a>
                @else
                    <a href="" class=""><i class="typcn typcn-bell"></i></a>
                @endif
            @endif
            <div class="dropdown-menu">
                <div class="az-dropdown-header mg-b-20 d-sm-none">
                    <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <h6 class="az-notification-title">Notifikasi</h6>
                @if(isset($jml_notif))
                    @if($jml_notif != 0)
                        <p class="az-notification-text">Anda memiliki {{ $jml_notif }} notifikasi belum dibaca.</p>
                        <div class="az-notification-list">
                            @switch(Auth()->user()->role)
                                @case(2)
                                    @foreach($notif as $n)
                                        <?php
                                            $user = \App\InfoCompany::firstWhere('id_user', $n->id_company);
                                            $loker = \App\Job::find($n->id_job);
                                        ?>
                                        <div class="media new">
                                            <div class="az-img-user"><img src="{{ asset('img/profile/'.$user->profile) }}" alt=""></div>
                                            <div class="media-body">
                                                <?php
                                                    $id_app = Illuminate\Support\Facades\Crypt::encryptString($n->id);
                                                ?>
                                                <a href="{{ route('U-DetailLoker', ['id' => $id_app]) }}" class="text-dark">
                                                    <p>Perusahaan <strong>{{ $user->nama }}</strong> memberikan tanggapan untuk loker <strong>{{ $loker->posisi }}</strong></p>
                                                    <?php
                                                        $time = date('l, d F Y', strtotime( $n->created_at));
                                                    ?>
                                                    <span>{{ $time }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="dropdown-footer"><a href="{{ route('U-notifikasi') }}">View All Notifications</a></div>
                                    @break
                                @case(3)
                                    @foreach($notif as $n)
                                        <?php
                                            $user = \App\InfoUser::firstWhere('id_user', $n->id_pelamar);
                                            $loker = \App\Job::find($n->id_job);
                                        ?>
                                        <div class="media new">
                                            <div class="az-img-user"><img src="{{ asset('img/profile/'.$user->profile) }}" alt=""></div>
                                            <div class="media-body">
                                                <?php
                                                    $id_app = Illuminate\Support\Facades\Crypt::encryptString($n->id);
                                                ?>
                                                <a href="{{ route('C-DetailPelamar', ['id' => $id_app]) }}" class="text-dark">
                                                    <p>Pelamar baru <strong>{{ $user->nama }}</strong> untuk {{ $loker->posisi }}</p>
                                                    <?php
                                                        $time = date('l, d F Y', strtotime( $n->created_at));
                                                    ?>
                                                    <span>{{ $time }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="dropdown-footer"><a href="{{ route('C-notifikasi') }}">View All Notifications</a></div>
                                    @break
                            @endswitch
                        </div>
                    @else
                        <p class="az-notification-text">Tidak ada notifikasi.</p>
                    @endif
                @endif

            </div><!-- dropdown-menu -->
        </div><!-- az-header-notification -->
        <div class="dropdown az-profile-menu">
            <?php
                if(Auth()->user()->role == 2) {
                    $info = \App\InfoUser::firstWhere('id_user', Auth()->user()->id);
                }elseif(Auth()->user()->role == 3) {
                    $info = \App\InfoCompany::firstWhere('id_user', Auth()->user()->id);
                }else {
                    $info = 'default.jpg';
                }
            ?>

            @if(Auth()->user()->role != 1)
                <a href="" class="az-img-user"><img src="{{ asset('img/profile/'.$info->profile) }}" alt=""></a>
            @else
                <a href="" class="az-img-user"><img src="{{ asset('img/profile/'.$info) }}" alt=""></a>
            @endif

            <div class="dropdown-menu">
                <div class="az-dropdown-header d-sm-none">
                    <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <div class="az-header-profile">
                    <div class="az-img-user">
                        @if(Auth()->user()->role != 1)
                            <img src="{{ asset('img/profile/'.$info->profile) }}" alt="">
                        @else
                            <img src="{{ asset('img/profile/'.$info) }}" alt="">
                        @endif
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

                <a href="{{ route('change') }}" class="dropdown-item"><i class="typcn typcn-key"></i> Change Password</a>
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