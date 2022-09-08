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

                            <form action="{{ route('zarpeInternacional.store') }}" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                            <style>
                                                * {
                                                    box-sizing: border-box;
                                                }
                                            </style>
                                            <div class="form-group">
                                                <div class="row declaracion align-items-center">
                                                    <div class="blog-card">
                                                        <div class="meta">
                                                            <div class="card-body text-norma">
                                                                Declaro y doy fe que la información relacionada con los equipos de seguridad marítima
                                                                y ayudas a la navegación expuestos en esta solicitud son los existentes a bordo del buque
                                                                y estarán disponibles durante la navegación en el zarpe solicitado.
                                                            </div>
                                                        </div>
                                                        <div class="description d-flex align-items-center">
                                                            <div class="form">
                                                                <div class="page__section page__custom-settings">
                                                                    <div class="page__toggle">
                                                                        <label class="toggle">
                                                                            <input class="toggle__input" type="checkbox" id="option1" name="option1" required>
                                                                            <span class="toggle__label">
                                                                          <span class="toggle__text">DOY FE</span>
                                                                        </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row justify-content-center">
                                                    <div class="col div-equip">
                                                        <div class="row border bg-light text-th ">
                                                            <div class="col-md-6 col-sm-6 p-2 border-end text-center">
                                                                Equipo
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 p-2 border-end text-center">
                                                                Cantidad
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 p-2 text-center">
                                                                Otros
                                                            </div>
                                                        </div>

                                                        @foreach($equipos as $equipo)
                                                            <div class="row border">
                                                                <div class=" col-md-6 col-sm-6 p-2 border-end">
                                                                    <div class="form-check form-switch col-12">
                                                                        <input class="form-check-input equipo {{$equipo->equipo}}" type="checkbox"
                                                                               name="equipo[] " id='{{$equipo->id}}' value="{{$equipo->id}}"
                                                                               style="margin-left: auto;"
                                                                               onclick="equipocheck('{{$equipo->id}}','{{$equipo->cantidad}}','{{$equipo->otros}}')">
                                                                        <label class="form-check-label {{$equipo->equipo}}"
                                                                               for="flexSwitchCheckDefault"
                                                                               style="margin-inline-start: 30px;"> {{$equipo->equipo}} </label>

                                                                        <input type="text" class="form-control col-sm-7"
                                                                               id="{{$equipo->id}}selected"
                                                                               name="{{$equipo->id}}selected" value="false"
                                                                               hidden>

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3 col-sm-3 p-2 border-end">
                                                                    <div id="div_cant{{$equipo->id}}" class="equipostab">
                                                                        @if ($equipo->cantidad==true)
                                                                            <div class=" col-12 ">
                                                                                <input type="number" class="form-control" id="{{$equipo->id}}cantidad"
                                                                                       name="{{$equipo->id}}cantidad" placeholder="Cantidad" >
                                                                            </div>
                                                                        @else
                                                                            <div class=" col-12 ">
                                                                                NO APLICA
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-sm-3 p-2">
                                                                    <div id="valores_otros{{$equipo->id}}" class="equipostab">
                                                                        @if($equipo->otros!='ninguno')


                                                                            <div class=" form-inline">
                                                                                <label for="inputEmail4" class="col-sm-12"
                                                                                       style="text-transform: uppercase;">
                                                                                    @if($equipo->otros=="fecha_caducidad")
                                                                                        Fecha de Caducidad:

                                                                                        @php
                                                                                            $type="date";
                                                                                            $max="min=".date('Y-m-d').""
                                                                                        @endphp
                                                                                    @else
                                                                                        {{$equipo->otros}}:
                                                                                        @php
                                                                                            $type="text";
                                                                                            $max="";
                                                                                        @endphp
                                                                                    @endif
                                                                                </label>
                                                                                <input type="{{$type}}"
                                                                                       class="form-control col-sm-7" id="{{$equipo->id}}valores_otros"
                                                                                       name="{{$equipo->id}}valores_otros" {{$max}}>
                                                                                <input type="text" class="form-control col-sm-7"
                                                                                       id="otros" name="{{$equipo->id}}otros"
                                                                                       value="{{$equipo->otros}}" hidden>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right">
                                        <div class="row">
                                            <div class="col text-left">
                                                <a href="{{ route('zarpeInternacional.createStepSix') }}"
                                                   class="btn btn-primary pull-right">Anterior</a>
                                            </div>
                                            <div class="col text-right">
                                                <button id="solicitud" type="submit" class="btn btn-primary">Generar solicitud</button>
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
