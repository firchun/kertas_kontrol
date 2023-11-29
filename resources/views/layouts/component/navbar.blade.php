 @php
     $semester = App\Models\Semester::latest()->first()->code ?? '-';
 @endphp
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
     <div class=" d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
         <h3>Tahun Ajaran : <strong class="text-primary">{{ $semester }}</strong></h3>
     </div>
     <div class="navbar-search d-lg-none d-flex">
         <h3>{{ env('APP_NAME') }} <br> Ta : <strong>{{ $semester }}</strong></h3>
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
             <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                 aria-labelledby="searchDropdown">
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
                 </form> --}}
             </div>
         </li>
         @php
             $notifikasi = App\Models\Notifikasi::where('id_user', Auth::user()->id)
                 ->where('is_read', null)
                 ->latest();
             $total_notif = $notifikasi->count() >= 6 ? '5+' : $notifikasi->count();
         @endphp
         <li class="nav-item dropdown no-arrow mx-1">
             <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <i class="fas fa-bell fa-fw"></i>
                 <!-- Counter - Alerts -->
                 <span class="badge badge-danger badge-counter">{{ $total_notif }}</span>
             </a>
             <!-- Dropdown - Alerts -->
             <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="alertsDropdown">
                 <h6 class="dropdown-header">
                     Notifikasi
                 </h6>
                 @foreach ($notifikasi->take(5)->get() as $item)
                     <form action="{{ route('read_notif', $item->id) }}" method="POST">
                         @csrf
                         @method('PUT')
                         <button type="submit" class="dropdown-item d-flex align-items-center" href="#">
                             <div class="mr-3">
                                 @if ($item->type == 'primary')
                                     <div class="icon-circle bg-primary">
                                         <i class="fas fa-thumbs-up text-white"></i>
                                     </div>
                                 @elseif($item->type == 'success')
                                     <div class="icon-circle bg-success">
                                         <i class="fas fa-thumbs-up text-white"></i>
                                     </div>
                                 @elseif($item->type == 'danger')
                                     <div class="icon-circle bg-danger">
                                         <i class="fas fa-exclamation text-white"></i>
                                     </div>
                                 @endif
                             </div>
                             <div>
                                 <div class="small text-gray-500">{{ $item->created_at->format('d F Y,H:i:s') }}</div>
                                 <span
                                     class="font-weight-bold text-{{ $item->type }}">{{ Str::limit($item->message, 50) }}</span>
                             </div>
                         </button>
                     </form>
                 @endforeach

                 <a class="dropdown-item text-center small text-gray-500" href="{{ route('notifikasi') }}">Lihat semua
                     notifikasi</a>
             </div>
         </li>


         <div class="topbar-divider d-none d-sm-block"></div>

         <!-- Nav Item - User Information -->
         <li class="nav-item dropdown no-arrow">
             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false">
                 <span
                     class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name . ' ' . Auth::user()->last_name }}<br>
                     <samll style="font-size: 10px;">
                         {{ Auth::user()->role == 'mahasiswa' ? Auth::user()->npm : Auth::user()->nip }}</samll>
                 </span>

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
