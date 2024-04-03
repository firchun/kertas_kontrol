@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <div class="col-lg-12 ">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                </div>

                <div class="card-body">
                    <table id="dataTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Layanan</th>
                                <th>Sesi</th>
                                @if (Auth::user()->role == 'mahasiswa')
                                    <th>Status</th>
                                @endif
                                <th>Periode</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($layanan as $item)
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
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $item->layanan }}</strong></td>
                                        <td style="width:160px;">
                                            @if ($sesi == 'pending')
                                                <span class="p-2 rounded text-white bg-warning">Sesi Belum di buka</span>
                                            @elseif ($sesi == 'end')
                                                <span class="p-2 rounded text-white bg-danger">sesi berakhir</span>
                                            @elseif ($sesi == 'open')
                                                <span class="badge badge-primary">sesi dibuka</span>
                                            @else
                                                <span class="badge badge-warning">Ada kesalahan pada periode</span>
                                            @endif
                                        </td>
                                        @if (Auth::user()->role == 'mahasiswa')
                                            <td>
                                                @if ($status->tanggal_awal >= date('Y-m-d') || $status->tanggal_akhir <= date('Y-m-d'))
                                                    @if ($bimbingan)
                                                        <span class="text-success">Telah Bimbingan</span>
                                                        @php
                                                            $hasil_bimbingan = App\Models\BimbinganHasil::where(
                                                                'id_bimbingan',
                                                                $bimbingan->id,
                                                            )->count();
                                                        @endphp
                                                        @if ($hasil_bimbingan == 0)
                                                            <span class="badge badge-warning">Proses</span>
                                                        @endif
                                                    @else
                                                        <span class="text-danger">Terlambat Bimbingan</span>
                                                        <br><small class="text-muted">*Silahkan segera komunikasikan pada
                                                            dosen
                                                            penasehat
                                                            akademik</small>
                                                    @endif
                                                @else
                                                    <span class="text-warning">Proses Bimbingan</span>
                                                @endif
                                            </td>
                                        @endif
                                        <td>
                                            Periode :
                                            {{ \Carbon\Carbon::parse($status->tanggal_awal ?? null)->format('d F') }}
                                            sampai
                                            {{ \Carbon\Carbon::parse($status->tanggal_akhir ?? null)->format('d F') }}
                                        </td>
                                        <td style="width: 250px;">
                                            @if (Auth::user()->role == 'mahasiswa')
                                                @php
                                                    $cek_bimbingan = App\Models\Bimbingan::where(
                                                        'id_layanan',
                                                        $item->id,
                                                    )
                                                        ->where('id_user', Auth::user()->id)
                                                        ->where(
                                                            'id_semester',
                                                            App\Models\Semester::latest()->first()->id,
                                                        )
                                                        ->count();
                                                @endphp
                                                @if ($cek_bimbingan != 0)
                                                    @php
                                                        $view_bimbingan = App\Models\Bimbingan::where(
                                                            'id_layanan',
                                                            $item->id,
                                                        )
                                                            ->where('id_user', Auth::user()->id)
                                                            ->where(
                                                                'id_semester',
                                                                App\Models\Semester::latest()->first()->id,
                                                            )
                                                            ->first();
                                                    @endphp
                                                    <a href="{{ route('bimbingan.show', $view_bimbingan->id) }}"
                                                        class="btn btn-primary "><i class="fa fa-folder-open"></i> Lihat
                                                        Bimbingan
                                                    </a>
                                                @else
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#form-{{ $item->id }}"
                                                        class="btn btn-primary @if ($sesi != 'open') disabled @endif"><i
                                                            class="fa fa-plus"></i> Buat Bimbingan
                                                    </a>
                                                @endif
                                            @else
                                                <a href="{{ route('bimbingan.mahasiswa', $item->id) }}"
                                                    class="btn btn-primary @if ($sesi == 'pending') disabled @endif"><i
                                                        class="fa  fa-folder-open"></i>
                                                    Lihat Mahasiswa
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @include('pages.bimbingan.components.modal_form')
                                @else
                                    <tr>
                                        <td colspan="5"> <span class="text-center text-muted">Belum ada layanan bimbingan
                                                pada semester ini</span></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
