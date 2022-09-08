<style>
    table.dataTable {
        margin: 0 auto;
    }
</style>
<table class="table table-striped table-bordered table-grow" id="generic-table" style="width:80%">
    <thead>
    <tr>
        <th>ID</th>
        <th>Equipo</th>
        <th>Cantidad</th>
        <th>Otros</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($equipos as $equipo)
        <tr>
            <td>{{ $equipo->id }}</td>
            <td>{{ $equipo->equipo }}</td>
            @if ($equipo->cantidad===true)
                <td>Verdadero</td>
            @else
                <td>Falso</td>
            @endif
            <td>{{ $equipo->otros }}</td>
            <td>
                @can('consultar-equipo')
                    <a class="btn btn-sm btn-success" href="  {{ route('equipos.show', [$equipo->id]) }}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan
                @can('editar-equipo')
                    <a class="btn btn-sm btn-info" href=" {{ route('equipos.edit', [$equipo->id]) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                @endcan
                @can('eliminar-equipo')
                    <div class='btn-group'>
                        {!! Form::open(['route' => ['equipos.destroy', $equipo->id], 'method' => 'delete','class'=>'delete-form']) !!}

                        <button type="submit" class="btn btn-sm btn-danger" id="eliminar" data-mensaje="el equipo {{$equipo->equipo}}">
                            <i class="fa fa-trash"></i></button>
                        {!! Form::close() !!}
                    </div>
                @endcan

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
