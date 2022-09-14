<table class="table">
    <tbody>
    <tr>
        <th class="bg-light">ID</th>
        <td>{{ $tasa->id }}</td>
    </tr>
    <tr>
        <th class="bg-light">Tipo Actividad</th>
        <td>{{ $tasa->tipo_actividad }}</td>
    </tr>
<tr>
    <th class="bg-light">Valor</th>
    <td>{{ $tasa->valor }}</td>
</tr>
    <tr>
        <th class="bg-light">Parametro</th>
        <td>{{ $tasa->parametro }}</td>
    </tr>
    </tbody>
</table>
<div class="row">
    <div class="form-group text-center col-sm-12">
        <a href="{{ route('tasas.index') }}" class="btn btn-light btncancelarZarpes">Cancelar</a>
    </div>
</div>

