<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
        <tr>
        <tr>
            <th class="bg-light" style="width:25%">Id</th>
            <td>{{ $auditable->id }}</td>
        </tr>
        <tr>
            <th class="bg-light">Id Usuario realizo el cambio</th>
            <td>{{ $auditable->user_id }}</td>
        </tr>
        <tr>
            <th class="bg-light">Evento</th>
            <td>{{ $auditable->event }}</td>
        </tr>
        <tr>
            <th class="bg-light">Tabla afectada</th>
            <td><b>{{ $auditable->auditable_type }}</b></td>
        </tr>
        <tr>
            <th class="bg-light">Id campo afectado</th>
            <td>{{ $auditable->auditable_id }}</td>
        </tr>
        <tr>
            <th class="bg-light">Valores anteriores</th>
            <td>{{json_encode ($auditable->old_values )}}</td>
        </tr>
        <tr>
            <th class="bg-light">Valores Nuevos</th>
            <td>{{json_encode( $auditable->new_values) }}</td>
        </tr>
        <tr>
            <th class="bg-light">Ruta origen</th>
            <td>{{ $auditable->url }}</td>
        </tr>
        <tr>
            <th class="bg-light">Dirección IP</th>
            <td>{{ $auditable->ip_address }}</td>
        </tr>
        <tr>
            <th class="bg-light">Etiquetas</th>
            <td>{{ $auditable->tags }}</td>
        </tr>
        <tr>
            <th class="bg-light">Agente de Usuario</th>
            <td>{{ $auditable->user_agent }}</td>
        </tr>
        <tr>
            <th class="bg-light">Fecha de Creación</th>
            <td>{{ date_format($auditable->created_at,'d-m-Y') }}</td>
        </tr>
        </tbody>
    </table>
</div>
<div class="row mt-4">
    <div class="col-md-12 text-center">
        <a href="{{route('auditables.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
    </div>
</div>
