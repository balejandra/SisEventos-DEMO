<style>
    table.dataTable {
        margin: 0 auto;
    }
</style>

    <table class="table table-striped table-bordered table-grow" id="generic-table" style="width:70%">
        <thead>
        <tr>
            <th >Nombre</th>
            <th>RIF</th>
            <th>Capitanía</th>
            <th width="20%">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($estNautico as $estNaut)
            <tr>
                <td>{{ $estNaut->nombre }}</td>
                <td>{{ $estNaut->RIF }}</td>
                <td>{{ $estNaut->capitania }}</td>
                <td>
                    @can('consultar-establecimientoNautico')
                        <a class="btn btn-sm btn-success" href="  {{ route('establecimientosNauticos.show', [$estNaut->id]) }}">
                            <i class="fa fa-search"></i>
                        </a>
                    @endcan
                    @can('editar-establecimientoNautico')
                        <a class="btn btn-sm btn-info" href=" {{ route('establecimientosNauticos.edit', [$estNaut->id]) }}">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endcan
                    @can('eliminar-establecimientoNautico')
                        <div class='btn-group'>
                            {!! Form::open(['route' => ['establecimientosNauticos.destroy', $estNaut->id], 'method' => 'delete','class'=>'delete-form']) !!}

                            <button type="submit" class="btn btn-sm btn-danger" id="eliminar" data-mensaje="el establecimiento {{$estNaut->nombre}}">
                                <i class="fa fa-trash"></i></button>
                            {!! Form::close() !!}
                        </div>
                @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
