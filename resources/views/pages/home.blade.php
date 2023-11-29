@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if (Auth::user()->role == 'admin')
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('Users') }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['users'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <!-- Color System -->
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-primary text-white shadow">
                            <div class="card-body">
                                Primary
                                <div class="text-white-50 small">#4e73df</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-success text-white shadow">
                            <div class="card-body">
                                Success
                                <div class="text-white-50 small">#1cc88a</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-info text-white shadow">
                            <div class="card-body">
                                Info
                                <div class="text-white-50 small">#36b9cc</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-warning text-white shadow">
                            <div class="card-body">
                                Warning
                                <div class="text-white-50 small">#f6c23e</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-danger text-white shadow">
                            <div class="card-body">
                                Danger
                                <div class="text-white-50 small">#e74a3b</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card bg-secondary text-white shadow">
                            <div class="card-body">
                                Secondary
                                <div class="text-white-50 small">#858796</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6 mb-4">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                src="{{ asset('img/svg/undraw_editable_dywm.svg') }}" alt="">
                        </div>
                        <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank"
                                rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of
                            beautiful svg images that you can use completely free and without attribution!</p>
                        <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw →</a>
                    </div>
                </div>

                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                    </div>
                    <div class="card-body">
                        <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and
                            poor page performance. Custom CSS classes are used to create custom components and custom
                            utility classes.</p>
                        <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap
                            framework, especially the utility classes.</p>
                    </div>
                </div>

            </div>
        </div>
    @elseif(Auth::user()->role == 'mahasiswa')
        <div class="row">
            <div class="col-lg-6">
                @foreach ($widget['layanan'] as $item)
                    @php
                        $semester = App\Models\Semester::latest()->first()->id;
                        $status = App\Models\LayananPeriode::where('id_layanan', $item->id)
                            ->where('id_semester', $semester)
                            ->first();

                        $bimbingan = App\Models\Bimbingan::where('id_user', Auth::user()->id)
                            ->where('id_layanan', $item->id)
                            ->first();

                        if ($status->tanggal_awal >= date('Y-m-d')) {
                            $sesi = 'pending';
                        } elseif ($status->tanggal_akhir <= date('Y-m-d')) {
                            $sesi = 'end';
                        } else {
                            $sesi = 'open';
                        }

                    @endphp
                    <div class="card border shadow shadow-sm my-3">
                        <div class="card-body">
                            <h3>{{ $item->layanan }}
                                @if ($sesi == 'pending')
                                    <span class="badge badge-warning">Sesi Belum di buka</span>
                                @elseif ($sesi == 'end')
                                    <span class="badge badge-danger">sesi berakhir</span>
                                @else
                                    <span class="badge badge-primary">sesi dibuka</span>
                                @endif
                            </h3>
                            @if ($status->tanggal_awal >= date('Y-m-d') || $status->tanggal_akhir <= date('Y-m-d'))
                                @if ($bimbingan)
                                    <span class="text-success">Telah Bimbingan</span>
                                @else
                                    <span class="text-danger">Terlambat Bimbingan</span>
                                    <br><small class="text-muted">*Silahkan segera komunikasikan pada dosen
                                        penasehat
                                        akademik</small>
                                @endif
                            @else
                                <span class="text-warning">Proses Bimbingan</span>
                            @endif
                            <br>
                            <small class="text-danger">
                                Periode : {{ \Carbon\Carbon::parse($status->tanggal_awal ?? null)->format('d F') }}
                                sampai
                                {{ \Carbon\Carbon::parse($status->tanggal_akhir ?? null)->format('d F') }}
                            </small>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Data Dosen Penasehat Akademik</h3>
                    </div>
                    <div class="card-body">
                        @php
                            $dosenPA = App\Models\PenasehatAkademik::where('id_mahasiswa', Auth::user()->id)->first();
                        @endphp
                        @if ($dosenPA)
                            <table class="table">
                                <tr>
                                    <td><strong>Nama</strong></td>
                                    <td>:</td>
                                    <td>{{ $dosenPA->dosen->name . ' ' . $dosenPA->dosen->last_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NIP/NIDN</strong></td>
                                    <td>:</td>
                                    <td>{{ $dosenPA->dosen->nip }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nomor HP</strong></td>
                                    <td>:</td>
                                    <td>{{ $dosenPA->dosen->phone }}</td>
                                </tr>
                            </table>
                        @else
                            <center>
                                <span class="text-muted">Anda Belum memiliki dosen penasehat akademik</span>
                            </center>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @elseif(Auth::user()->role == 'dosen')
        <div class="row">
            <div class="col-lg-6">
                @foreach ($widget['layanan'] as $item)
                    @php
                        $semester = App\Models\Semester::latest()->first()->id;
                        $status = App\Models\LayananPeriode::where('id_layanan', $item->id)
                            ->where('id_semester', $semester)
                            ->first();

                        if ($status->tanggal_awal >= date('Y-m-d')) {
                            $sesi = 'pending';
                        } elseif ($status->tanggal_akhir <= date('Y-m-d')) {
                            $sesi = 'end';
                        } else {
                            $sesi = 'open';
                        }

                    @endphp
                    <div class="card border shadow shadow-sm my-3">
                        <div class="card-body">
                            <h3>{{ $item->layanan }}
                                @if ($sesi == 'pending')
                                    <span class="badge badge-warning">Sesi Belum di buka</span>
                                @elseif ($sesi == 'end')
                                    <span class="badge badge-danger">sesi berakhir</span>
                                @else
                                    <span class="badge badge-primary">sesi dibuka</span>
                                @endif
                            </h3>
                            <small class="text-danger">
                                Periode : {{ \Carbon\Carbon::parse($status->tanggal_awal ?? null)->format('d F') }}
                                sampai
                                {{ \Carbon\Carbon::parse($status->tanggal_akhir ?? null)->format('d F') }}
                            </small>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Data Mahasiswa</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\PenasehatAkademik::where('id_dosen', Auth::user()->id)->get() as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $item->mahasiswa->name }}</strong><br>{{ $item->mahasiswa->npm }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
