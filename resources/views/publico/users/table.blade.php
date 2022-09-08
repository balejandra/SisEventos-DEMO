<style>
    table.dataTable {
        margin: 0 auto;
    }
</style>
<table class="table table-striped table-bordered table-grow" id="generic-table" style="width:90%">
    <thead>
        <th>Id</th>
        <th>Email</th>
        <th>Nombres</th>
        <th width="15%">Tipo de Usuario</th>
        <th>Acciones</th>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->nombres }}</td>
            <td>{{ $user->tipo_usuario }}</td>
            <td>
                @can('consultar-usuario')
                    <a class="btn btn-sm btn-success" href="  {{ route('users.show', [$user->id]) }}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan
                @can('editar-usuario')
                    <a class="btn btn-sm btn-info" href=" {{ route('users.edit', [$user->id]) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                @endcan
                @can('eliminar-usuario')
                    <div class='btn-group'>
                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete','class'=>'delete-form']) !!}

                        <button type="submit" class="btn btn-sm btn-danger" id="eliminar" data-mensaje="el usuario {{$user->nombres}}">
                            <i class="fa fa-trash"></i></button>
                        {!! Form::close() !!}
                    </div>
                @endcan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
