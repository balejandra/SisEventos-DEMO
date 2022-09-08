@extends('layouts/auth')
@section("titulo")
    Reseteo de Contraseña
@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
              <span>
                <img src="{{asset('images/inea.png')}}" alt="inea" class="nav-avatar">
            </span>
            <div class="card mx-4">
                <div class="card-body p-4">
                    @include('coreui-templates::common.errors')
                    <form method="post" action="{{ url('/password/reset') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <h1>{{__('Reset Password')}}</h1>
                        <p class="text-muted">{{__('Enter email and new password')}}</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}" name="email" value="{{ old('email') }}" placeholder="{{__('E-Mail Address')}}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                              </span>
                            </div>
                            <input type="password" class="form-control {{ $errors->has('password')?'is-invalid':''}}" name="password" placeholder="{{__('Password')}}">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                              </span>
                            </div>
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="{{__('Confirm Password')}}">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                               </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-block btn-primary btn-block btn-flat">
                            <i class="fa fa-btn fas fa-redo"></i> {{__('Reset')}}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
