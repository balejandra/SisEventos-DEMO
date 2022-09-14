<div class="row">
    <!-- Tipo Actividad Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_actividad', 'Tipo Actividad:') !!}
    {!! Form::text('tipo_actividad', null, ['class' => 'form-control']) !!}
</div>

<!-- Valor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('valor', 'Valor:') !!}
    {!! Form::number('valor', null, ['class' => 'form-control','step'=>'any']) !!}
</div>

<!-- Parametro Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parametro', 'Parametro:') !!}
    {!! Form::text('parametro', null, ['class' => 'form-control']) !!}
</div>
</div>
<!-- Submit Field -->
<div class="row form-group  mt-4">
    <div class="col text-center">
        <a href="{{route('tasas.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
    </div>
    <div class=" col text-center">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
