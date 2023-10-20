@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __($title) }}</h1>

    @include('layouts.component.alert')
    @include('layouts.component.alert_validate')
    <div class="row">

        <div class="col-lg-12 ">
            <div class="my-2">
                <a href="#" data-toggle="modal" data-target="#create" class="btn btn-primary"><i class="fa fa-plus"></i>
                    Tambah Mahasiswa
                </a>
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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>NO. HP</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td><strong>
                                                {{ $item->name }}</strong>
                                        </td>
                                        <td><a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                                        </td>
                                        <td><a href="https://wa.me/{{ $item->phone }}"> {{ $item->phone }}</a>
                                        </td>
                                        <td style="width: 200px;">

                                            <a href="#" data-toggle="modal" data-target="#edit-{{ $item->id }}"
                                                class="btn btn-warning"><i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#delete-{{ $item->id }}"
                                                class="btn btn-danger"><i class="fa fa-trash"></i>
                                            </a>
                                            @include('pages.users.components.modal_edit')
                                        </td>
                                    </tr>
                                    @include('pages.users.components.modal_delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.users.components.modal_create_mahasiswa')
@endsection
