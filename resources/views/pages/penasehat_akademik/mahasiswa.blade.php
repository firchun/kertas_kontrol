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
            <div class="my-2 form-inline">
                <a href="{{ route('penasehat_akademik') }}" class="btn btn-secondary mx-2"><i class="fa fa-arrow-left"></i>
                    Kembali
                </a>
                @if (Auth::user()->role == 'admin')
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#create"><i
                            class="fa fa-plus"></i>
                        Tambah Mahasiswa
                    </a>
                @endif
            </div>

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">

                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mahasiswa</th>
                                    <th>Bimbingan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $item->mahasiswa->name }}</strong><br>{{ $item->mahasiswa->npm }}
                                        </td>
                                        <td>
                                            @php
                                                $semester = App\Models\Semester::latest()->first() ?? '-';
                                                $bimbingans = App\Models\Bimbingan::where(
                                                    'id_user',
                                                    $item->id_mahasiswa,
                                                )
                                                    ->where('id_semester', $semester->id)
                                                    ->whereHas('bimbinganHasils', function ($query) {
                                                        $query->whereExists(function ($subquery) {
                                                            $subquery
                                                                ->select(\DB::raw(1))
                                                                ->from('bimbingan_hasils')
                                                                ->whereRaw(
                                                                    'bimbingan_hasils.id_bimbingan = bimbingans.id',
                                                                );
                                                        });
                                                    })
                                                    ->get();
                                            @endphp
                                            <ul>
                                                @foreach (App\Models\Layanan::all() as $layanan)
                                                    @php
                                                        $layananExist = false;
                                                    @endphp
                                                    @foreach ($bimbingans as $bimbingan)
                                                        @if ($bimbingan->id_layanan == $layanan->id)
                                                            <li>{{ $bimbingan->layanan->layanan }} - <span
                                                                    class="text-success">{{ $semester->code }}</span></li>
                                                            @php
                                                                $layananExist = true;
                                                                break;
                                                            @endphp
                                                        @endif
                                                    @endforeach

                                                    @if (!$layananExist)
                                                        <li><span class="text-danger">{{ $layanan->layanan }}</span> -
                                                            <span class="text-danger">{{ $semester->code }}</span>
                                                        </li>
                                                    @endif
                                                @endforeach

                                            </ul>
                                        </td>

                                        <td style="width: 300px;">
                                            @if (Auth::user()->role == 'admin')
                                                <a href="#" data-toggle="modal"
                                                    data-target="#delete-{{ $item->id }}" class="btn btn-danger"><i
                                                        class="fa fa-trash"></i> Hapus
                                                </a>
                                            @elseif(Auth::user()->role == 'ketua_jurusan')
                                                <form action="{{ route('bimbingan.riwayat.preview') }}" method="GET">
                                                    <input type="hidden" name="id_mahasiswa"
                                                        value="{{ Auth::user()->role == 'dosen' ? $item->id_mahasiswa : $item->id_mahasiswa }}">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <select name="id_semester" class="form-control mr-3 mb-3">
                                                                @foreach (App\Models\Semester::all() as $list)
                                                                    <option value="{{ $list->id }}">
                                                                        {{ $list->code }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <button type="submit" class="btn btn-primary">
                                                                Lihat
                                                                Riwayat</button>
                                                        </div>
                                                    </div>


                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @include('pages.penasehat_akademik.components.modal_delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.penasehat_akademik.components.modal_create')
@endsection
