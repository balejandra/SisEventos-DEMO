<div class="table-responsive-sm">
    <table class="table table-striped" id="autorizacionEventos-table">
        <thead>
            <tr>
                <th>Id</th>
        <th>Nro Solicitud</th>
        <th>User Id</th>
        <th>Nombre Evento</th>
        <th>Fecha</th>
        <th>Horario</th>
        <th>Lugar</th>
        <th>Cant Organizadores</th>
        <th>Cant Asistentes</th>
        <th>Nombre Contacto</th>
        <th>Telefono Contacto</th>
        <th>Email Contacto</th>
        <th>Vigencia</th>
        <th>Status Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($autorizacionEventos as $autorizacionEvento)
            <tr>
                <td>{{ $autorizacionEvento->id }}</td>
            <td>{{ $autorizacionEvento->nro_solicitud }}</td>
            <td>{{ $autorizacionEvento->user_id }}</td>
            <td>{{ $autorizacionEvento->nombre_evento }}</td>
            <td>{{ $autorizacionEvento->fecha }}</td>
            <td>{{ $autorizacionEvento->horario }}</td>
            <td>{{ $autorizacionEvento->lugar }}</td>
            <td>{{ $autorizacionEvento->cant_organizadores }}</td>
            <td>{{ $autorizacionEvento->cant_asistentes }}</td>
            <td>{{ $autorizacionEvento->nombre_contacto }}</td>
            <td>{{ $autorizacionEvento->telefono_contacto }}</td>
            <td>{{ $autorizacionEvento->email_contacto }}</td>
            <td>{{ $autorizacionEvento->vigencia }}</td>
            <td>{{ $autorizacionEvento->status_id }}</td>
                <td>
                    {!! Form::open(['route' => ['autorizacionEventos.destroy', $autorizacionEvento->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('autorizacionEventos.show', [$autorizacionEvento->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('autorizacionEventos.edit', [$autorizacionEvento->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>