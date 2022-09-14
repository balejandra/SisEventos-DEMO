<style>
    table.dataTable {
        margin: 0 auto;
    }
</style>
<table class="table table-striped table-bordered table-grow" id="generic-table" style="width:80%">
        <thead>
            <tr>
                <th>Id</th>
        <th>Tipo Actividad</th>
        <th>Valor</th>
        <th>Parametro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tasas as $tasa)
            <tr>
                <td>{{ $tasa->id }}</td>
            <td>{{ $tasa->tipo_actividad }}</td>
            <td>{{ $tasa->valor }}</td>
            <td>{{ $tasa->parametro }}</td>
                <td>
                    @can('consultar-tasas')
                        <a class="btn btn-sm btn-success" href="{{ route('tasas.show', [$tasa->id]) }}">
                            <i class="fa fa-search"></i>
                        </a>
                    @endcan
                    @can('editar-tasas')
                        <a class="btn btn-sm btn-info" href="{{ route('tasas.edit', [$tasa->id]) }}">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endcan
                    @can('eliminar-tasas')
                        <div class='btn-group'>
                            {!! Form::open(['route' => ['tasas.destroy', $tasa->id], 'method' => 'delete','class'=>'delete-form']) !!}

                            <button type="submit" class="btn btn-sm btn-danger" id="eliminar" data-mensaje="la Tasa {{$tasa->id}}">
                                <i class="fa fa-trash"></i></button>
                            {!! Form::close() !!}
                        </div>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
