@extends('layouts/auth')
@section("titulo")
    Olvido de Contraseña
@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
             <span>
              <!--  <img src="{{asset('images/inea.png')}}" alt="inea" class="nav-avatar">-->
            </span>
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="post" action="{{ url('/password/email') }}">
                            @csrf
                            <h1>{{__('Reset Password')}}</h1>
                            <p class="text-muted">{{__('Enter Email to reset password')}}</p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}" name="email" value="{{ old('email') }}"
                                       placeholder={{__('E-Mail Address')}}>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-6 offset-6">
                                    <button class="btn btn-block btn-primary" type="submit">
                                        <i class="fa fa-btn fa-envelope"></i> {{__('Send Password Reset Link')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
