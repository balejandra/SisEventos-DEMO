<!-- Nombre Field -->
<div class="row ">
<div class="col-lg-4 col-md-3 "></div>
<div class="col-lg-4 col-md-6 col-sm-12">

<div class="row border p-3">
    <div class="form-group col-lg-12 col-sm-6">
        {!! Form::label('nombre', 'Nombre:') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Submit Field -->
    <div class="form-group col text-center">

        <a href="{{ route('status.index') }}" class="btn  btncancelarZarpes">Cancelar</a>
    </div>
    <div class="form-group col text-center">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}

    </div>
</div>

</div>
<div class="col-lg-4 col-md-3"></div>
</div>


