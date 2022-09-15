<table class="table table-striped table-bordered display2" style="width:100%">
        <thead>
            <tr>
                <th>Nro Solicitud</th>
                <th>Solicitante</th>
                <th>Nombre Evento</th>
                <th>Fecha</th>
                <th>Lugar</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($autorizacionEventos as $autorizacionEvento)
            <tr>
            <td>{{ $autorizacionEvento->nro_solicitud }}</td>
            <td>{{ $autorizacionEvento->user_id }}</td>
            <td>{{ $autorizacionEvento->nombre_evento }}</td>
            <td>{{ $autorizacionEvento->fecha }}</td>
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
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
