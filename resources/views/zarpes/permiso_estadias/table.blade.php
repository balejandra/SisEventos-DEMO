<table class="table table-striped table-bordered display2" style="width:100%">
    <thead>
    <tr>
        <th data-priority="1">Nro. Solicitud</th>
        <th>Fecha Solicitud</th>
        <th>Solicitante</th>
        <th>Nombre Buque</th>
        <th>Nro. Registro Buque</th>
        <th>Puerto Origen</th>
        <th>Puerto Destino</th>
        <th style="font-size: 12px; width: 5%">Días de Estadía aprobados en el País</th>
        <th data-priority="2">Estatus</th>
        <th style="width: max-content">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($permisoEstadias as $permisoEstadia)

        <tr>
            <td>{{ $permisoEstadia->nro_solicitud }}</td>
            <td>{{ $permisoEstadia->created_at }}</td>
            <td>{{ $permisoEstadia->user->nombres }} {{ $permisoEstadia->user->apellidos }}</td>
            <td>{{ $permisoEstadia->nombre_buque }}</td>
            <td>{{ $permisoEstadia->nro_registro }}</td>
            <td>{{ $permisoEstadia->puerto_origen }}</td>
            <td>{{ $permisoEstadia->capitania->nombre }}</td>
            @if (($permisoEstadia->status->id==1) or ($permisoEstadia->status->id==12))
                <td>{{$permisoEstadia->cantidad_solicitud*90}} días</td>
            @else
                <td></td>
            @endif

            @if ($permisoEstadia->status->id==1)
                <td class="text-success">{{ $permisoEstadia->status->nombre}} </td>
            @elseif($permisoEstadia->status->id==2)
                <td class="text-danger">{{ $permisoEstadia->status->nombre}} </td>
            @elseif($permisoEstadia->status->id==3)
                <td class="text-warning">{{ $permisoEstadia->status->nombre}} </td>
            @elseif($permisoEstadia->status->id==6)
                <td style="color: #fd7e14">{{$permisoEstadia->status->nombre}}</td>
            @elseif($permisoEstadia->status->id==9)
                <td><span class="text-warning bg-dark">{{$permisoEstadia->status->nombre}}</span></td>
            @elseif($permisoEstadia->status->id==10)
                <td class="text-primary">{{ $permisoEstadia->status->nombre}} </td>
            @elseif($permisoEstadia->status->id==11)
                <td style="color: #770bba">{{ $permisoEstadia->status->nombre}} </td>
            @elseif($permisoEstadia->status->id==12)
                <td class="text-muted">{{ $permisoEstadia->status->nombre}} </td>
            @else
                <td>{{ $permisoEstadia->status->nombre}} </td>
            @endif
            <td>
                @can('consultar-estadia')
                    <a class="btn btn-sm btn-success"
                       href="  {{ route('permisosestadia.show', $permisoEstadia['id']) }}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan
                @can('asignar-visita-estadia')
                    @if ($permisoEstadia->status_id===3)
                    <!-- Button trigger modal -->
                        <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal" data-toggle="tooltip"
                           data-bs-placement="bottom" title="Asignar Visitador"
                           onclick="modalvisita({{$permisoEstadia->id}},'{{$permisoEstadia->nro_solicitud}}');">
                            <i class="fas fa-user-clock"></i>
                        </a>
                    @endif
                @endcan
                @can('visita-estadia-aprobada')
                    @if (($permisoEstadia->status_id===9)&& (date_format($permisoEstadia->visita->fecha_visita,'Y-m-d H:i:s')<=(date('Y-m-d H:i:s'))))
                        <a class="btn btn-sm btn-info confirmation"
                           data-route=" {{route('statusEstadia',[$permisoEstadia->id,10])}}" data-toggle="tooltip"
                           data-bs-placement="bottom" title="Aprobar Visita" data-action="APROBAR LA VISITA de">
                            <i class="fas fa-user-check"></i>
                        </a>
                    @endif
                @endcan

                @can('recaudos-estadia')
                    @if ($permisoEstadia->status_id===10)
                        <a class="btn btn-sm" style="background-color: #fd7e14"
                           href=" {{ route('permisosestadia.edit', [$permisoEstadia->id]) }}" data-toggle="tooltip"
                           data-bs-placement="bottom"
                           title="Subir Recaudos Faltantes">
                            <i class="fas fa-book"></i>
                        </a>
                    @endif
                @endcan
                @can('aprobar-estadia')
                    @if ($permisoEstadia->status_id===11)
                        <a class="btn btn-sm btn-primary confirmation"
                           data-route="{{route('statusEstadia',[$permisoEstadia->id,1])}}" data-toggle="tooltip"
                           data-bs-placement="bottom" data-action="APROBAR" title="Aprobar">
                            <i class="fa fa-check"></i>
                        </a>
                    @endif
                @endcan

                @can('rechazar-estadia')
                    @if (($permisoEstadia->status_id===3) || ($permisoEstadia->status_id===9) || ($permisoEstadia->status_id===11)  )
                    <!-- Button trigger modal -->
                        <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-toggle="tooltip"
                           data-bs-placement="bottom" data-bs-target="#modal-rechazar" onclick="modalrechazarestadia({{$permisoEstadia->id}},'{{$permisoEstadia->nro_solicitud}}')">
                            <i class="fa fa-ban"></i>
                        </a>
                    @endif
                @endcan

                @if ($permisoEstadia->status_id===1)
                    <a class="btn btn-sm btn-dark"
                       href="{{route('estadiapdf',$permisoEstadia->id)}}"
                       target="_blank" data-toggle="tooltip"
                       data-bs-placement="bottom"
                       title="Descargar PDF">
                        <i class="fas fa-file-pdf"></i>
                    </a>


                    @if ((date_format($permisoEstadia->vencimiento->subDay(15),'Y-m-d')<=date('Y-m-d')) and ($permisoEstadia->vencimiento>date('Y-m-d')) )
                        @can('renovar-estadia')
                            <a class="btn btn-sm" style="background-color: #bf0063"
                               href="{{route('createrenovacion',$permisoEstadia->id)}}" data-toggle="tooltip"
                               data-bs-placement="bottom"
                               title="Renovar Permiso de Estadía">
                                <i class="fas fa-file-import"></i>
                            </a>
                        @endcan
                    @endif

                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<!-- Modal ASIGNAR VISITA -->
<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
     aria-hidden="true">
    <form id="visita" action="" class="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Asignar Visitador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Por favor llene los datos necesarios para la visita de la solicitud Nro. <span id="solicitud"></span></p>
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
                            <input type="date" name="fecha_visita" id="fecha_visita"  class="form-control" min="{{$fechaActual}}" max="9999-12-31" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" data-action="ASIGNAR VISITA">Asignar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal RECHAZAR -->
<div class="modal fade" id="modal-rechazar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
     aria-hidden="true">
    <form id="rechazar-estadia" action="" class="modal-form">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="staticBackdropLabel">Rechazar Solicitud Estadia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Por favor indique el motivo del rechazo de la Solicitud Nro. <span id="solicitudrechazo"></span></p>
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
