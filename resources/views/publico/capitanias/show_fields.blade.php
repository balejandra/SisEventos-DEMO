

<div class="row">
    <dic class="col-md-2"></dic>
    <dic class="col-md-8">

<table class="table table-bordered">
    <tbody>
        <tr>
            <th width="30%" class="bg-light">Nombre</th>
            <td> {{$capitania->nombre}} </td>
        </tr>
        <tr>
            <th class="bg-light">Siglas</th>
            <td> {{$capitania->sigla}}</td>
        </tr>
        <tr>
            <th class="bg-light">Capitán asignado</th>
            <td>

                @if(count($capitan)>0)
                       {{$capitan[0]->nombres}} {{$capitan[0]->apellidos}}

                 @endif

                </td>
        </tr>
        <tr>
            <th class="bg-light">Correo Capitán asignado</th>
            <td>
                @if(count($capitan)>0)
                    {{$capitan[0]->email}}
                 @endif
                  </td>
        </tr>

    </tbody>
</table>
    </dic>
    <dic class="col-md-2"></dic>
</div>

<div class="row d-flex justify-content-center">
<div class="col-md-2"></div>
<div class="text-center col-md-8" >
<table id="table-paginate" class="table table-bordered">
    <thead>
        <tr>
            <th colspan="2" class="bg-light text-center">Coordenadas</th>
        </tr>
        <tr class="bg-light">
            <th>Latitud</th>
            <th>Longitud</th>
        </tr>
    </thead>
    <tbody>
        @forelse($coords as $coord)
        <tr>
            <td>{{ $coord->latitud }}</td>
            <td>{{ $coord->longitud }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">Sin coordenadas asignadas</td>
        </tr>
        @endforelse
    </tbody>
</table>
    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <a href="{{route('capitanias.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
        </div>
    </div>
</div>

<div class="col-md-2"></div>

</div>

