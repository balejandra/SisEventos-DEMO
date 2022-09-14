<table class="table table-bordered">
    <tbody>
    <tr>
        <th  width="30%" class="bg-light">Cargo</th>
        <td> {{ $capitaniaUser->cargos->name }} </td>
    </tr>
    <tr>
        <th class="bg-light">Usuario</th>
        <td> {{ $capitaniaUser->user->email }}</td>
    </tr>
    <tr>
        <th class="bg-light">Departamento</th>
        <td> {{ $capitaniaUser->departamento->nombre }}</td>
    </tr>
    <tr>
        <th class="bg-light">Habilitado</th>
        <td>@if($capitaniaUser->habilitado ==1 ) SI @else NO @endif</td>
    </tr>
    <tr>
        <th class="bg-light">Creado</th>
        <td> {{ date_format($capitaniaUser->created_at,'d-m-Y') }}</td>
    </tr>

    </tbody>
</table>
<div class="row mt-4">
    <div class="col-md-12 text-center">
        <a href="{{route('capitaniaUsers.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
    </div>
</div>
