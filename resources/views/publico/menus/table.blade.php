<table class="table table-bordered table-striped " id="generic-table" style="width:100%">
    <thead>

        <th>Id</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Ruta</th>
        <th>Padre</th>
        <th>Orden</th>
        <th>Icono</th>
        <th>Habilitado</th>
        <th>Acciones</th>
    </thead>
    <tbody>
    @foreach($menuspadre as $menu)
        <tr>
            <td>{{ $menu->id }}</td>
            <td>{{ $menu->name }}</td>
            <td>{{ $menu->description }}</td>
            <td>{{ $menu->url }}</td>
                <td>Menú Padre</td>
            <td>{{ $menu->order }}</td>
            <td>{{ $menu->icono }}</td>
            @if ( $menu->enabled ==1)
                <td>SI</td>
            @else
            <td>NO</td>
            @endif
            <td>
                @can('consultar-menu')
                <a class="btn btn-sm btn-success" href="  {{ route('menus.show', [$menu->id]) }}">
                    <i class="fa fa-search"></i>
                </a>
                @endcan
                @can('editar-menu')
                <a class="btn btn-sm btn-info" href=" {{ route('menus.edit', [$menu->id]) }}">
                    <i class="fa fa-edit"></i>
                </a>
                @endcan
                 @can('eliminar-menu')
                <div class='btn-group'>
                    {!! Form::open(['route' => ['menus.destroy', $menu->id], 'method' => 'delete','class'=>'delete-form']) !!}

                    <button type="submit" class="btn btn-sm btn-danger" id="eliminar" data-mensaje="el menú {{$menu->name}}">
                        <i class="fa fa-trash"></i></button>
                    {!! Form::close() !!}
                </div>
                @endcan

            </td>
        </tr>
    @endforeach
    @foreach ($menushijos as $menuh)
        <tr>
            <td>{{ $menuh->id }}</td>
            <td>{{ $menuh->name }}</td>
            <td>{{ $menuh->description }}</td>
            <td>{{ $menuh->url }}</td>
            <td>{{ $parent[$menuh->parent] }}</td>
            <td>{{ $menuh->order }}</td>
            <td>{{ $menuh->icono }}</td>
            @if ( $menuh->enabled ==1)
                <td>SI</td>
            @else
                <td>NO</td>
            @endif
            <td>
                @can('consultar-menu')
                    <a class="btn btn-sm btn-success" href="  {{ route('menus.show', [$menuh->id]) }}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan
                @can('editar-menu')
                    <a class="btn btn-sm btn-info" href=" {{ route('menus.edit', [$menuh->id]) }}">
                        <i class="fa fa-edit"></i>
                    </a>
                @endcan
                @can('eliminar-menu')
                    <div class='btn-group'>
                        {!! Form::open(['route' => ['menus.destroy', $menuh->id], 'method' => 'delete','class'=>'delete-form']) !!}

                        <button type="submit" class="btn btn-sm btn-danger" id="eliminar" data-mensaje="el menú {{$menuh->name}}">
                            <i class="fa fa-trash"></i></button>
                        {!! Form::close() !!}
                    </div>
                @endcan

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
