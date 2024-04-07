@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    
                
                    <div class="col-12" style="justify-content: center; align-items: center;display:flex">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/sisam.png" style="width: 350px; padding-top:90px; padding-bottom: 90px">
                        </a>
                    </div>

                    @if (session('mensaje'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span class="alert-text"><strong>{{ session('mensaje') }}</strong></span>
                                    <button button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div> 
                                @endif
                        
                    
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4" style="margin:-12%">
                            <small style="font-size: 18px" style="z-index: initial">
                                    Por Favor Ingrese los siguientes datos 
                                    <br>
                                    para ingresar al sistema:
                            </small>
                        </div>
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('USUARIO') }}" type="text" name="username" value="{{ old('email') }}" value="admin@argon.com" required autofocus>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('CONTRASEÑA') }}" type="password" value="" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('INGRESAR AL SISTEMA') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
