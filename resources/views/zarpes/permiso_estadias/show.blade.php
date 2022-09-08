@extends('layouts.app')
@section("titulo")
    Estadias
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{{ route('permisosestadia.index') }}">Permisos de Estadía</a>
                </li>
                <li class="breadcrumb-item ">Consulta</li>
            </ol>
        </nav>
    </div>
    </header>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('coreui-templates::common.errors')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-water"></i>
                            <strong>Consultar Permiso de Estadía</strong>
                            <div class="card-header-actions">
                                <a href="{{route('permisosestadia.index')}} "
                                   class="btn btn-primary btn-sm">Cancelar</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('zarpes.permiso_estadias.show_fields')
                            <strong>Asignación de Inspección</strong>
                            <table class="table table-hover nooptionsearch border table-grow" style="width: 50%">
                                <thead>
                                <tr>
                                    <th>Nombre del Visitador</th>
                                    <th>Fecha de Visita</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($visitas as $visita)
                                    <tr>
                                        <td>{{$visita->nombre_visitador}}</td>
                                        <td>{{date_format($visita->fecha_visita,'d-m-Y')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <br>

                            <strong>Historial de Revisiones</strong>
                            <table class="table table-hover nooptionsearch border table-grow" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>Nombre y Apellido</th>
                                    <th>Acción</th>
                                    <th>Motivo</th>
                                    <th>Fecha</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($revisiones as $revision)
                                    <tr>
                                        <td>{{$revision->user->nombres}} {{$revision->user->apellidos}}</td>
                                        <td>{{$revision->accion}}</td>
                                        <td>{{$revision->motivo}}</td>
                                        <td>{{$revision->created_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <br>
                            @can('asignar-visita-estadia')
                                @if ($permisoEstadia->status_id===3)
                                <!-- Button trigger modal -->
                                    <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal"
                                       data-toggle="tooltip"
                                       data-bs-placement="bottom" title="Asignar Visitador"
                                       onclick="modalvisita({{$permisoEstadia->id}},'{{$permisoEstadia->nro_solicitud}}');">
                                        Asignar Visitador <i class="fas fa-user-clock"></i>
                                    </a>
                                @endif
                            @endcan

                            @can('visita-estadia-aprobada')
                                @if ($permisoEstadia->status_id===9)
                                    <a class="btn btn-info confirmation"
                                       data-route=" {{route('statusEstadia',[$permisoEstadia->id,10])}}"
                                       data-toggle="tooltip"
                                       data-bs-placement="bottom" title="Aprobar Visita"
                                       data-action="APROBAR LA VISITA de">
                                        Aprobar Visita <i class="fas fa-user-check"></i>
                                    </a>
                                @endif
                            @endcan

                            @can('recaudos-estadia')
                                @if ($permisoEstadia->status_id===10)
                                    <a class="btn" style="background-color: #fd7e14"
                                       href=" {{ route('permisosestadia.edit', [$permisoEstadia->id]) }}"
                                       data-toggle="tooltip"
                                       data-bs-placement="bottom"
                                       title="Subir Recaudos Faltantes">
                                        Subir Recaudos Faltantes <i class="fas fa-book"></i>
                                    </a>
                                @endif
                            @endcan
                            @can('aprobar-estadia')
                                @if ($permisoEstadia->status_id===11)
                                    <a class="btn btn-primary confirmation"
                                       data-route="{{route('statusEstadia',[$permisoEstadia->id,1])}}"
                                       data-toggle="tooltip"
                                       data-bs-placement="bottom" data-action="APROBAR" title="Aprobar">
                                        Aprobar <i class="fa fa-check"></i>
                                    </a>
                                @endif
                            @endcan

                            @can('rechazar-estadia')
                                @if (($permisoEstadia->status_id===3) || ($permisoEstadia->status_id===9) || ($permisoEstadia->status_id===11)  )
                                <!-- Button trigger modal -->
                                    <a class="btn btn-danger" data-bs-toggle="modal" data-toggle="tooltip"
                                       data-bs-placement="bottom" data-bs-target="#modal-rechazar"
                                       onclick="modalrechazarestadia({{$permisoEstadia->id}},'{{$permisoEstadia->nro_solicitud}}')">
                                        Rechazar <i class="fa fa-ban"></i>
                                    </a>
                                @endif
                            @endcan

                            @if ($permisoEstadia->status_id===1)
                                <a class="btn btn-dark"
                                   href="{{route('estadiapdf',$permisoEstadia->id)}}"
                                   target="_blank" data-toggle="tooltip"
                                   data-bs-placement="bottom" title="Descargar PDF">
                                    Descargar PDF <i class="fas fa-file-pdf"></i>
                                </a>


                                @if ((date_format($permisoEstadia->vencimiento->subDay(15),'Y-m-d')<=date('Y-m-d')) and ($permisoEstadia->vencimiento>date('Y-m-d')) )
                                    @can('renovar-estadia')
                                        <a class="btn" style="background-color: #bf0063"
                                           href="{{route('createrenovacion',$permisoEstadia->id)}}"
                                           data-toggle="tooltip"
                                           data-bs-placement="bottom"
                                           title="Renovar Permiso de Estadía">
                                            Renovar Permiso de Estadía <i class="fas fa-file-import"></i>
                                        </a>
                                @endcan
                            @endif

                        @endif
                        <!-- Modal ASIGNAR VISITA -->
                            <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false"
                                 tabindex="-1" aria-labelledby="staticBackdropLabel"
                                 aria-hidden="true">
                                <form id="visita" action="" class="modal-form">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Asignar Visitador</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Por favor llene los datos necesarios para la visita de la solicitud
                                                    Nro. <span id="solicitud"></span></p>
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        {!! Form::label('visitador', 'Nombres y Apellidos del Visitador:') !!}
                                                        {!! Form::text('visitador', null, ['class' => 'form-control', 'required']) !!}
                                                    </div>
                                                    @php
                                                        $fechaActual=new DateTime();
                                                        $fechaActual->setTimeZone(new DateTimeZone('America/Caracas'));
                                                        $fechaActual=$fechaActual->format('Y-m-d');
                                                    @endphp
                                                    <div class="form-group col-sm-6">
                                                        {!! Form::label('fecha_visita', 'Fecha de Visita:') !!}
                                                        <input type="date" name="fecha_visita" class="form-control"
                                                               min="{{$fechaActual}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Cerrar
                                                </button>
                                                <button type="submit" class="btn btn-primary"
                                                        data-action="ASIGNAR VISITA">Asignar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal RECHAZAR -->
                            <div class="modal fade" id="modal-rechazar" data-bs-backdrop="static"
                                 data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                 aria-hidden="true">
                                <form id="rechazar-estadia" action="" class="modal-form">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="staticBackdropLabel">Rechazar Solicitud Estadia</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Por favor indique el motivo del rechazo de la Solicitud Nro. <span
                                                        id="solicitudrechazo"></span></p>
                                                <div class="col-sm-12">
                                                    <div class="input-group mb-3">
                                                        <select class="form-select" aria-label="motivo" id="motivo1"
                                                                name="motivo" onchange="motivoRechazo();" required>
                                                            <option value="">Seleccione un motivo</option>
                                                            <option value="Disposiciones del Ejecutivo Nacional">
                                                                Disposiciones del Ejecutivo Nacional.
                                                            </option>
                                                            <option
                                                                value="Instrucciones especiales de la autoridad acuática">
                                                                Instrucciones especiales de la autoridad acuática.
                                                            </option>
                                                            <option value="Condiciones meteorológicas adversas">
                                                                Condiciones meteorológicas adversas.
                                                            </option>
                                                            <option value="Observaciones en los documentos">
                                                                Observaciones en los documentos
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 form-group" style="display: none" id="inputmotivo">
                                                    <input type="text" class="form-control" name="motivo" id="motivo2">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Cerrar
                                                </button>
                                                <button type="submit" class="btn btn-primary" data-action="RECHAZAR">
                                                    Rechazar
                                                </button>
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
    </div>
@endsection
