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
            <div class="my-2">
                <a href="#" data-toggle="modal" data-target="#create" class="btn btn-primary"><i
                        class="fa fa-plus"></i>
                    Tambah Semester
                </a>
            </div>

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
                                            class="btn btn-primary"><i class="fa fa-info"></i> Periode
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#edit-{{ $item->id }}"
                                            class="btn btn-warning"><i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#delete-{{ $item->id }}"
                                            class="btn btn-danger"><i class="fa fa-trash"></i> Hapus
                                        </a>
                                        @include('pages.semester.components.modal_edit')
                                    </td>
                                </tr>
                                @include('pages.semester.components.modal_delete')
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
    @include('pages.semester.components.modal_create')
@endsection
