<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon ">
            {{-- <i class="fa-brands fa-stack-overflow"></i> --}}
            <img src="{{ asset('img/favicon.png') }}" class="img-fluid" style="height:30px;">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'SIPETA') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider ">
    <div class="sidebar-heading">
        {{ env('APP_NAME') }}
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
    {{-- @if (Auth::user()->role == 'admin') --}}
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
    {{-- @endif --}}

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
