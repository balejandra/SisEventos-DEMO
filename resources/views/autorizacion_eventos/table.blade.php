<table class="table table-striped table-bordered display2" style="width:100%">
        <thead>
            <tr>
                <th>Nro Solicitud</th>
                <th>Fecha de Solicitud</th>
                <th>Solicitante</th>
                <th>Nombre Evento</th>
                <th>Fecha Evento</th>
                <th>Lugar</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($autorizacionEventos as $autorizacionEvento)
            <tr>
            <td>{{ $autorizacionEvento->nro_solicitud }}</td>
                <td>{{ $autorizacionEvento->created_at }}</td>
            <td>{{ $autorizacionEvento->user->nombres }} {{ $autorizacionEvento->user->apellidos }}</td>
            <td>{{ $autorizacionEvento->nombre_evento }}</td>
            <td>{{ date_format($autorizacionEvento->fecha ,'d-m-Y')}}</td>
            <td>{{ $autorizacionEvento->lugar }}</td>
                @if ($autorizacionEvento->status->id==1)
                    <td class="text-success">{{ $autorizacionEvento->status->nombre}} </td>
                @elseif($autorizacionEvento->status->id==2)
                    <td class="text-danger">{{ $autorizacionEvento->status->nombre}} </td>
                @elseif($autorizacionEvento->status->id==3)
                    <td class="text-warning">{{ $autorizacionEvento->status->nombre}} </td>
                @elseif($autorizacionEvento->status->id==4)
                    <td style="color: #fd7e14">{{$autorizacionEvento->status->nombre}}</td>
                @elseif($autorizacionEvento->status->id==5)
                    <td><span class="text-warning bg-dark">{{$autorizacionEvento->status->nombre}}</span></td>
                @elseif($autorizacionEvento->status->id==6)
                    <td class="text-primary">{{ $autorizacionEvento->status->nombre}} </td>
                @elseif($autorizacionEvento->status->id==7)
                    <td style="color: #770bba">{{ $autorizacionEvento->status->nombre}} </td>
                @else
                    <td>{{ $autorizacionEvento->status->nombre}} </td>
                @endif
                <td>
                    @can('consultar-evento')
                        <a class="btn btn-sm btn-success"
                           href="  {{ route('autorizacionEventos.show', $autorizacionEvento['id']) }}">
                            <i class="fa fa-search"></i>
                        </a>
                    @endcan
                        @can('aprobar-evento')
                            @if ($autorizacionEvento->status_id===3)
                                <a class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#aprobacion" data-toggle="tooltip"
                                   data-bs-placement="bottom" title="Aprobar Evento"
                                   onclick="modalaprobacion({{$autorizacionEvento->id}},'{{$autorizacionEvento->nro_solicitud}}');">
                                    <i class="fa fa-check"></i>
                                </a>
                            @endif
                        @endcan
                        @can('rechazar-evento')
                            @if (($autorizacionEvento->status_id===3)  )
                            <!-- Button trigger modal -->
                                <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-toggle="tooltip" title="Rechazar Evento"
                                   data-bs-placement="bottom" data-bs-target="#modal-rechazar" onclick="modalrechazarestadia({{$autorizacionEvento->id}},'{{$autorizacionEvento->nro_solicitud}}')">
                                    <i class="fa fa-ban"></i>
                                </a>
                            @endif
                        @endcan
                        @if (($autorizacionEvento->status_id===1) || ($autorizacionEvento->status_id===4) )
                        <a class="btn btn-sm btn-dark"
                           href="{{route('eventopdf',$autorizacionEvento->id)}}"
                           target="_blank" data-toggle="tooltip"
                           data-bs-placement="bottom"
                           title="Descargar PDF">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                        @endif
                        @can('anular-eventoUsuario')
                            @if ($autorizacionEvento->status->id==1 || ($autorizacionEvento->status_id===3))
                                <a class="btn btn-sm btn-danger confirmation"
                                   data-route="{{route('updateStatus',[$autorizacionEvento->id,6])}}" data-toggle="tooltip"
                                   data-bs-placement="bottom" title="Anular Solicitud" data-action="ANULAR" >
                                    <i class="fas fa-window-close"></i>
                                </a>
                            @endif
                        @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

<!--MODAL RECHAZAR-->
<div class="modal fade" id="modal-rechazar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
     aria-hidden="true">
    <form id="rechazar-estadia" action="" class="modal-form">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="staticBackdropLabel">Rechazar Autorizacion de Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Por favor indique el motivo del rechazo de la Solicitud Nro. <span id="solicitudrechazo"></span></p>
                    <div class="col-sm-12">
                        <div class="input-group mb-3">
                            <select class="form-select" aria-label="motivo" id="motivo1" name="motivo" onchange="motivoRechazo();" required>
                                <option value="">Seleccione un motivo</option>
                                <option value="Disposiciones del Ejecutivo Nacional">Disposiciones del Ejecutivo Nacional.</option>
                                <option value="Condiciones meteorol??gicas adversas">Condiciones meteorol??gicas adversas.</option>
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
<!-- Modal Aprobacion -->
<div class="modal fade" id="aprobacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
     aria-hidden="true">
    <form id="form_aprobacion" action="" class="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Aprobar Autorizacion de Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Por favor llene los datos necesarios para la Aprobacion de la solicitud Nro. <span id="solicitud"></span></p>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            {!! Form::label('visitador', 'Monto a Pagar Petro:') !!}
                            {!! Form::text('monto_pagar_petros', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" data-action="APROBAR">Aprobar</button>
                </div>
            </div>
        </div>
    </form>
</div>
