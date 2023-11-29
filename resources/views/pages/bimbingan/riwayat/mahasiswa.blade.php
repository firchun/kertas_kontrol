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
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Layanan Bimbingan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswa as $item)
                                @php
                                    if (Auth::user()->role == 'dosen') {
                                        $bimbingan = App\Models\Bimbingan::where('id_user', $item->id_mahasiswa)
                                            ->where('id_semester', $semester->id)
                                            ->get();
                                    } else {
                                        $bimbingan = App\Models\Bimbingan::where('id_user', $item->id)
                                            ->where('id_semester', $semester->id)
                                            ->get();
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ Auth::user()->role == 'dosen' ? $item->mahasiswa->name : $item->name }}</strong><br>{{ Auth::user()->role == 'dosen' ? $item->mahasiswa->npm : $item->npm }}
                                    </td>
                                    <td>
                                        @if ($bimbingan->count() != 0)
                                            <span class="text-success">Telah Mengisi Kartu Bimbingan</span>
                                        @else
                                            <span class="text-danger">Terlambat Mengisi Kartu Bimbingan</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($bimbingan->count() != 0)
                                            <ol>
                                                @foreach ($bimbingan as $item)
                                                    <li>{{ $item->layanan->layanan }}</li>
                                                @endforeach
                                            </ol>
                                        @else
                                            <span class="text-danger">Tidak ada layanan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-primary"><i class="fa fa-print"></i> Cetak
                                            Riwayat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
