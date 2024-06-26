@extends('layouts.auth')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0  my-5"
                    style="border-radius: 20px; box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block  p-5" style="background-color: rgb(236, 236, 236); ">
                                <div class="text-center">

                                    <h3 class="text-primary font-weight-bold">LAYANAN BIMBINGAN</h3>
                                    <img src="{{ asset('img/musamus.png') }}" style="height: 200px;" class="my-2">
                                    <h3 class="text-primary font-weight-bold">JURUSAN SISTEM INFORMASI</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center mb-2">
                                        <div class=" mb-4 d-lg-none form-inline justify-content-center">
                                            {{-- <img src="{{ asset('img/favicon.png') }}" class="img-fluid pr-2 border-right"
                                                style="height:40px;"> --}}
                                            {{-- <img src="{{ asset('img/favicon.png') }}" class="img-fluid"
                                                style="height:80px;"> --}}
                                        </div>
                                        <span class="h5 text-primary">Wellcome to</span>
                                        <h1 class="text-primary mb-0 font-weight-bold">{{ env('APP_NAME') }}</h1>
                                        <hr>

                                        {{-- <P class="text-muted mb-3">Login untuk dapat mengakses berkas..</P> --}}
                                    </div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger border-left-danger" role="alert">
                                            <ul class="pl-4 my-2">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if (session('danger'))
                                        <div class="alert alert-danger" role="alert">
                                            <h5>Gagal</h5>
                                            {{ session('danger') }}
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('login') }}" class="user">
                                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control " name="email"
                                                placeholder="{{ __('NIP/NIDN/NPM/Email') }}" value="{{ old('email') }}"
                                                required autofocus>
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control " name="password"
                                                placeholder="{{ __('Password') }}" required>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label"
                                                    for="remember">{{ __('Remember Me') }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </form>
                                    <hr>
                                    {{-- @if (Route::has('password.request'))
                                        <div class="text-center">
                                            <a class="small" href="{{ route('password.request') }}">
                                                {{ __('Forgot Password?') }}
                                            </a>
                                        </div>
                                    @endif

                                    @if (Route::has('register'))
                                        <div class="text-center">
                                            <a class="small"
                                                href="{{ route('register') }}">{{ __('Create an Account!') }}</a>
                                        </div>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
