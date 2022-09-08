<table class="table">
    <tbody>
    <tr>
        <th class="bg-light">Uab Mínimo</th>
        <td>{{ $tablaMando->UAB_minimo }}</td>
    </tr>
    <tr>
        <th class="bg-light">Uab Máximo</th>
        <td>{{ $tablaMando->UAB_maximo }}</td>
    </tr>
    <tr>
        <th class="bg-light" style="width:25%">Cant Tripulantes</th>
        <td>{{ $tablaMando->cant_tripulantes }}</td>
    </tr>

    <tr>
        <th class="bg-light">Creado</th>
        <td>{{ date_format($tablaMando->created_at,'d-m-Y') }}</td>
    </tr>
    </tbody>
</table>
<table class="table">

    <thead>
    <th>Cargo</th>
    <th>Titulacion Mínima</th>
    <th>Titulacion Máxima</th>
    </thead>
    <tbody>
    @forelse($tablaMando->cargotablamandos as $cargotablamando)

        <tr>
            <td>
                <span class="badge badge-info">{{$cargotablamando->cargo_desempena}} </span>
            <td>
                <span class="badge badge-info">{{$cargotablamando->titulacion_aceptada_minima}} </span>
            </td>
            <td>
                <span class="badge badge-info">{{$cargotablamando->titulacion_aceptada_maxima}} </span>
            </td>
            @empty
                <span class="badge badge-danger">Sin Cargos asignados</span>
        </tr>

    @endforelse
    </tbody>
</table>
<div class="row mt-4">
    <div class="col-md-12 text-center">
        <a href="{{route('tablaMandos.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
    </div>
</div>
