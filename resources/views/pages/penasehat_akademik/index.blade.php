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
                                <th>Dosen</th>
                                <th>Mendampingi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dosen as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $item->name }} {{ $item->last_name }}</strong><br>{{ $item->nip }}
                                    </td>
                                    <td>
                                        @php
                                            $mahasiswa = App\Models\PenasehatAkademik::where('id_dosen', $item->id)->count();
                                        @endphp
                                        @if ($mahasiswa == 0)
                                            <span class="badge badge-danger">Belum Ada</span>
                                        @else
                                            <span class="text-primary "><strong>{{ $mahasiswa }}</strong>
                                                Mahasiswa</span>
                                        @endif
                                    </td>
                                    <td style="width: 250px;">
                                        <a href="{{ route('penasehat_akademik.mahasiswa', $item->id) }}"
                                            class="btn btn-primary"><i class="fa fa-users"></i> Mahasiswa
                                        </a>
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
