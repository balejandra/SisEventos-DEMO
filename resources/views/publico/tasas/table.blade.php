<style>
    table.dataTable {
        margin: 0 auto;
    }
</style>
<table class="table table-striped table-bordered table-grow" id="generic-table" style="width:80%">
        <thead>
            <tr>
                <th>Id</th>
        <th>Tipo Actividad</th>
        <th>Valor</th>
        <th>Parametro</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tasas as $tasa)
            <tr>
                <td>{{ $tasa->id }}</td>
            <td>{{ $tasa->tipo_actividad }}</td>
            <td>{{ $tasa->valor }}</td>
            <td>{{ $tasa->parametro }}</td>
                <td>
                    {!! Form::open(['route' => ['tasas.destroy', $tasa->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tasas.show', [$tasa->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('tasas.edit', [$tasa->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
