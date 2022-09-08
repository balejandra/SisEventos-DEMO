@extends('layouts.app')
@section("titulo")
    Zarpes
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">{{$titulo}}</li>
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
                        <div class="card-header">
                            <i class="fas fa-ship"></i>
                            <strong>Solicitud de Permisos de {{$titulo}} | Paso 3</strong>

                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm" href="{{route('permisoszarpes.index')}}">Cancelar</a>

                            </div>

                        </div>
                        <div class="card-body" style="min-height: 350px;">

                            @include('zarpes.permiso_zarpe.stepsIndicator')


                            <form action="{{ route('permisoszarpes.permissionCreateStepThree') }}" method="POST">
                                @csrf

                                <div class="card">

                                    @php
                                        $solicitud= json_decode(session('solicitud'));

                                        $tipozarpes=$solicitud->tipo_zarpe_id;
                                        $descripcion=$solicitud->descripcion_navegacion_id;
                                        $capitaniaOrigen=$solicitud->origen_capitania_id;
                                        $selectedcap='';
                                        $selectedtz='';
                                        $selecteddn="";

                                    @endphp
                                    <div class="card-body" style="min-height: 200px;">

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
                                            <div class="col-md-1"></div>

                                            <div class="col-md-3">

                                                <div class="form-group">
                                                    <label for="title">Tipo de Navegación:</label>

                                                    <select id="tipo_de_navegacion" name="tipo_de_navegacion"
                                                            class="form-control custom-select" >
                                                        <option value="">Seleccione</option>

                                                        @foreach ($TipoZarpes as $tz)
                                                            @if($tipozarpes==$tz->id || $tz->id ==old('tipo_de_navegacion'))
                                                                @php
                                                                    $selectedtz="selected='selected'";
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $selectedtz='';
                                                                @endphp
                                                            @endif
                                                            <option
                                                                value="{{$tz->id}}" {{$selectedtz}} >{{$tz->nombre}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">
                                                    <label for="title">Descripción de la Navegación:</label>

                                                    <select id="descripcion_de_navegacion"
                                                            name="descripcion_de_navegacion"
                                                            class="form-control custom-select"
                                                            onchange="getCapitania();">
                                                        <option value="">Seleccione</option>
                                                        @foreach($descripcionNavegacion as $dn)
                                                            @if($descripcion==$dn->id || $dn->id ==old('descripcion_de_navegacion'))
                                                                @php
                                                                    $selecteddn="selected='selected'";
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $selecteddn='';
                                                                @endphp
                                                            @endif

                                                            @if($dn->id!=4)
                                                                <option
                                                                    value="{{$dn->id}}" {{$selecteddn}} >{{$dn->descripcion}}</option>
                                                            @endif
                                                        @endforeach


                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group">
                                                    <label for="title">Capitanía de Origen:</label>

                                                    <select id="capitania" name="capitania"
                                                            class="form-control custom-select">
                                                        <option value="">Seleccione</option>

                                                        @foreach ($capitanias as $capitania)
                                                            @if($capitaniaOrigen==$capitania->id || $capitania->id ==old('capitania'))
                                                                @php
                                                                    $selectedcap="selected='selected'";
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $selectedcap='';
                                                                @endphp
                                                            @endif
                                                            <option
                                                                value="{{$capitania->id}}" {{$selectedcap}} >{{$capitania->nombre}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-md-1"></div>


                                    </div>

                                    <div class="card-footer text-right">
                                        <div class="row">
                                            @if($bandera=='extranjera')
                                                <div class="col text-left">
                                                    <a href="{{ route('permisoszarpes.CreateStepTwoE') }}"
                                                       class="btn btn-primary pull-right">Anterior</a>
                                                </div>
                                            @else
                                                <div class="col text-left">
                                                    <a href="{{ route('permisoszarpes.CreateStepTwo') }}"
                                                       class="btn btn-primary pull-right">Anterior</a>
                                                </div>
                                            @endif

                                            <div class="col text-right">
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
