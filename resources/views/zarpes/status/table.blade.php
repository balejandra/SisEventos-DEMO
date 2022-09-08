<style>
    table.dataTable {
        margin: 0 auto;
    }
</style>
<table class="table table-striped table-bordered table-grow" id="generic-table" style="width:60%">
    <thead>
    <th>ID</th>
    <th>Nombre</th>
    <th>Acciones</th>
    </thead>
    <tbody>
    @foreach($statuses as $status)
        <tr>
            <td>{{ $status->id }}</td>
            <td>{{ $status->nombre }}</td>
            <td>
                @can('consultar-status')
                    <a class="btn btn-sm btn-success" href="  {{ route('status.show', [$status->id]) }}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan
                @can('editar-status')
                    <a class="btn btn-sm btn-info" href=" {{ route('status.edit', [$status->id]) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                @endcan
                @can('eliminar-status')
                    <div class='btn-group'>
                        {!! Form::open(['route' => ['status.destroy', $status->id], 'method' => 'delete','class'=>'delete-form']) !!}

                        <button type="submit" class="btn btn-sm btn-danger" id="eliminar" data-mensaje="el estatus {{$status->nombre}}">
                            <i class="fa fa-trash"></i></button>
                        {!! Form::close() !!}
                    </div>
                @endcan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
