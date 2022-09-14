<div class="row" >
    <!-- Nombre Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('nombre', 'Nombre:') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Sigla Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('sigla', 'Sigla:') !!}
        {!! Form::text('sigla', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-4">
        {!! Form::label('unidad_inmediata_superior', 'Unidad Inmediata Superior:') !!}
        {!! Form::text('unidad_inmediata_superior', null, ['class' => 'form-control ']) !!}
    </div>
</div>

    <div class="row form-group  mt-4">
        <div class="col text-center">
            <a href="{{route('capitanias.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
        </div>
        <div class=" col text-center">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>
