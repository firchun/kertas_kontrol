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
        <img src="{{ asset('img/favicon.png') }}" height="100px;" class="mb-3" alt="logo">
        <h2><b class="text-primary">Dashboard</b><br>Sistem Informasi Kertas Kontrol<br>Jurusan Sistem Infromasi</h2>
    </div>
    <hr>
    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'ketua_jurusan')
        <div class="row">
            <div class="col-12">
                @include('pages.components_dashboard.grafik_hambatan')
            </div>
            <div class="col-12 mt-4">
                <h1>Analisis Hambatan Mahasiswa semester {{ App\Models\Semester::latest()->first()->code }}</h1>
                <hr>
            </div>
            @foreach ($widget['hambatan'] as $hambatanItem)
                <div class="col-lg-3 p-2">
                    @php
                        $semester_now = App\Models\Semester::latest()->first();
                        $semester_before = App\Models\Semester::latest()
                            ->skip(1)
                            ->first();

                        $bimbinganHambatan = App\Models\bimbinganHambatan::where('id_semester', $semester_now->id)
                            ->where('id_hambatan', $hambatanItem->id)
                            ->get();
                        $before = App\Models\bimbinganHambatan::where('id_semester', $semester_before->id ?? 0)
                            ->where('id_hambatan', $hambatanItem->id)
                            ->get();

                        $total_hambatan = App\Models\bimbinganHambatan::count();

                        $data_now = $bimbinganHambatan->count();
                        $data_before = $before->count();
                        $perbandingan = $data_now - $data_before;
                        $persentase = ($perbandingan / ($data_before != 0 ? $data_before : 1)) * 100;
                    @endphp
                    <div class="card {{ $perbandingan <= 0 ? 'border-success' : 'border-danger' }}">
                        <div class="card-body">
                            <b>{{ $hambatanItem->jenis_hambatan }}</b><br>
                            <h2>
                                <span class="{{ $perbandingan <= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($persentase, 2) }} %</span>
                                @if ($data_now > $data_before)
                                    <i class="fa fa-arrow-up text-danger"></i>
                                @elseif($data_now < $data_before)
                                    <i class="fa fa-arrow-down text-success"></i>
                                @endif
                                </h1>
                                <p>Total : <b>{{ $data_now }}</b> Mahasiswa
                                    <br>
                                    Selisih : <b>{{ $perbandingan }}</b>
                                </p>
                        </div>
                    </div>
                </div>
            @endforeach
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
