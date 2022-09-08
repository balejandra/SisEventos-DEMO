<table class="table table-striped table-bordered" id="generic-table" style="width:100%">
    <thead>
    <tr>
        <th>Cargo</th>
        <th>Usuario</th>
        <th>Capitanía</th>
        <th>Habilitado</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>

    @foreach($capitaniaUsers as $capitaniaUser)
        <tr>
            <td>{{ $capitaniaUser->cargos->name }}</td>
            <td>{{ $capitaniaUser->user->email}}</td>
            <td>{{ $capitaniaUser->capitania->nombre }}
        @if (isset($capitaniaUser->establecimientos->nombre))<br>
           Establecimiento Náutico: {{ $capitaniaUser->establecimientos->nombre }}
            @endif</td>
            @if ( $capitaniaUser->habilitado ==true)
                <td>SI</td>
            @else
                <td>NO</td>
            @endif
            <td>
                @can('consultar-usuarios-capitanias')
                    <a class="btn btn-sm btn-success" href="  {{ route('capitaniaUsers.show', [$capitaniaUser->id]) }}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan
                @can('editar-usuarios-capitanias')
                    <a class="btn btn-sm btn-info" href=" {{ route('capitaniaUsers.edit', [$capitaniaUser->id]) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                @endcan
                @can('eliminar-usuarios-capitanias')

                    <div class='btn-group'>
                        {!! Form::open(['route' => ['capitaniaUsers.destroy', $capitaniaUser->id], 'method' => 'delete','class'=>'delete-form']) !!}
                        <button type="submit" class="btn btn-sm btn-danger" id="eliminar" data-mensaje="el Usuario {{$capitaniaUser->user->email}}">
                            <i class="fa fa-trash"></i></button>
                        {!! Form::close() !!}
                    </div>
                @endcan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
