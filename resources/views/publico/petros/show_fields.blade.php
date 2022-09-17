<table class="table">
    <tbody>
    <tr>
        <th class="bg-light">ID</th>
        <td>{{ $petro->id }}</td>
    </tr>
    <tr>
        <th class="bg-light">Nombre</th>
        <td>{{ $petro->nombre }}</td>
    </tr>
    <tr>
        <th class="bg-light">Sigla</th>
        <td>{{ $petro->sigla }}</td>
    </tr>
    <tr>
        <th class="bg-light">Fecha</th>
        <td>{{ $petro->fecha }}</td>
    </tr>
<tr>
    <th class="bg-light">Monto</th>
    <td>{{ $petro->monto }}</td>
</tr>
    </tbody>
</table>
<div class="row">
    <div class="form-group text-center col-sm-12">
        <a href="{{ route('petros.index') }}" class="btn btn-light btncancelarZarpes">Cancelar</a>
    </div>
</div>

