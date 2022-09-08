<!-- Uab Minimo Field -->
<div class="row">
<div class="form-group col-sm-4">
    {!! Form::label('UAB_minimo', 'UAB Mínimo:') !!}
    {!! Form::number('UAB_minimo', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Uab Maximo Field -->
<div class="form-group col-sm-4">
    {!! Form::label('UAB_maximo', 'UAB Máximo:') !!}
    {!! Form::number('UAB_maximo', null, ['class' => 'form-control','required']) !!}
</div>

<!-- Cant Tripulantes Field -->
<div class="form-group col-sm-4">
    {!! Form::label('cant_tripulantes', 'Cantidad Tripulantes:') !!}
    {!! Form::number('cant_tripulantes', null, ['class' => 'form-control','required']) !!}
</div>
</div>
<br>
@php($var=0)
<div class="row">
    <div class="form-group col-sm-3">

        {!! Form::label('Latitud', 'Cargo que desempeña:') !!}

    </div>
    <div class="form-group col-sm-3">

        {!! Form::label('longitud', 'Titulación mínima aceptada:') !!}
    </div>
    <div class="form-group col-sm-3">
        {!! Form::label('longitud', 'Titulación máxima aceptada:') !!}
    </div>
</div>
@forelse($cargos as $key =>$cargo)
    <div>
        {!! Form::hidden('deletes[]',  null, ['class' => 'form-control', 'id'=>'deletes'. $key]) !!}
    </div>
    <div class="row" id="coordenadas{{$key}}">
        <!-- latitud Field -->
        <div>
            {!! Form::hidden('ids[]',  $cargo->id, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-3">
            {!! Form::text('cargo[]', $cargo->cargo_desempena, ['class' => 'form-control']) !!}
        </div>
        <!-- longitud Field -->
        <div class="form-group col-sm-3">
            {!! Form::text('titulacion_minima[]', $cargo->titulacion_aceptada_minima , ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-sm-3">
            {!! Form::text('titulacion_maxima[]', $cargo->titulacion_aceptada_maxima , ['class' => 'form-control']) !!}
        </div>
        @if ($var==0)
            @php($var++)
            <div class="form-group col-sm-2">
                {!! Form::button('Agregar', ['class' => 'btn btn-success', 'onclick' => 'agregarCargosMandos()']) !!}
            </div>
        @else
            <div class="form-group col-sm-2 ">

                {!! Form::button('Borrar', ['class' => 'btn btn-danger', 'onclick' => 'eliminarCargosMandos(this.id, '.$cargo->id.')', 'id'=>$key]) !!}

            </div>
        @endif
    </div>
@empty
    <div class="row">
        <!-- latitud Field -->

        <div class="form-group col-sm-4">

            {!! Form::text('cargo[]', null, ['class' => 'form-control']) !!}
        </div>
        <!-- longitud Field -->
        <div class="form-group col-sm-4">

            {!! Form::text('titulacion_minima[]', null , ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-sm-4">

            {!! Form::text('titulacion_maxima[]', null , ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-sm-2">
        <!--   {!! Form::button('Agregar otras', ['class' => 'btn btn-success', 'onclick' => 'agregarCargosMandos()']) !!}-->
        </div>

    </div>

@endforelse

<div class="row">
    <div id="coords1" data-cant='1'>

    </div>
</div>



<!-- Submit Field -->
<div class="row form-group  mt-4">
    <div class="col text-center">
        <a href="{{route('tablaMandos.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
    </div>
    <div class=" col text-center">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
