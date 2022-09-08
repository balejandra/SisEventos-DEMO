@extends('layouts.auth')
@section("titulo")
    Confirmar Correo
@endsection
@section('content')

        <div class="row justify-content-center">

            <div class="col-md-8">
              <span>
                    <img src="{{asset('images/inea.png')}}" alt="inealogo" class="nav-avatar">
                </span>
                <div class="card" >
                    <div class="card-body text-center">
                        <h4 class="card-title ">{{__('Verify Your Email Address')}}</h4>
                        @if (session('resent'))
                            <p class="alert alert-success" role="alert">{{__('A fresh verification link has been sent to your email address.')}}</p>
                        @endif
                        <p class="card-text text-left">{{__('Before proceeding, please check your email for a verification link.')}}</p>
                        <p class="card-text text-left">{{__('If you did not receive the email')}} {{__('click here to request another')}}</p>


                            <div class="row">
                                <div class="col-6">
                                    <form method="POST" action="{{ route('verification.resend') }}">
                                        @csrf
                                <button type="submit" class="btn btn-primary px-4">{{ __('Send Email') }}</button>
                                    </form>
                            </div>
                                <div class="col-6">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary px-4" href="{{route('logout')}}">Ir a Inicio de Sesion</button>
                                    </form>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
