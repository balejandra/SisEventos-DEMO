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

                            <form action="#" method="POST">
                                @csrf

                                <div class="card">
                                    <div class="card-body ">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="row px-5" id="msj" data-asset="{{asset('images')}}">
                                        </div>

                                        <div class="row px-0 mx-0">
                                            <div class="col-sm-2 my-1">
                                                <div class="form-group">
                                                    <label for="title">Tipo Documento:</label>
                                                    {!! Form::select('tipodoc', ['V'=>'Cédula', 'P'=>'Pasaporte'], null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione', 'id'=>'tipodoc']) !!}
                                                </div>
                                            </div>

                                            <div class="col-sm-2 my-1">
                                                <div class="form-group">
                                                    <label for="numero_identificacion">Cédula / Pasaporte:</label>
                                                    <input type="text" class="form-control" id="numero_identificacion"
                                                           placeholder="Cédula / Pasaporte" maxlength="15">
                                                </div>
                                            </div>

                                            <div class="col-md-2 my-1">
                                                <div class="form-group">
                                                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                                                    <input type="date" class="form-control" id="fecha_nacimiento"
                                                           placeholder="Fecha de nacimiento" maxlength="10"
                                                           value="{{ old('fecha_nacimiento') }}" max='{{date("Y-m-d")}}'
                                                           required>
                                                </div>
                                            </div>


                                            <div class="col-md-2 my-1">
                                                <div class="form-group">
                                                    <label for="title">Sexo:</label>
                                                    {!! Form::select('sexo', ['F'=>'F', 'M'=>'M'], null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione', 'id'=>'sexo']) !!}
                                                </div>
                                            </div>

                                            <div class="col-md-2  my-1 DatosRestantes">
                                                <label for="nombres">Nombres:</label>
                                                <div class="input-group">

                                                    <input type="text" class="form-control" id="nombres"
                                                           placeholder="Nombres" name="nombres" maxlength="40">
                                                </div>
                                            </div>

                                            <div class="col-md-2  my-1 DatosRestantes">
                                                <label for="nombres">Apellidos:</label>
                                                <div class="input-group">

                                                    <input type="text" class="form-control" id="apellidos"
                                                           placeholder="Apellidos" name="apellidos" maxlength="40">
                                                </div>
                                            </div>

                                            <div class="col-sm-4  my-1 ">
                                                <label for="documento">Pasaporte:</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control" name="pasaporte_mayor"
                                                           id="pasaporte_mayor" accept="application/pdf, image/*"  onchange="validarExtension('pasaporte_mayor','msj')">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 text-center my-1">
                                                <br>
                                                <button type="button" class="btn btn-primary"
                                                        onclick="getDataPassengers('ZI')">
                                                    Agregar
                                                </button>

                                            </div>
                                        </div>
                                            <br>
                                        <div class="row">

                                        </div>


                                        <div class="row">

                                            <div class="col-md-12 py-2">
                                                <b>Cantidad de pasajeros disponible para esta embarcación:</b>
                                                <span id="cantPasajeros" data-cantPass="{{  $validation['pasajerosRestantes'] }}">
                                                    {{ $validation['pasajerosRestantes'] ?? '' }}
                                                </span>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table table-bordered"  id="table-scroll" style="width: 100%;">
                                                    <thead>
                                                    <tr>
                                                        <th width="18%">Cédula</th>
                                                        <th>Nombres</th>
                                                        <th>Apellidos</th>
                                                        <th width="5%">Sexo</th>
                                                        <th>Fecha Nacimiento</th>
                                                        <th width="5%">Menor</th>
                                                        <th width="5%">Representante</th>
                                                        <th width="5%">Acciones</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="pasajeros">
                                                    @if(!is_array($passengers))
                                                        @php
                                                            $cant=0;
                                                        @endphp
                                                        
                                                    @else
                                                        @php
                                                            $cant=count($passengers);
                                                        @endphp
                                                        @foreach($passengers as $position)
                                                            <tr id='{{$position["nro_doc"]}}'>
                                                                <td>{{$position["tipo_doc"]}}
                                                                    -{{$position["nro_doc"]}} </td>
                                                                <td>{{$position["nombres"]}}</td>
                                                                <td>{{$position["apellidos"]}}</td>
                                                                <td class="text-center">{{$position["sexo"]}}</td>
                                                                <td>{{$position["fecha_nacimiento"]}}</td>
                                                                @if($position["menor_edad"]==1)
                                                                    <td class="text-center">SI</td>
                                                                @else
                                                                    <td class="text-center">NO</td>
                                                                @endif
                                                                <td class="text-center">{{$position["representante"]}}</td>
                                                                <td>
                                                                    @php
                                                                        $tipodoc=$position["tipo_doc"];
                                                                    @endphp
                                                                    @if(!$position["menor_edad"])
                                                                        <a href='#'
                                                                           onclick="openModalPassengers('{{$tipodoc}}','{{$position["nro_doc"]}}', 2)"><i
                                                                                class='fa fa-user'
                                                                                title='Agregar menor representado'></i></a>
                                                                        &nbsp;&nbsp;
                                                                    @endif

                                                                    <a href='#'
                                                                       onclick="openModalPassengers('{{$tipodoc}}','{{$position["nro_doc"]}}', 1)"><i
                                                                            class='fa fa-trash'
                                                                            title='Eliminar'></i></a>
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>


                                    </div>
                            </form>


                            <form action="{{ route('zarpeInternacional.permissionCreateStepSix') }}" method="POST">
                                @csrf
                                <div id="dataPassengers" data-cant="{{$cant}}">
                                    @if($cant!=0)
                                        @php  $count=0; @endphp
                                        @foreach($passengers as $position)
                                            @php $count++; $id="content".$count; @endphp
                                            <div id="{{$id}}">
                                                @if($position["menor_edad"]==1)
                                                    <input type="hidden" name="menor[]" value="SI">
                                                @else
                                                    <input type="hidden" name="menor[]" value="NO">
                                                @endif
                                                <input type="hidden" name="tipodoc[]" value="{{$position['tipo_doc']}}">
                                                <input type="hidden" name="nrodoc[]" value='{{$position["nro_doc"]}}'>
                                                <input type="hidden" name="fechanac[]"
                                                       value='{{$position["fecha_nacimiento"]}}'>
                                                <input type="hidden" name="sexo[]" value='{{$position["sexo"]}}'>
                                                <input type="hidden" name="nombres[]" value='{{$position["nombres"]}}'>
                                                <input type="hidden" name="apellidos[]"
                                                       value='{{$position["apellidos"]}}'>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="card-footer text-right">
                                    <div class="row">
                                        <div class="col text-left">
                                            <a href="{{ route('zarpeInternacional.createStepFive') }}"
                                               class="btn btn-primary pull-right">Anterior</a>
                                        </div>
                                        <div class="col text-right">
                                            <button type="submit" class="btn btn-primary">Siguiente</button>
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


    <div class="modal fade" id="deletePassengerModal" tabindex="-1" aria-labelledby="deletePassengerModalLabel"
         aria-modal="true"
         role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmar eliminación de pasajero</h5>
                    <button type="button" class="close" aria-label="Close" onclick="closeModalPassengers(1)">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Realmente desea eliminar al Pasajero (<span id='ci'></span>) seleccionado?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModalPassengers(1)">Cerrar</button>
                    <button type="button" id="btnDelete" class="btn btn-primary" data-ced=''
                            onclick="deletePassenger()">Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show" id="backdrop" style="display: none;"></div>




    <div class="modal fade" id="AddPassengerModal" tabindex="-1" aria-labelledby="AddPassengerModalLabel"
         aria-modal="true"
         role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddPassengerModalLabel">Agregar menor representado por: <span
                            id='ci2'></span></h5>
                    <button type="button" class="close" aria-label="Close" onclick="closeModalPassengers(2)">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="errorModalPass" data-asset="{{asset('images')}}"></div>
                    {!! Form::open(['files' => true,'id'=>'FormPassengersMenor']) !!}
                    @csrf

                    <div class="row px-0 mx-0">
                        <div class="col-md-2 my-1 px-1">
                            <div class="form-group">
                                <label for="title">Tipo Documento:</label>
                                {!! Form::select('tipodocmenor', ['V'=>'Cédula', 'P'=>'Pasaporte', 'NC'=>'No cedulado'], null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione', 'id'=>'tipodocmenor']) !!}
                            </div>

                        </div>

                        <div class="col  my-1">
                            <label for="numero_identificacion">Cédula / Pasaporte:</label>
                            <div class="input-group">

                                <input type="text" class="form-control" id="numero_identificacionMenor"
                                       placeholder="Cédula / Pasaporte" maxlength="15" onblur="blurSaime()">
                            </div>
                        </div>

                        <div class="col my-1">
                            <label for="fecha_nacimientoMenor">Fecha de Nacimiento:</label>
                            <div class="input-group">

                                <input type="date" class="form-control" id="fecha_nacimientoMenor"
                                       placeholder="Fecha de nacimiento" maxlength="10"
                                       value="{{ old('fecha_nacimientoMenor') }}" max='{{date("Y-m-d")}}' required
                                       onblur="blurSaime()">
                            </div>
                        </div>

                    </div>

                    <div class="row px-0 mx-0">

                        <div class="col-md-2 my-1 px-1">
                            <div class="form-group">
                                <label for="title">Sexo:</label>
                                {!! Form::select('sexoMenor', ['F'=>'F', 'M'=>'M'], null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione', 'id'=>'sexoMenor']) !!}
                            </div>
                        </div>


                        <div class="col  my-1 DatosRestantes2">
                            <label for="nombres">Nombres:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nombresMenor" placeholder="Nombres"
                                       name="nombresMenor" maxlength="40">
                            </div>
                        </div>

                        <div class="col  my-1 DatosRestantes2">
                            <label for="nombres">Apellidos:</label>
                            <div class="input-group">

                                <input type="text" class="form-control" id="apellidosMenor" placeholder="Apellidos"
                                       name="apellidosMenor" maxlength="40">
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            {!! Form::label('documento_1', 'Partida de Nacimiento (Obligatorio):') !!}
                            <input type="file" class="form-control" name="partida_nacimiento" id="partida_nacimiento"
                                   accept="application/pdf, image/*" required  onchange="validarExtension('partida_nacimiento','errorModalPass')">
                        </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('documento_1', 'Autorización (Si amerita):') !!}
                            <input type="file" class="form-control" name="autorizacion" id="autorizacion"
                                   accept="application/pdf, image/*"  onchange="validarExtension('autorizacion','errorModalPass')">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                         {!! Form::label('documento_1', 'Pasaporte (Obligatorio):') !!}
                            <input type="file" class="form-control" name="pasaporte_menor" id="pasaporte_menor"
                                   accept="application/pdf, image/*" required  onchange="validarExtension('pasaporte_menor','errorModalPass')">
                        </div>
                    </div>


                    <input type="hidden" class="form-control" id="representanteMenor" placeholder="Nombres"
                           name="representanteMenor" maxlength="40">
                    {!! Form::close() !!}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModalPassengers(2)">Cerrar</button>
                    <button type="button" id="btnAdd" class="btn btn-primary" data-ced='' onclick="AddPassengerMenor('ZI')">
                        Agregar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show" id="backdrop" style="display: none;"></div>



@endsection
