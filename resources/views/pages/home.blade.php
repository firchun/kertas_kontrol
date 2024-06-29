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

    <div class="my-4 text-center bg-light">
        <img src="{{ asset('img/musamus.png') }}" height="100px;" class="mb-3" alt="logo">
        <h2><b class="text-primary">Dashboard</b><br>Sistem Informasi Bimbingan Akademik<br>Jurusan Sistem Infromasi</h2>
    </div>
    <hr>
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'ketua_jurusan' || Auth::user()->role == 'dosen')
        <div class="row justify-content-center">
            <div class="col-12">
                @include('pages.components_dashboard.grafik_hambatan')
            </div>
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'ketua_jurusan')
                <div class="col-12 mt-4">
                    <h1>Analisis Singkat Hambatan Mahasiswa semester {{ App\Models\Semester::latest()->first()->code }}</h1>
                    <hr>
                </div>
                @foreach ($widget['hambatan'] as $hambatanItem)
                    @php
                        $semester_now = App\Models\Semester::latest()->first();
                        $semester_before = App\Models\Semester::latest()->skip(1)->first();

                        $bimbinganHambatan = App\Models\BimbinganHambatan::where('id_semester', $semester_now->id)
                            ->where('id_hambatan', $hambatanItem->id)
                            ->get();
                        $before = App\Models\BimbinganHambatan::where('id_semester', $semester_before->id ?? 0)
                            ->where('id_hambatan', $hambatanItem->id)
                            ->get();

                        $total_hambatan = App\Models\BimbinganHambatan::count();

                        $data_now = $bimbinganHambatan->count();
                        $data_before = $before->count();
                        $perbandingan = $data_now - $data_before;
                        // $persentase = ($perbandingan / ($data_before != 0 ? $data_before : 1)) * 100;
                        $persentase = max(
                            -100,
                            min(($perbandingan / ($data_before != 0 ? $data_before : 1)) * 100, 100),
                        );

                        $persentase = number_format($persentase, 0, '.', '');
                        $status = '';
                        if ($persentase != 0) {
                            if ($persentase > 0) {
                                $status = 'NAIK'; // Persentase di atas 0
                                $alertClass = 'alert-danger border-left-danger'; // Alert danger untuk naik
                            } else {
                                $status = 'TURUN'; // Persentase di bawah 0
                                $alertClass = 'alert-success border-left-success'; // Alert success untuk turun
                            }
                        }

                    @endphp
                    <div class="col-lg-3 p-2">
                        <div class="card {{ $perbandingan <= 0 ? 'border-success' : 'border-danger' }}">
                            <div class="card-body">
                                <b>{{ $hambatanItem->jenis_hambatan }}</b><br>
                                <h2>
                                    <span class="{{ $perbandingan <= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ abs($persentase) }} %</span>
                                    @if ($data_now > $data_before)
                                        <i class="fa fa-arrow-up text-danger"></i>
                                    @elseif($data_now < $data_before)
                                        <i class="fa fa-arrow-down text-success"></i>
                                    @endif
                                    </h1>
                                    <p>Total : <b>{{ $data_now }}</b> Mahasiswa

                                    </p>
                                    @if ($persentase != 0)
                                        <div class="alert {{ $alertClass }} show" role="alert">
                                            <small>
                                                Hambatan ini
                                                @if (!empty($status))
                                                    <strong>{{ $status }}</strong>
                                                @endif
                                                sebanyak {{ abs($perbandingan) }} Mahasiswa dari sebelumnya sebanyak
                                                {{ $data_before }} Mahasiswa
                                            </small>
                                        </div>
                                    @else
                                        <div class="alert alert-success border-left-success show" role="alert">
                                            <small>
                                                Hambatan ini
                                                <strong>STABIL</strong>
                                                dengan data saat ini sebanyak {{ $data_now }} Mahasiswa dan sebelumnya
                                                sebanyak
                                                {{ $data_before }} Mahasiswa
                                            </small>
                                        </div>
                                    @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
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
                        $sesi = '';

                        if ($status) {
                            if ($status->tanggal_awal >= date('Y-m-d')) {
                                $sesi = 'pending';
                            } elseif ($status->tanggal_akhir <= date('Y-m-d')) {
                                $sesi = 'end';
                            } else {
                                $sesi = 'open';
                            }
                        }

                    @endphp
                    @if ($status)
                        <div class="card border shadow shadow-sm my-3">
                            <div class="card-body">
                                <h3>{{ $item->layanan }}
                                    @if ($sesi == 'pending')
                                        <span class="badge badge-warning">Sesi Belum di buka</span>
                                    @elseif ($sesi == 'end')
                                        <span class="badge badge-danger">sesi berakhir</span>
                                    @elseif ($sesi == 'open')
                                        <span class="badge badge-primary">sesi dibuka</span>
                                    @else
                                        <span class="badge badge-warning">Ada kesalahan pada periode</span>
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
                    @else
                        <span class="text-center text-muted">Belum ada layanan bimbingan pada semester ini</span>
                    @endif
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
    @endif
    @if (Auth::user()->role == 'dosen')
        <div class="row">
            <div class="col-lg-6">
                @foreach ($widget['layanan'] as $item)
                    @php
                        $semester = App\Models\Semester::latest()->first()->id;
                        $status = App\Models\LayananPeriode::where('id_layanan', $item->id)
                            ->where('id_semester', $semester)
                            ->first();
                        $sesi = '';
                        if ($status) {
                            if ($status->tanggal_awal >= date('Y-m-d')) {
                                $sesi = 'pending';
                            } elseif ($status->tanggal_akhir <= date('Y-m-d')) {
                                $sesi = 'end';
                            } else {
                                $sesi = 'open';
                            }
                        }

                    @endphp
                    @if ($status)
                        <div class="card border shadow shadow-sm my-3">
                            <div class="card-body">
                                <h3>{{ $item->layanan }}
                                    @if ($sesi == 'pending')
                                        <span class="badge badge-warning">Sesi Belum di buka</span>
                                    @elseif ($sesi == 'end')
                                        <span class="badge badge-danger">sesi berakhir</span>
                                    @elseif ($sesi == 'open')
                                        <span class="badge badge-primary">sesi dibuka</span>
                                    @else
                                        <span class="badge badge-warning">Ada kesalahan pada periode</span>
                                    @endif
                                </h3>
                                <small class="text-danger">
                                    Periode : {{ \Carbon\Carbon::parse($status->tanggal_awal ?? null)->format('d F') }}
                                    sampai
                                    {{ \Carbon\Carbon::parse($status->tanggal_akhir ?? null)->format('d F') }}
                                </small>
                            </div>
                        </div>
                    @else
                        <span class="text-center text-muted">Belum ada layanan bimbingan pada semester ini</span>
                    @endif
                @endforeach
            </div>
            <div class="col-lg-6 mt-2">
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
