<div class='row'>
    <div class="d-flex flex-wrap justify-content-center">
    <table class="table table-bordered" style="width:50%;">
    <tbody>
        <tr>
            <th class="bg-light" style="width:35%">Roles permisados</th>
            <td>
                @foreach($menuRols as $Roles)

                 @if($Roles->checked!='')

                    <span class="badge badge-info">
                        {{ $Roles->name}}
                    </span>
                @endif

                @endforeach
            </td>
        </tr>
        <tr>
            <th class="bg-light" style="width:25%">Nombre</th>
            <td>{{ $menu->name }}</td>
        </tr>
        <tr>
            <th class="bg-light">Descripción</th>
            <td>{{ $menu->description }}</td>
        </tr>
        <tr>
            <th class="bg-light">Url</th>
            <td>{{ $menu->url }}</td>
        </tr>
        <tr>
            <th class="bg-light">Menú padre</th>
            <td><b>{{$parent[$menu->parent]}} </b> </td>
        </tr>
        <tr>
            <th class="bg-light">Orden</th>
            <td>{{ $menu->order }}</td>
        </tr>
        <tr>
            <th class="bg-light">Icono</th>
            <td>{{ $menu->icono }}</td>
        </tr>
        <tr>
            <th class="bg-light">Habilitado</th>
            <td>@if($menu->enabled ==1 ) SI @else NO @endif</td>
        </tr>
    </tbody>
</table>

    </div>
</div>
<div class="row mt-4">
    <div class="col-md-12 text-center">
        <a href="{{route('menus.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
    </div>
</div>
