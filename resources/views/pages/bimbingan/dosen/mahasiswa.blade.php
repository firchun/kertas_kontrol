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
    @if (session('danger'))
        <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
            {{ session('danger') }}
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
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswa as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ Auth::user()->role == 'dosen' ? $item->mahasiswa->name : $item->name }}</strong><br>{{ Auth::user()->role == 'dosen' ? $item->mahasiswa->npm : $item->npm }}
                                    </td>
                                    <td>
                                        @php
                                            $bimbingan = App\Models\Bimbingan::where('id_user', $item->id_mahasiswa)
                                                ->where('id_layanan', $layanan->id)
                                                ->first();
                                            $cek_bimbingan = App\Models\Bimbingan::where('id_layanan', $layanan->id)
                                                ->where('id_user', $item->id_mahasiswa)
                                                ->where('id_semester', App\Models\Semester::latest()->first()->id)
                                                ->count();

                                        @endphp
                                        @if ($bimbingan)
                                            <span class="text-primary">Telah Mengisi Kartu Bimbingan</span><br>
                                            @if ($cek_bimbingan)
                                                @php
                                                    $hasil_bimbingan = App\Models\BimbinganHasil::where('id_bimbingan', $bimbingan->id)->count();
                                                @endphp
                                                @if ($hasil_bimbingan != 0)
                                                    <span class="badge badge-success">Selesai</span>
                                                @else
                                                    <span class="badge badge-warning">Proses</span>
                                                @endif
                                            @endif
                                        @else
                                            <span class="text-danger">Terlambat Mengisi Kartu Bimbingan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($cek_bimbingan != 0)
                                            @php
                                                $view_bimbingan =
                                                    App\Models\Bimbingan::where('id_layanan', $layanan->id)
                                                        ->where('id_user', $item->id_mahasiswa)
                                                        ->where('id_semester', App\Models\Semester::latest()->first()->id)
                                                        ->first() ?? null;
                                            @endphp
                                            <a href="{{ route('bimbingan.show', $view_bimbingan->id) }}"
                                                class="btn btn-primary "><i class="fa fa-folder-open"></i> Lihat Bimbingan
                                            </a>
                                        @else
                                            <a href="#" data-toggle="modal" data-target="#form-{{ $item->id }}"
                                                class="btn btn-primary "><i class="fa fa-plus"></i> Buat Bimbingan
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @include('pages.bimbingan.components.modal_form2')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
