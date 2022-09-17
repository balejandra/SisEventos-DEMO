<div class="row">
<!-- Nombre Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre', 'Nombre:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
</div>

<!-- Sigla Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sigla', 'Sigla:') !!}
    {!! Form::text('sigla', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::date('fecha', null, ['id'=>'fecha_petro','class' => 'form-control']) !!}
</div>


<!-- Monto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('monto', 'Monto:') !!}
    {!! Form::number('monto', null, ['class' => 'form-control','step'=>'any']) !!}
</div>
</div>
<!-- Submit Field -->
        <div class="row form-group  mt-4">
            <div class="col text-center">
                <a href="{{route('petros.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
            </div>
            <div class=" col text-center">
                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
