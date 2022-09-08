<table class="table">
    <tbody>
    <tr>
        <th class="bg-light">ID</th>
        <td>{{$equipo->id}}</td>
    </tr>
    <tr>
        <th class="bg-light">Nombre</th>
        <td>{{ $equipo->equipo }}</td>
    </tr>
    <tr>
        <th class="bg-light">Cantidad</th>
        @if ($equipo->cantidad===true)
            <td>Verdadero</td>
        @else
            <td>Falso</td>
        @endif
    </tr>
    <tr>
        <th class="bg-light">Otros</th>
        <td>{{ $equipo->otros }}</td>
    </tr>


    </tbody>
</table>

<div class="row">
    <div class="form-group text-center col-sm-12">
        <a href="{{ route('equipos.index') }}" class="btn btn-light btncancelarZarpes">Cancelar</a>
    </div>
</div>

