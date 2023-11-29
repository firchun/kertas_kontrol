<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon ">
            {{-- <i class="fa-brands fa-stack-overflow"></i> --}}
            <img src="{{ asset('img/favicon.png') }}" class="img-fluid" style="width:30px;">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Kartu Kontrol') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider ">
    <div class="sidebar-heading">
        {{ env('APP_NAME', 'Kartu Kontrol') }}
    </div>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Dashboard') }}</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    {{-- akun admin --}}
    @if (Auth::user()->role == 'admin')
        <div class="sidebar-heading">
            {{ __('Master Data') }}
        </div>
        <!-- Nav Item - layanan -->
        <li class="nav-item {{ Nav::isRoute('layanan') }}">
            <a class="nav-link" href="{{ route('layanan') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Layanan') }}</span>
            </a>
        </li>
        <!-- Nav Item - jenis_hambatan -->
        <li class="nav-item {{ Nav::isRoute('jenis_hambatan') }}">
            <a class="nav-link" href="{{ route('jenis_hambatan') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Jenis Hambatan') }}</span>
            </a>
        </li>
        <!-- Nav Item - semester -->
        <li class="nav-item {{ Nav::isRoute('semester') }}">
            <a class="nav-link" href="{{ route('semester') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Semester') }}</span>
            </a>
        </li>
        <!-- Nav Item - penasehat_akademik -->
        <li
            class="nav-item {{ Nav::isRoute('penasehat_akademik') }} {{ Nav::isRoute('penasehat_akademik.mahasiswa') }}">
            <a class="nav-link" href="{{ route('penasehat_akademik') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Penasehat Akademik') }}</span>
            </a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            {{ __('Akun') }}
        </div>
        <!-- Nav Item - admin -->
        <li class="nav-item {{ Nav::isRoute('users.admin') }}">
            <a class="nav-link" href="{{ route('users.admin') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>{{ __('Akun Admin') }}</span>
            </a>
        </li>
        <!-- Nav Item - dosen -->
        <li class="nav-item {{ Nav::isRoute('users.dosen') }}">
            <a class="nav-link" href="{{ route('users.dosen') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>{{ __('Akun Dosen') }}</span>
            </a>
        </li>
        <!-- Nav Item - mahasiswa -->
        <li class="nav-item {{ Nav::isRoute('users.mahasiswa') }}">
            <a class="nav-link" href="{{ route('users.mahasiswa') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>{{ __('Akun Mahasiswa') }}</span>
            </a>
        </li>
        <hr class="sidebar-divider">
    @endif
    @if (Auth::user()->role == 'mahasiswa' || Auth::user()->role == 'dosen')
        <div class="sidebar-heading">
            {{ __('Bimbingan') }}
        </div>
        <!-- Nav Item - bimbingan -->
        <li class="nav-item {{ Nav::isRoute('bimbingan') }}">
            <a class="nav-link" href="{{ route('bimbingan') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Bimbingan') }}</span>
            </a>
        </li>
        <!-- Nav Item - bimbingan -->
        <li class="nav-item {{ Nav::isRoute('bimbingan.riwayat') }}">
            <a class="nav-link" href="{{ route('bimbingan.riwayat') }}">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Riwayat Bimbingan') }}</span>
            </a>
        </li>
        <hr class="sidebar-divider">
    @endif
    {{-- end admin --}}
    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('Settings') }}
    </div>

    <!-- Nav Item - Profile -->
    <li class="nav-item {{ Nav::isRoute('profile') }}">
        <a class="nav-link" href="{{ route('profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('Profile') }}</span>
        </a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
