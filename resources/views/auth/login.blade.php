@extends('layouts/auth')
@section("titulo")
   Login
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <span>
                <!--<img src="{{asset('images/inea.png')}}" alt="inea" class="nav-avatar">-->
            </span>
            <div class="text-center">  <h4>Sistema de Solicitud de Permiso de Eventos</h4></div>

            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <form method="post" action="{{ url('/login') }}">
                            @csrf
                            <h1>Iniciar Sesión</h1>
                            <p class="text-muted">{{__('Sign In to your account')}}</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}" name="email" value="{{ old('email') }}"
                                       placeholder={{ __('E-Mail Address') }}>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                     <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                                <input type="password" class="form-control {{ $errors->has('password')?'is-invalid':'' }}" placeholder={{ __('Password') }} name="password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                       <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-primary px-4" type="submit">Acceder</button>
                                </div>
                                <div class="col-6 text-right">
                                    <a  href="{{ url('/password/reset') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card col-md-5 text-white bg-primary py-5">
                    <div class="card-body text-center">
                        <div>
                            <h2>{{__('Sign up')}}</h2>
                            <p>No tienes cuenta, regístrate aquí.</p>
                                <a class="btn btn-primary active mt-3" href="{{ url('/register') }}">{{ __('Register') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
