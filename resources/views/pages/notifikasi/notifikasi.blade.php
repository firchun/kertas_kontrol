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
    <div class="card shadow mb-4">
        <div class="card-header">
            <h5>{{ $title }}</h5>
        </div>
        <div class="card-body">
            <div class="my-3">
                <form action="{{ route('read_all', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success"
                        {{ App\Models\Notifikasi::where('id_user', Auth::user()->id)->where('is_read', null)->count() == 0? 'disabled': '' }}>
                        <i class="fa fa-check"> </i>
                        <span>Tandai telah dibaca</span>
                    </button>
                </form>
            </div>
            <table class="table table-bordered table-hover" id="datatable">
                <thead>
                    <tr>
                        <th style="width:10px;">NO</th>
                        <th>Notifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($notifikasi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><small class="text-muted">{{ $item->created_at->format('d F Y , H:i:s') }}</small>
                                <br><a href="{{ url($item->url) }}"><strong>{{ $item->message }}</strong></a><br>
                                {!! $item->is_read == null ? '<small>Belum dibaca</small>' : '<small class="text-success">Telah dibaca</small>' !!}
                            </td>
                            {{-- <td>{{ App\Models\DataLahan::getPetani($item->id) != null ? 'Ada' : 'Belum diisi' }}</td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td>Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
