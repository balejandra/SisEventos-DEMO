<table class="table table-striped table-bordered compact display" style="width:100%">
    <thead>
    <tr>
        <th data-priority="1">Nro Solicitud</th>
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
    @foreach($permisoZarpes as $permisoZarpe)
        <tr>
            <td>{{ $permisoZarpe->nro_solicitud }}</td>
            <td>{{ $permisoZarpe->created_at }}</td>
            <td>{{ $permisoZarpe->user->nombres }} {{ $permisoZarpe->user->apellidos }}</td>
            <td>{{ $permisoZarpe->bandera }}</td>
            <td>{{ $permisoZarpe->matricula }}</td>
            <td>{{ $permisoZarpe->tipo_zarpe->nombre }}</td>
            @if ($permisoZarpe->status->id==1)
                <td class="text-success">{{ $permisoZarpe->status->nombre}} </td>
            @elseif($permisoZarpe->status->id==2)
                <td class="text-danger">{{ $permisoZarpe->status->nombre}} </td>
            @elseif($permisoZarpe->status->id==3)
                <td class="text-warning">{{ $permisoZarpe->status->nombre}} </td>
            @elseif($permisoZarpe->status->id==4)
                <td class="text-muted">{{ $permisoZarpe->status->nombre}} </td>
            @elseif($permisoZarpe->status->id==5)
                <td class="text-primary">{{ $permisoZarpe->status->nombre}} </td>
            @elseif($permisoZarpe->status->id==7)
                <td><span class="text-danger bg-dark">{{$permisoZarpe->status->nombre}}</span></td>
            @elseif($permisoZarpe->status->id==6)
                <td style="color: #fd7e14">{{$permisoZarpe->status->nombre}}</td>
            @elseif($permisoZarpe->status->id==14)
                <td style="color: green">{{$permisoZarpe->status->nombre}}</td>
            @else
                <td>{{ $permisoZarpe->status->nombre}} </td>
            @endif
            <td>
                @can('consultar-zarpe')
                    <a class="btn btn-sm btn-primary"
                       href=" {{route('permisoszarpes.show',$permisoZarpe->id)}}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan
                    @can('informar-navegacion')
                    @if(($permisoZarpe->status->id=='1') && (date_format($permisoZarpe->fecha_hora_salida,'Y-m-d H:i:s')<=(date('Y-m-d H:i:s'))))

                            <a class="btn btn-sm btn-warning confirmation"
                               data-route=" {{route('status',[$permisoZarpe->id,'navegando',$permisoZarpe->establecimiento_nautico_id])}}" data-toggle="tooltip"
                               data-bs-placement="bottom" data-action="INFORMAR NAVEGACION de" title="Informar Navegacion">
                                <i class="fas fa-water"></i>
                            </a>

                    @endif
                    @endcan
                    @can('informar-arribo')
                        @if ($permisoZarpe->status->id==5)
                            <a class="btn btn-sm btn-warning confirmation"
                               data-route="{{route('status',[$permisoZarpe->id,'cerrado',0])}}" data-toggle="tooltip"
                               data-bs-placement="bottom" title="Informar Arribo" data-action="INFORMAR ARRIBO de" >
                                <i class="fas fa-anchor"></i>
                            </a>
                        @endif
                    @endcan
                    @can('anular-zarpeUsuario')
                        @if ($permisoZarpe->status->id==1)
                            <a class="btn btn-sm btn-danger confirmation"
                               data-route="{{route('status',[$permisoZarpe->id,'anular-usuario',0])}}" data-toggle="tooltip"
                               data-bs-placement="bottom" title="Anular Solicitud" data-action="ANULAR" >
                                <i class="fas fa-window-close"></i>
                            </a>
                            @endif
                        @endcan
                    @if (($permisoZarpe->status->id==1)||($permisoZarpe->status->id==4)||($permisoZarpe->status->id==5))
                        <a class="btn btn-sm btn-dark"
                           href="{{route('zarpepdf',$permisoZarpe->id)}}" target="_blank" data-toggle="tooltip"
                           data-bs-placement="bottom" title="Descargar PDF">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
