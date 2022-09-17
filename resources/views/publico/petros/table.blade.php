<style>
    table.dataTable {
        margin: 0 auto;
    }
</style>
<table class="table table-striped table-bordered table-grow" id="generic-table" style="width:80%">
        <thead>
            <tr>
                <th>Id</th>
        <th>Nombre</th>
        <th>Sigla</th>
        <th>Fecha</th>
        <th>Monto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($petros as $petro)
            <tr>
                <td>{{ $petro->id }}</td>
            <td>{{ $petro->nombre }}</td>
            <td>{{ $petro->sigla }}</td>
            <td>{{ $petro->fecha }}</td>
            <td>{{ $petro->monto }}</td>
                <td>
                    @can('consultar-petros')
                        <a class="btn btn-sm btn-success" href="{{ route('petros.show', [$petro->id]) }}">
                            <i class="fa fa-search"></i>
                        </a>
                    @endcan
                    @can('editar-petros')
                        <a class="btn btn-sm btn-info" href="{{ route('petros.edit', [$petro->id]) }}">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endcan
                    @can('eliminar-petros')
                        <div class='btn-group'>
                            {!! Form::open(['route' => ['petros.destroy', $petro->id], 'method' => 'delete','class'=>'delete-form']) !!}

                            <button type="submit" class="btn btn-sm btn-danger" id="eliminar" data-mensaje="el Petro {{$petro->id}}">
                                <i class="fa fa-trash"></i></button>
                            {!! Form::close() !!}
                        </div>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
