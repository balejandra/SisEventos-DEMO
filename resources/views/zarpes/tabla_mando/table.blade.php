<table class="table table-striped table-bordered" id="generic-table" style="width:100%">
    <thead>
        <th>UAB mínimo</th>
        <th>UAB máximo</th>
        <th>Tripulantes</th>
        <th>Cargo</th>
        <th>Titulación Mínima</th>
        <th  style="width: max-content">Acciones</th>
    </thead>
    <tbody>
    @foreach($tablaMandos as $tablaMando)
        <tr>
            <td>{{ $tablaMando->UAB_minimo }}</td>
            <td>{{ $tablaMando->UAB_maximo }}</td>
            <td>{{ $tablaMando->cant_tripulantes }}</td>
            <td>
            @forelse($tablaMando->cargotablamandos as $cargotablamando)
                <span class="badge badge-info">{{$cargotablamando->cargo_desempena}} </span>
            @empty
                <span class="badge badge-danger">Sin Cargos asignados</span>
            @endforelse
            </td>
            <td  style="width: 30%">
                @forelse($tablaMando->cargotablamandos as $cargotablamando)
                    <span class="badge badge-info">{{$cargotablamando->titulacion_aceptada_minima}} </span>
                @empty
                    <span class="badge badge-danger">Sin Cargos asignados</span>
                @endforelse
            </td>
            <td>
                @can('consultar-mando')
                    <a class="btn btn-sm btn-success" href="  {{ route('tablaMandos.show', [$tablaMando->id]) }}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan
                @can('editar-mando')
                    <a class="btn btn-sm btn-info" href=" {{ route('tablaMandos.edit', [$tablaMando->id]) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                @endcan
                @can('eliminar-mando')
                    <div class='btn-group'>
                        {!! Form::open(['route' => ['tablaMandos.destroy', $tablaMando->id], 'method' => 'delete','class'=>'delete-form']) !!}

                        <button type="submit" class="btn btn-sm btn-danger" id="eliminar" data-mensaje="la tabla de mandos {{$tablaMando->id}}">
                            <i class="fa fa-trash"></i></button>
                        {!! Form::close() !!}
                    </div>
                @endcan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
