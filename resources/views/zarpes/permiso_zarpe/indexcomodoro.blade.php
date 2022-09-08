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
                            <strong>Solicitud de Permisos de {{$titulo}}</strong>
                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm" href="{{ route('permisoszarpes.createStepOne') }}">Nuevo</a>
                            </div>
                        </div>
                        <div class="card-body" style="min-height: 350px;">
                            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-origen-tab" data-bs-toggle="pill" data-toggle="tab"
                                            data-bs-target="#origen" type="button" role="tab" aria-controls="origen"
                                            aria-selected="true">Solicitudes de Zarpe
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-destino-tab" data-bs-toggle="pill" data-toggle="tab"
                                            data-bs-target="#destino" type="button" role="tab" aria-controls="destino"
                                            aria-selected="false">Información de Arribos en su Establecimiento
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="origen" role="tabpanel"
                                     aria-labelledby="pills-origen-tab">

                                    <table class="table table-striped table-bordered compact display" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th data-priority="1">Nro. Solicitud</th>
                                            <th>Fecha de Solicitud</th>
                                            <th>Solicitante</th>
                                            <th>Bandera</th>
                                            <th>Matrícula</th>
                                            <th>Tipo Navegación</th>
                                            <th data-priority="2">Estatus</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($permisoOrigenZarpes as $permisoOrigenZarpe)
                                            <tr>
                                                <td>{{ $permisoOrigenZarpe->nro_solicitud }}</td>
                                                <td>{{$permisoOrigenZarpe->created_at}}</td>
                                                <td>{{ $permisoOrigenZarpe->user->nombres }} {{ $permisoOrigenZarpe->user->apellidos }}</td>
                                                <td>{{ $permisoOrigenZarpe->bandera }}</td>
                                                <td>{{ $permisoOrigenZarpe->matricula }}</td>
                                                <td>{{ $permisoOrigenZarpe->tipo_zarpe->nombre }}</td>
                                                @if ($permisoOrigenZarpe->status->id==1)
                                                    <td class="text-success">{{ $permisoOrigenZarpe->status->nombre}} </td>
                                                @elseif($permisoOrigenZarpe->status->id==2)
                                                    <td class="text-danger">{{ $permisoOrigenZarpe->status->nombre}} </td>
                                                @elseif($permisoOrigenZarpe->status->id==3)
                                                    <td class="text-warning">{{ $permisoOrigenZarpe->status->nombre}} </td>
                                                @elseif($permisoOrigenZarpe->status->id==4)
                                                    <td class="text-muted">{{ $permisoOrigenZarpe->status->nombre}} </td>
                                                @elseif($permisoOrigenZarpe->status->id==5)
                                                    <td class="text-primary">{{ $permisoOrigenZarpe->status->nombre}} </td>
                                                @elseif($permisoOrigenZarpe->status->id==7)
                                                    <td><span
                                                            class="text-danger bg-dark">{{$permisoOrigenZarpe->status->nombre}}</span>
                                                    </td>
                                                @elseif($permisoOrigenZarpe->status->id==6)
                                                    <td style="color: #fd7e14">{{$permisoOrigenZarpe->status->nombre}}</td>
                                                @elseif($permisoOrigenZarpe->status->id==14)
                                                    <td style="color: green">{{$permisoOrigenZarpe->status->nombre}}</td>
                                                @else
                                                    <td>{{ $permisoOrigenZarpe->status->nombre}} </td>
                                                @endif
                                                <td>

                                                    @if(($permisoOrigenZarpe->status->id=='3'))
                                                        @can('aprobar-zarpe')
                                                            <a data-route="{{route('status',[$permisoOrigenZarpe->id,'aprobado',$permisoOrigenZarpe->establecimiento_nautico_id])}}"
                                                               class="btn btn-success btn-sm confirmation" title="Aprobar" data-action="APROBAR" >
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                        @endcan
                                                        @can('rechazar-zarpe')
                                                        <!-- Button trigger modal -->
                                                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-rechazo"
                                                               onclick="modalrechazarzarpe({{$permisoOrigenZarpe->id}},'{{$permisoOrigenZarpe->nro_solicitud}}')">
                                                                <i class="fa fa-ban"></i>
                                                            </a>
                                                        @endcan
                                                    @endif
                                                    @can('consultar-zarpe')
                                                        <a class="btn btn-sm btn-primary"
                                                           href=" {{route('permisoszarpes.show',$permisoOrigenZarpe->id)}}">
                                                            <i class="fa fa-search"></i>
                                                        </a>
                                                    @endcan
                                                    @if(($permisoOrigenZarpe->status->id=='1') && (date_format($permisoOrigenZarpe->fecha_hora_salida,'Y-m-d H:i:s')<=(date('Y-m-d H:i:s'))))
                                                        @can('informar-navegacion')
                                                            <a class="btn btn-sm btn-warning confirmation"
                                                               data-route=" {{route('status',[$permisoOrigenZarpe->id,'navegando',$permisoOrigenZarpe->establecimiento_nautico_id])}}"
                                                               data-toggle="tooltip" data-bs-placement="bottom" title="Informar Navegacion" data-action="INFORMAR NAVEGACIÓN de">
                                                                <i class="fas fa-water"></i>
                                                            </a>
                                                        @endif
                                                        @if(($permisoOrigenZarpe->status->id=='1'))
                                                            <a class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal-anular"
                                                               onclick="modalanularzarpe({{$permisoOrigenZarpe->id}},'{{$permisoOrigenZarpe->nro_solicitud}}')" data-toggle="tooltip"
                                                               data-bs-placement="bottom" title="Anular Solicitud">
                                                                <i class="fas fa-window-close"></i>
                                                            </a>

                                                        @endif
                                                    @endcan
                                                    @if(($permisoOrigenZarpe->status->id=='5')||($permisoOrigenZarpe->status->id=='14'))
                                                        @can('anular-sar')
                                                            <a class="btn btn-sm btn-outline-danger confirmation"
                                                               data-route=" {{route('status',[$permisoOrigenZarpe->id,'anulado_sar',$permisoOrigenZarpe->establecimiento_nautico_id])}}"
                                                               data-toggle="tooltip" data-bs-placement="bottom" title="Anular por SAR" data-action="ANULAR POR SAR">
                                                                <i class="fas fa-briefcase-medical"></i>
                                                            </a>
                                                        @endcan
                                                    @endif
                                                    @if (($permisoOrigenZarpe->status->id==1)||($permisoOrigenZarpe->status->id==4)||($permisoOrigenZarpe->status->id==5))
                                                        <a class="btn btn-sm btn-dark" href="{{route('zarpepdf',$permisoOrigenZarpe->id)}}"
                                                           target="_blank" data-toggle="tooltip" data-bs-placement="bottom" title="Descargar PDF">
                                                            <i class="fas fa-file-pdf"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!--   ZARPES DESTINO    --->
                                <div class="tab-pane fade" id="destino" role="tabpanel"
                                     aria-labelledby="pills-destino-tab">
                                    <table class="table table-striped table-bordered compact display" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th data-priority="1">Nro. Solicitud</th>
                                            <th>Fecha de Solicitud</th>
                                            <th>Solicitante</th>
                                            <th>Bandera</th>
                                            <th>Matrícula</th>
                                            <th>Tipo Navegación</th>
                                            <th data-priority="2">Estatus</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($permisoDestinoZarpes as $permisoDestinoZarpe)
                                            <tr>
                                                <td>{{ $permisoDestinoZarpe->nro_solicitud }}</td>
                                                <td>{{$permisoDestinoZarpe->created_at}}</td>
                                                <td>{{ $permisoDestinoZarpe->user->nombres }} {{ $permisoDestinoZarpe->user->apellidos }}</td>
                                                <td>{{ $permisoDestinoZarpe->bandera }}</td>
                                                <td>{{ $permisoDestinoZarpe->matricula }}</td>
                                                <td>{{ $permisoDestinoZarpe->tipo_zarpe->nombre }}</td>
                                                @if ($permisoDestinoZarpe->status->id==1)
                                                    <td class="text-success">{{ $permisoDestinoZarpe->status->nombre}} </td>
                                                @elseif($permisoDestinoZarpe->status->id==2)
                                                    <td class="text-danger">{{ $permisoDestinoZarpe->status->nombre}} </td>
                                                @elseif($permisoDestinoZarpe->status->id==3)
                                                    <td class="text-warning">{{ $permisoDestinoZarpe->status->nombre}} </td>
                                                @elseif($permisoDestinoZarpe->status->id==4)
                                                    <td class="text-muted">{{ $permisoDestinoZarpe->status->nombre}} </td>
                                                @else
                                                    <td>{{ $permisoDestinoZarpe->status->nombre}} </td>
                                                @endif
                                                <td>
                                                    @can('consultar-zarpe')
                                                        <a class="btn btn-sm btn-primary"
                                                           href=" {{route('permisoszarpes.show',$permisoDestinoZarpe->id)}}">
                                                            <i class="fa fa-search"></i>
                                                        </a>
                                                        @if (($permisoDestinoZarpe->status->id==1)||($permisoDestinoZarpe->status->id==4) ||($permisoDestinoZarpe->status->id==5))
                                                            <a class="btn btn-sm btn-dark" href="{{route('zarpepdf',$permisoDestinoZarpe->id)}}"
                                                               target="_blank" data-toggle="tooltip" data-bs-placement="bottom" title="Descargar PDF">
                                                                <i class="fas fa-file-pdf"></i>
                                                            </a>
                                                        @endif
                                                    @endcan
                                                </td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Rechazar -->
                        <div class="modal fade" id="modal-rechazo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <form id="rechazar-zarpe" action="" class="modal-form">
                                <div class="modal-dialog modal-fullscreen-sm-down">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Rechazar Solicitud Zarpe</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Por favor indique el motivo del rechazo de la Solicitud Nro. <span id="solicitudzarpe"></span></p>
                                            <div class="col-sm-12">
                                                <div class="input-group mb-3">
                                                    <select class="form-select" aria-label="motivo" id="motivo1" name="motivo" onchange="motivoRechazo();" required>
                                                        <option value="">Seleccione un motivo</option>
                                                        <option value="Disposiciones del Ejecutivo Nacional">Disposiciones del Ejecutivo Nacional.</option>
                                                        <option value="Instrucciones especiales de la autoridad acuática">Instrucciones especiales de la autoridad acuática.</option>
                                                        <option value="Condiciones meteorológicas adversas">Condiciones meteorológicas adversas.</option>
                                                        <option value="Observaciones en los documentos">Observaciones en los documentos</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 form-group" style="display: none" id="inputmotivo">
                                                <input type="text" class="form-control" name="motivo" id="motivo2">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary" data-action="RECHAZAR">Rechazar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- ANULACION MODAL -->
                        <div class="modal fade" id="modal-anular" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <form id="anular-zarpe" action="" class="modal-form" >
                                <div class="modal-dialog modal-fullscreen-sm-down">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Anular Solicitud Zarpe</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Por favor indique el motivo de la anulación de la Solicitud Nro. <span id="nrosolicitud"></span></p>
                                            <div class="col-sm-12">
                                                <div class="input-group mb-3">
                                                    <select class="form-select" aria-label="motivo" id="motivo1" name="motivo" required>
                                                        <option value="">Seleccione un motivo</option>
                                                        <option value="Incumplimiento de la normativa legal vigente">Incumplimiento de la normativa legal vigente.</option>
                                                        <option value="Condiciones meteorológicas adversas">Condiciones meteorológicas adversas.</option>
                                                        <option value="Restricciones de Navegación por motivos de Seguridad y Defensa">Restricciones de Navegación por motivos de Seguridad y Defensa.</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary" data-action="ANULAR" >Anular</button>
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
