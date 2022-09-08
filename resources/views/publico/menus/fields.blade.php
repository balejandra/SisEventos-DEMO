<!-- Enabled Field -->
<div class="form-group row">
    {!! Form::label('name', 'Roles:') !!}


    @foreach ($roles as $key => $item)
        <div class="form-check form-switch col-sm-6 ">
                <input class="form-check-input" type="checkbox" name="role[]" id='role' value="{{$item->id}}"  style="margin-left: auto;" {{$item->checked}}>
                <label class="form-check-label" for="flexSwitchCheckDefault" style="margin-inline-start: 30px;">{{$item->name}} </label>
        </div>
    @endforeach
</div>
<!-- Name Field -->
<div class="form-group row">
    <div class="form-group col-sm-6">
        {!! Form::label('name', 'Nombre:') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Description Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('description', 'Descripción:') !!}
        {!! Form::text('description', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    <!-- Url Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('url', 'URL:') !!}
        {!! Form::text('url', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('parent', 'Menú padre:') !!}
        {!! Form::select('parent', $parent, null, ['class' => 'form-control','placeholder' => 'Seleccione un padre']) !!}
    </div>
</div>
<div class="form-group row">
<!-- Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order', 'Orden:') !!}
    {!! Form::number('order', null, ['class' => 'form-control']) !!}
</div>

<!-- Icono Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icono', 'Icono:') !!}
    {!! Form::text('icono', null, ['class' => 'form-control']) !!}
</div>
</div>
<!-- Enabled Field -->
<div class="form-group col-sm-6">
    {!! Form::label('enabled', 'Habilitado:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('enabled', 0) !!}
        {!! Form::checkbox('enabled', '1', true) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="row form-group">
<div class="col text-center">
<a href= "{{route('menus.index')}}   " class="btn btn-ligth btncancelarZarpes ">Cancelar</a>

</div>
<div class="col text-center">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>

</div>

