 <!-- Topbar -->
 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

     <!-- Sidebar Toggle (Topbar) -->
     <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
         <i class="fa fa-bars"></i>
     </button>

     <!-- Topbar Search -->
     {{-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
         <div class="input-group">
             <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                 aria-label="Search" aria-describedby="basic-addon2">
             <div class="input-group-append">
                 <button class="btn btn-primary" type="button">
                     <i class="fas fa-search fa-sm"></i>
                 </button>
             </div>
         </div>
     </form> --}}
     <div class="navbar-search d-lg-none">
         <h3>{{ env('APP_NAME') }}</h3>
     </div>

     <!-- Topbar Navbar -->
     <ul class="navbar-nav ml-auto">

         <!-- Nav Item - Search Dropdown (Visible Only XS) -->
         <li class="nav-item dropdown no-arrow d-sm-none">
             {{-- <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false">
                 <i class="fas fa-search fa-fw"></i>
             </a> --}}
             <!-- Dropdown - Messages -->
             <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                 {{-- <form class="form-inline mr-auto w-100 navbar-search">
                     <div class="input-group">
                          <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                             aria-label="Search" aria-describedby="basic-addon2">
                         <div class="input-group-append">
                             <button class="btn btn-primary" type="button">
                                 <i class="fas fa-search fa-sm"></i>
                             </button>
                         </div>
                     </div>
                 </form>  --}}
             </div>
         </li>
         {{-- {{dd(count(auth()->guard('pegawai')->user()->unreadNotifications))}} --}}
         {{-- @if (Auth::guard('pegawai')->user())
             <li class="nav-item dropdown no-arrow mx-1">
                 <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                     data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="fa fa-bell fa-fw text-primary"></i>
                     <!-- Counter - Alerts -->

                     @if (auth()->user()->unreadNotifications->count() > 0)
                         <span
                             class="badge badge-danger badge-counter">{{ auth()->user()->unreadNotifications->count() }}</span>
                     @endif
                 </a>
                 <!-- Dropdown - Alerts -->
                 <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                     aria-labelledby="alertsDropdown">
                     <h6 class="dropdown-header">
                         Notifikasi File Baru
                     </h6>
                     @foreach (auth()->user()->unreadNotifications as $notification)
                         <a class="dropdown-item d-flex align-items-center"
                             href="{{ url($notification->data['url'] . '?id=' . $notification->id) }}" target="_blank">
                             <div class="mr-3">
                                 <div class="icon-circle bg-success">
                                     <i class="fas fa-file-alt text-white"></i>
                                 </div>
                             </div>
                             <div>
                                 <div class="small text-gray-500">{{ $notification->created_at->isoFormat('D MMMM Y') }}
                                 </div>
                                 <span class="font-weight-normal">{{ $notification->data['messages'] }}</span>
                             </div>
                         </a>
                     @endforeach
                     <a class="dropdown-item text-center small text-gray-500" href="#">Tampilkan semua
                         notifikasi</a>
                 </div>
             </li>
         @endif --}}


         <div class="topbar-divider d-none d-sm-block"></div>

         <!-- Nav Item - User Information -->
         <li class="nav-item dropdown no-arrow">
             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false">
                 <span
                     class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name . ' ' . Auth::user()->last_name }}</span>

                 <figure class="img-profile rounded-circle avatar avatar font-weight-bold" {{-- data-initial="{{ isset(Auth::user()->name[0]) ? Auth::user()->name[0] : Auth::guard('pegawai')->user()->nama[0] }}"> --}}
                     data-initial="{{ Auth::user()->name[0] }}">
                 </figure>

             </a>
             <!-- Dropdown - User Information -->
             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                 <a class="dropdown-item" href="{{ route('profile') }}">
                     <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                     {{ __('Profile') }}
                 </a>
                 {{-- <a class="dropdown-item" href="javascript:void(0)">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Settings') }}
                </a>
                <a class="dropdown-item" href="javascript:void(0)">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Activity Log') }}
                </a> --}}
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                     <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                     {{ __('Logout') }}
                 </a>
             </div>
         </li>

     </ul>

 </nav>
 <!-- End of Topbar -->
