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
    @php
        $cek_hasil = App\Models\BimbinganHasil::where('id_bimbingan', $bimbingan->id)->count();
    @endphp
    @if (Auth::user()->role == 'dosen')
        @if ($cek_hasil != 0)
            <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
                Bimbingan telah selesai
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @else
            <div class="mb-4">
                <a href="#" data-toggle="modal" data-target="#form-hasil" class="btn btn-primary btn-lg">
                    <i class="fa fa-file"></i> Hasil Bimbingan
                </a>
            </div>
        @endif
        @include('pages.bimbingan.components.modal_hasil')
    @endif

    <div class="row">
        @if (Auth::user()->role == 'mahasiswa')
            <div class="col-lg-2">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Dosen</h6>
                    </div>
                    <div class="card-body">
                        <table class="table" style="font-size: 12px;">
                            <tr>
                                <td>
                                    <strong>{{ $dosen_pa->dosen->name . ' ' . $dosen_pa->dosen->last_name }}</strong>
                                    <br>{{ $dosen_pa->dosen->nip }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>{{ $dosen_pa->dosen->phone ?? '0' }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>{{ $dosen_pa->dosen->address ?? '-' }}</strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="col-lg-2">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Mahasiswa</h6>
                    </div>

                    <div class="card-body">
                        <table class="table" style="font-size: 12px;">
                            <tr>
                                <td>
                                    <strong>{{ $dosen_pa->mahasiswa->name }}</strong>
                                    <br>{{ $dosen_pa->mahasiswa->npm }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>{{ $dosen_pa->mahasiswa->phone ?? '0' }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>{{ $dosen_pa->mahasiswa->address ?? '-' }}</strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-6 ">
            @if ($cek_hasil != 0)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Hasil Bimbingan</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Isi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\BimbinganHasil::where('id_bimbingan', $bimbingan->id)->get() as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->isi }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Chat {{ $title }}</h6>
                    </div>

                    <div class="card-body" style="">
                        <iframe style="width:100%; min-height:60vh; border:none; overflow: hidden;"
                            src="{{ route('chat', [$bimbingan->id_user, $bimbingan->id]) }}"></iframe>

                    </div>
                </div>
            @endif
        </div>
        <div class="col-lg-4 ">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Hambatan</h6>
                </div>
                <div class="card-body">
                    @foreach ($hambatan as $item)
                        <div class="border border-danger p-2 my-2 rounded text-danger">
                            {{ $item->hambatan->jenis_hambatan }}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Isi Bimbingan</h6>
                </div>
                <div class="card-body">
                    <div class="border border-primary p-2 my-2 rounded">
                        <p>{{ $bimbingan->isi }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
