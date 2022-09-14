

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
            <th class="bg-light">Unidad Inmediata Superior</th>
            <td> {{$capitania->unidad_inmediata_superior}}</td>
        </tr>


    </tbody>
</table>
    </dic>
    <dic class="col-md-2"></dic>
</div>

    <div class="row mt-4">
        <div class="col-md-12 text-center">
            <a href="{{route('capitanias.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
        </div>
    </div>
</div>

<div class="col-md-2"></div>

</div>

