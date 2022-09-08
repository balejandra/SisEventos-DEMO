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
            <div >
            @include('flash::message')

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-zarpes text-white">
                            <i class="fas fa-ship"></i>
                            <strong>Solicitud de Permisos de {{$titulo}} | Paso {{$paso}}</strong>

                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm"
                                   href="{{route('zarpeInternacional.index')}}">Cancelar</a>

                            </div>

                        </div>
                        <div class="card-body" style="min-height: 350px;">

                            @include('zarpes.zarpe_internacional.stepsIndicator')


                            <form action="#" method="POST">
                                @csrf

                                <div class="card">
                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div  id="ErrorsFlash" class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if (isset($msj))
                                            <div id="flashMsj" class="alert alert-danger">
                                                {{$msj}}
                                            </div>
                                        @endif
                                        <div class="row px-5" id="msjMarinoInt" data-asset="{{asset('images')}}">

                                        </div>
                                        <div class="row margin">

                                            <div class="col-sm-2 px-1">
                                                <div class="form-group">
                                                    <label>Función:</label>
                                                    <select id="funcion" name="funcion" class="form-control custom-select">
                                                        <option value="">Seleccione</option>
                                                        <option value="Capitán">Capitán</option>
                                                        <option value="Motorista">Motorista</option>
                                                        <option value="Marino">Marino</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-sm-2 px-1">
                                                <div class="form-group">
                                                    <label for="title">Tipo Documento:</label>
                                                    {!! Form::select('tipodoc', ['V'=>'Cédula', 'P'=>'Pasaporte'], null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione', 'id'=>'tipodocZI']) !!}
                                                </div>
                                            </div>

                                            <div class="col-sm-2  px-1">
                                                <div class="form-group">
                                                    <label for="title">Cédula/Pasaporte:</label>
                                                    <input type="text" class="form-control" id="nrodoc" name="nrodoc" maxlength="15">
                                                </div>
                                            </div>


                                            <div class="col-sm-2  px-1 DatosRestantes">
                                                <div class="form-group" >
                                                    <label for="title">Nombres:</label>
                                                    <input type="text" class="form-control" id="nombres" name="nombres"  onkeydown="return /[a-z, ]/i.test(event.key)" maxlength="35">
                                                </div>
                                            </div>

                                            <div class="col-sm-2  px-1 DatosRestantes">
                                                <div class="form-group">
                                                    <label for="title">Apellidos:</label>
                                                    <input type="text" class="form-control" id="apellidos" name="apellidos" onkeydown="return /[a-z, ]/i.test(event.key)" maxlength="35">
                                                </div>
                                            </div>



                                            <div class="col-sm-2  px-1 DatosRestantes ">
                                                <div class="form-group">
                                                    <label for="title">Fecha de Nacimiento:</label>
                                                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" >
                                                </div>
                                            </div>

                                            <div class="col-sm-2  px-1 DatosRestantes ">
                                                <div class="form-group">
                                                    <label for="title">Sexo:</label>
                                                    <select name="sexo" id="sexo" class="form-control custom-select">
                                                        <option value="">Seleccione</option>
                                                        <option value="M">M</option>
                                                        <option value="F">F</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2  px-1 DatosRestantes">
                                                <div class="form-group">
                                                    <label for="title">Rango:</label>
                                                    <input type="text" class="form-control" id="rango" name="rango" maxlength="35">
                                                </div>
                                            </div>

                                            <div class="col-sm-4 DatosRestantes">
                                                <div class="form-group">
                                                    <label for="title">Documento de Acreditación:</label>
                                                    <input type="file" class="form-control" id="documentoAcreditacion" name="documentoAcreditacion"  accept=".pdf, .jpg, .png" onchange="validarExtension('documentoAcreditacion','msjMarinoInt')" >
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="title">Pasaporte:</label>
                                                    <input type="file" class="form-control" id="doc" name="doc" accept=".pdf, .jpg, .png" onchange="validarExtension('doc', 'msjMarinoInt')">
                                                </div>
                                            </div>

                                            <div class="col-sm-12 my-2 text-center">
                                                <br>
                                                <button type="button" class="btn btn-primary"
                                                        onclick="AddPasportsMarinos()">
                                                    Agregar
                                                </button>
                                            </div>
                                        </div>


                                        <div class="row text-center ">

                                        </div>

                                        <div class="row mt-3 px-3">
                                            <div id="cantTripulantes">
                                                @php
                                                    $validacion= json_decode(session('validacion'));
                                                     $cantTrip=$validacion->cant_tripulantes;

                                                @endphp

                                                Cantidad mínima de tripulantes abordo: {{$cantTrip}}
                                            </div>

                                                <table class="table table-bordered example1" id="example2" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>Función</th>
                                                        <th>Cédula / Pasaporte</th>
                                                        <th>Nombres y Apellidos</th>
                                                        <th>Rango</th>
                                                        <th>Fecha de Emisión</th>
                                                        <th>Nro. de Documento</th>
                                                        <th>Documentos</th>
                                                        <th>Acciones</th>

                                                    </tr>
                                                    </thead>

                                                    <tbody id="marinosZI" data-rimg="{{asset('documentos/zarpeinternacional/')}}">

                                                    @if(isset($tripulantes))


                                                        @if(!is_array($tripulantes))
                                                            @php

                                                                $cant=0;

                                                            @endphp
                                                            <tr id="nodataTrip">
                                                                <td colspan="6" class="text-center" id="nodata">Sin
                                                                    registros para mostrar
                                                                </td>
                                                            </tr>
                                                        @else

                                                            @php
                                                                $cant=count($tripulantes);
                                                            @endphp

                                                            @foreach($tripulantes as $trip)

                                                                <tr id='{{$trip["nro_doc"]}}'>

                                                                    <td> {{$trip["funcion"]}} </td>

                                                                    <td>{{$trip["tipo_doc"]}} {{$trip["nro_doc"]}}</td>
                                                                    <td>{{$trip["nombres"]}} {{$trip["apellidos"]}}</td>
                                                                    <td>{{$trip["rango"]}}</td>
                                                                    <td>
                                                                        @if($trip["fecha_emision"]=="")
                                                                            N/A
                                                                        @else
                                                                            {{$trip["fecha_emision"]}}
                                                                        @endif
                                                                    </td>
                                                                    <td>  {{$trip["nro_ctrl"]}}</td>
                                                                    <td>
                                                                        <a class="document-link" title="Pasaporte" href="{{asset('documentos/zarpeinternacional/'.$trip['doc'])}}" target="_blank"> Pasaporte </a>

                                                                        @if($trip["documento_acreditacion"]!="")
                                                                            <br>
                                                                            <a class="document-link" title="Pasaporte" href="{{asset('documentos/zarpeinternacional/'.$trip['documento_acreditacion'])}}" target="_blank"> Doc. Acreditación. </a>
                                                                        @endif
                                                                    </td>

                                                                    <td>
                                                                        <a href="#"
                                                                           onclick="openModalZI('{{$trip["nro_doc"]}}')">
                                                                            <i class="fa fa-trash"></i>
                                                                        </a>

                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('zarpeInternacional.permissionCreateStepFive') }}"
                                          method="POST">
                                        @csrf


                                        <div class="card-footer text-right">
                                            <div class="row">
                                                <div class="col text-left">
                                                    <a href="{{ route('zarpeInternacional.createStepFour') }}"
                                                       class="btn btn-primary pull-right">Anterior</a>
                                                </div>
                                                <div class="col text-right">
                                                    <button type="submit" class="btn btn-primary">Siguiente</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDeleteTrip" tabindex="-1" aria-labelledby="modalDeleteTripLabel" aria-modal="true"
         role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteTripLabel">Confirmar</h5>
                    <button type="button" class="close" aria-label="Close" onclick="closeModalZI()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Realmente desea eliminar al tripulante (<span id='ci'></span>) seleccionado?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModalZI()">Cerrar</button>
                    <button type="button" id="btnDelete" class="btn btn-primary" data-ced=''
                            onclick="deleteTripulanteZI()">Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show" id="backdrop" style="display: none;"></div>


@endsection
