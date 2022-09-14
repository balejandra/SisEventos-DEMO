@push('scripts')
    <script src="{{asset('js/buscador.js')}}"></script>
@endpush
<!-- Cargo Field -->
<div class="row">
<div class="form-group col-md-4 col-sm-12">
    {!! Form::label('cargo', 'Cargo:') !!}
    {!! Form::select('cargo_id',$roles, null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione un cargo','onchange="cargoCapitaniaUser();"']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-md-4 col-sm-12">
    {!! Form::label('email_user', 'Email del Usuario:') !!}
    {!! Form::text('email_user',null, null, ['id'=>'email_user','class' => 'form-control','placeholder' => 'Seleccione un usuario']) !!}
    <input type="text" name="user_id" id="user_id" hidden>
</div>
<div class="col-md-4 col-sm-12">
    {!! Form::label('user_id', 'Nombres y Apellidos:') !!}
    <input type="text" id="nombres" class="form-control" disabled>
</div>
<!-- Capitania Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('departamento_id', 'Departamento:') !!}
    {!! Form::select('departamento_id', $capitania, null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione un Departamento','onclick="EstablecimientoUser();"']) !!}
</div>
    <div class="form-group mt-4 col-sm-2">
        <label class="checkbox-inline">
            {!! Form::hidden('habilitado', 0) !!}
            {!! Form::checkbox('habilitado', '1',true) !!}
        </label>
        {!! Form::label('habilitado', 'Habilitado') !!}
    </div>
<!-- Submit Field -->
    <div class="row form-group  mt-4">
        <div class="col text-center">
            <a href="{{route('capitaniaUsers.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
        </div>
        <div class="col text-center">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>
