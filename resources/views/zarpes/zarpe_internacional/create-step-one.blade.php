@extends('layouts.app')
@section("titulo")
    Zarpes
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Permisos de {{$titulo}}</li>
            </ol>
        </nav>
    </div>
    </header>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-zarpes text-white">
                            <i class="fas fa-ship"></i>
                            <strong>Solicitud de Permisos de {{$titulo}} | Paso {{$paso}}</strong>

                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm" href="{{route('zarpeInternacional.index')}}">Cancelar</a>
                            </div>

                        </div>
                        <div class="card-body" style="min-height: 350px;">
                            @include('zarpes.zarpe_internacional.stepsIndicator')


                            <form action="{{ route('zarpeInternacional.permissionCreateStepOne') }}" method="POST">
                                @csrf

                                <div class="card">


                                    <div class="card-body" style="min-height:200px">

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-md-5 text-right"></div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="title">Bandera:</label>
                                                    <select name="bandera" id="bandera" class="form-control custom-select" placeholder='Seleccione'>
                                                        <option value="nacional">NACIONAL</option>
                                                        <option value="extranjera" >EXTRANJERA</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5"></div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right">
                                        <div class="row">
                                            <div class="col-md-6 text-left">

                                            </div>
                                            <div class="col-md-6 text-right">
                                                <button type="submit" class="btn btn-primary">Siguiente</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
