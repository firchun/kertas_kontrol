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
                                <th>Semester</th>
                                <th>Code</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semester as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $item->semester }}</strong><br>{{ $item->tahun }}</td>
                                    <td>
                                        <strong>{{ $item->code }}</strong><br>
                                        @if ($item->id == $semester->first()->id)
                                            <span class=" badge badge-danger">Active</span>
                                        @endif
                                    </td>
                                    <td style="width: 300px;">
                                        <a href="#" data-toggle="modal" data-target="#info-{{ $item->id }}"
                                            class="btn btn-secondary"><i class="fa fa-info"></i> Periode
                                        </a>
                                        @if (Auth::user()->role == 'mahasiswa')
                                            <a href="#" class="btn btn-primary"><i class="fa fa-print"></i>
                                                Cetak Riwayat
                                            </a>
                                        @else
                                            <a href="{{ route('bimbingan.riwayat.mahasiswa', $item->code) }}"
                                                class="btn btn-primary"><i class="fa fa-folder"></i>
                                                Mahasiswa
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @foreach ($semester as $item)
        @include('pages.semester.components.modal_info')
    @endforeach
@endsection
