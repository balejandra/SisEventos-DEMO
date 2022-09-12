<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $tasa->id }}</p>
</div>

<!-- Tipo Actividad Field -->
<div class="form-group">
    {!! Form::label('tipo_actividad', 'Tipo Actividad:') !!}
    <p>{{ $tasa->tipo_actividad }}</p>
</div>

<!-- Valor Field -->
<div class="form-group">
    {!! Form::label('valor', 'Valor:') !!}
    <p>{{ $tasa->valor }}</p>
</div>

<!-- Parametro Field -->
<div class="form-group">
    {!! Form::label('parametro', 'Parametro:') !!}
    <p>{{ $tasa->parametro }}</p>
</div>

