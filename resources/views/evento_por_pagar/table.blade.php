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
                           href="  {{ route('eventosPorPagar.show', $autorizacionEvento['id']) }}">
                            <i class="fa fa-search"></i>
                        </a>
                    @endcan
                        @can('aprobar-pago')
                            @if (($autorizacionEvento->status_id===1)  )
                            <!-- Button trigger modal -->
                                <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal" data-toggle="tooltip"
                                   data-bs-placement="bottom" title="Aprobar Pago"
                                   onclick="modalvisita({{$autorizacionEvento->id}},'{{$autorizacionEvento->nro_solicitud}}');">
                                    <i class="far fa-money-bill-alt"></i>
                                </a>
                            @endif
                        @endcan
                        @if (($autorizacionEvento->status_id===1)  )
                        <a class="btn btn-sm btn-dark"
                           href="{{route('eventopdf',$autorizacionEvento->id)}}"
                           target="_blank" data-toggle="tooltip"
                           data-bs-placement="bottom"
                           title="Descargar PDF">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                        @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

<!-- Modal PAGO PUNTO -->
<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
     aria-hidden="true">
    <form id="visita" action="" class="modal-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Aprobar Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Por favor llene los datos necesarios para el pago de la solicitud Nro. <span id="pago"></span></p>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            {!! Form::label('visitador', 'Forma de Pago:') !!}
                            <div class="input-group mb-3">
                                <select class="form-select" aria-label="forma_pago" id="forma_pago" name="forma_pago" required>
                                    <option value="">Seleccione la forma de pago</option>
                                    <option value="Transferencia">Transferencia.</option>
                                    <option value="Punto">Punto.</option>
                                </select>
                            </div>
                        </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('visitador', 'Codigo de Transaccion:') !!}
                                <input type="text" name="codigo_transaccion" id="codigo_transaccion" required class="form-control">
                            </div>
                        <div class="form-group col-sm-6">
                            {!! Form::label('visitador', 'Fecha de Pago:') !!}
                            <input type="date" name="fecha_pago" id="fecha_pago"  class="form-control" max="9999-12-31" required>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" data-action="APROBAR PAGO">Aprobar</button>
                </div>
            </div>
        </div>
    </form>
</div>

