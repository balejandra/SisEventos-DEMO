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

            <div class="col-md-12" id="errorMat">


            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-zarpes text-white">
                            <i class="fas fa-ship"></i>
                            <strong>Solicitud de Permisos de {{$titulo}}</strong>

                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm" href="{{route('zarpeInternacional.index')}}">Cancelar</a>
                            </div>

                        </div>
@php
     $solicitud= json_decode(session('solicitud'));

@endphp
                        <div class="card-body" style="min-height: 350px;">
                            @include('zarpes.permiso_zarpe.stepsIndicator')

                            <form action="{{ route('zarpeInternacional.permissionCreateSteptwo') }}" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-body" style="min-height: 250px;">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="row gy-2 gx-3 justify-content-center">
                                             <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="title">Siglas:</label>

                                                    <select id="siglas" name="siglas" class="form-control custom-select"  >
                                                        <option value="">Seleccione</option>
                                                        @foreach($siglas as $sigla)
                                                            @if($matriculaActual[0] ==$sigla->sigla)
                                                                @php
                                                                $selectedSigla="selected='selected'";
                                                                @endphp
                                                            @else
                                                                @php
                                                                $selectedSigla='';
                                                                @endphp
                                                            @endif

                                                            @if($sigla->sigla!='SEDE')
                                                            <option value="{{$sigla->sigla}}" {{$selectedSigla}}  >{{$sigla->sigla}}</option>
                                                            @endif
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="title">Destinación:</label>

                                                    <select id="destinacion1" name="destinación" class="form-control custom-select"  >

                                                        @if($matriculaActual[1] =="RE")
                                                                @php
                                                                $selectedRE="selected='selected'";
                                                                $selectedDE='';

                                                                @endphp
                                                            @elseif($matriculaActual[1] =="DE")
                                                                @php
                                                                    $selectedRE="";
                                                                    $selectedDE="selected='selected'";
                                                                @endphp
                                                            @else
                                                                @php
                                                                    $selectedRE="";
                                                                    $selectedDE="";
                                                                @endphp
                                                        @endif

                                                        <option value="">Seleccione</option>
                                                        <option value="RE" {{$selectedRE}} >RE</option>
                                                        <option value="DE" {{$selectedDE}} >DE</option>


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="title">Número:</label>
                                                                @if($matriculaActual[2]!="")
                                                                    @php
                                                                        $numero=$matriculaActual[2];
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $numero='';
                                                                    @endphp
                                                                @endif
                                                    <input type="text" class="form-control" name="número" id="numero" value="{{$numero}}" maxlength="4" onKeyDown="return soloNumeros(event)">
                                                </div>
                                            </div>

                                            <div class="col-auto">
                                                <br>
                                                <button type="button" class="btn btn-primary" onclick="getmatriculaZI($('#siglas').val(),$('#destinacion1').val(),$('#numero').val())">Verificar</button>
                                            </div>
                                        </div>
                                            <br>
                                            <div class="row">
                                            <div class="col">
                                                <div id="table-buque" style="display: none;">
                                                    <div class="text-center">
                                                        <h4>Datos de la Embarcación</h4>
                                                    </div>

                                                    <div class="row rounded border p-3 justify-content-center ">
                                                        <div class="row row-cols-1 row-cols-md-3">
                                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                                <div class="card border-primary mb-3">
                                                                    <div class="card-header">Matrícula:<br>
                                                                        <input type="text" id="matricula" class="w-100 input-transparente"
                                                                               name="matricula" value="" readonly></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                                <div class="card border-primary mb-3">
                                                                    <div class="card-header">Nombre:<br>
                                                                        <input type="text" id="nombre" class="w-100 input-transparente"
                                                                               name="nombre" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                                <div class="card border-primary mb-3">
                                                                    <div class="card-header">Destinación:<br>
                                                                        <input type="text" name="destinacion" class="w-50 input-transparente"
                                                                               id="destinacion" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row ">
                                                            <div class="col-sm-12 col-md-4  col-lg-4">
                                                                <div class="card border-primary mb-3">
                                                                    <div class="card-header">UAB:<br>
                                                                        <input type="text" name="UAB" id="UAB" class="w-50 input-transparente"
                                                                               readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-4  col-lg-4">
                                                                <div class="card border-primary mb-3">
                                                                    <div class="card-header">Eslora:<br>
                                                                        <input type="text" name="eslora" class="w-50 input-transparente" id="eslora" readonly></div>

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                                <div class="card border-primary mb-3">
                                                                    <div class="card-header">Manga:<br>
                                                                        <input type="text" name="manga" class="w-50 input-transparente"
                                                                               id="manga" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="card border-primary mb-3">
                                                                    <div class="card-header"> Propietario:<br>
                                                                        <input type="text"
                                                                               name="nombre_propietario" id="nombre_propietario"  class="w-50 input-transparente" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="card border-primary mb-3">
                                                                    <div class="card-header">Número de Identificación:<br>
                                                                        <input type="text" class="w-50 input-transparente"
                                                                               name="numero_identificacion"
                                                                               id="numero_identificacion" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row row-cols-1 row-cols-md-3">
                                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                                <div class="card border-primary mb-3">
                                                                    <div class="card-header">Licencia de Navegación:<br>
                                                                        <input type="text" name="licenciaNavegacion" class="w-100 input-transparente"
                                                                               id="licenciaNavegacion" readonly>
                                                                        <br><br>
                                                                        Fecha de Vencimiento:<br>
                                                                        <input type="text" class="w-50 input-transparente" name="fechalicencia"
                                                                               id="fechalicencia" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                                <div class="card border-primary mb-3">
                                                                    <div class="card-header">Asignación de Número ISMM:<br>
                                                                        <input type="text" name="ismm" id="ismm" readonly class="w-100 input-transparente">
                                                                        <br><br>
                                                                        Fecha de Vencimiento:<br>
                                                                        <input type="text" class="w-50 input-transparente" name="fechacertificado"
                                                                               id="fechacertificado" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-4">
                                                                <div class="card border-primary mb-3">
                                                                    <div class="card-header border">Certificado Nacional de Seguridad
                                                                        Radiotelefónica:<br>
                                                                        <input type="text" name="certificadoRadio" id="certificadoRadio"
                                                                               readonly class="w-100 input-transparente">
                                                                        <br><br>
                                                                        Fecha de Vencimiento:<br>
                                                                        <input type="text" class="w-50 input-transparente" name="fechaIsmm"
                                                                               id="fechaIsmm" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                    </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <div class="row">
                                            <div class="col text-left">
                                                <a href="{{ route('zarpeInternacional.createStepOne') }}"
                                                   class="btn btn-primary pull-right">Anterior</a>
                                            </div>
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
