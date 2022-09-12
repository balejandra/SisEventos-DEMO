<!-- Tipo Actividad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_actividad', 'Tipo Actividad:') !!}
    {!! Form::text('tipo_actividad', null, ['class' => 'form-control']) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::number('valor', null, ['class' => 'form-control']) !!}
</div>

<!-- Parametro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parametro', 'Parametro:') !!}
    {!! Form::text('parametro', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('tasas.index') }}" class="btn btn-secondary">Cancel</a>
</div>
