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
        {!! Form::label('capitanes', 'Capitán:') !!}
        {!! Form::select('user',$user, null, ['class' => 'form-control custom-select', 'disabled'=>'true']) !!}
    </div>
</div>


{!! Form::label('coordenadas', 'Coordenadas:') !!}
@php($var=0)
<div>
@forelse($coordenadas as $key =>$coord)
<div>
    {!! Form::hidden('deletes[]',  null, ['class' => 'form-control', 'id'=>'deletes'. $key]) !!}
</div>
<div class="row" id="coordenadas{{$key}}">
    <!-- latitud Field -->
    <div>
        {!! Form::hidden('ids[]',  $coord->id, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-5">
        @if ($var==0)
        {!! Form::label('Latitud', 'Latitud:') !!}
         @endif
        {!! Form::text('latitud[]', $coord->latitud, ['class' => 'form-control']) !!}
    </div>
    <!-- longitud Field -->
    <div class="form-group col-sm-5">
        @if ($var==0)
        {!! Form::label('longitud', 'Longitud:') !!}
         @endif
        {!! Form::text('longitud[]', $coord->longitud , ['class' => 'form-control']) !!}
    </div>

    @if ($var==0)
        @php($var++)
        <div class="form-group col-sm-2 pt-4">
        {!! Form::button('Agregar otras', ['class' => 'btn btn-success', 'onclick' => 'agregarCoordenadas()']) !!}
        </div>
    @else
        <div class="form-group col-sm-2 ">

        {!! Form::button('Borrar', ['class' => 'btn btn-danger', 'onclick' => 'eliminarCoordenadas(this.id, '.$coord->id.')', 'id'=>$key]) !!}

        </div>
    @endif
</div>

@empty
<div class="row" >
    <!-- latitud Field -->

    <div class="form-group col-sm-5">
        {!! Form::label('Latitud', 'Latitud:') !!}
        {!! Form::text('latitud[]', null, ['class' => 'form-control']) !!}
    </div>
    <!-- longitud Field -->
    <div class="form-group col-sm-5">
        {!! Form::label('longitud', 'Longitud:') !!}
        {!! Form::text('longitud[]', null , ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-2 pt-4">
        {!! Form::button('Agregar otras', ['class' => 'btn btn-success', 'onclick' => 'agregarCoordenadas()']) !!}
    </div>

</div>

@endforelse
<div  id="coords" data-cant='1'>

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
