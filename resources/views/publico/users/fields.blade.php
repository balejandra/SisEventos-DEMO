<!-- Email Field -->
<div class="row">
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    <input type="email"
           class="form-control {{ $errors->has("email")?"is-invalid":"" }}"
           name="email" value="{{$user->email}}" placeholder="Email" required>
    @error('email')
    <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<!-- Nombres Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombres', 'Nombres:') !!}
    {!! Form::text('nombres', null, ['class' => 'form-control','required']) !!}
</div>
</div>

<div class="row">
<div class="form-group col-sm-6">
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="password_change" id="password_change" value="password"
               onclick="cambiar()">
        <label class="form-check-label" for="natural">
            Cambiar Contraseña
        </label>
    </div>

</div>
</div>
<div  id="password-div" style="display: none">
<!-- Password Field -->
    <div class="row">
    <div class="form-group col-sm-6"  >
        {!! Form::label('password', 'Contraseña:') !!}
        <input type="password" class="form-control {{ $errors->has('password')?'is-invalid':''}}" id="password" name="password">
        @error('password')
        <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-sm-6"  >
        {!! Form::label('password', 'Confirmar Contraseña:') !!}
        <input type="password" name="password_confirmation" class="form-control"
            placeholder={{ __('Confirm Password') }}>
    </div>
    </div>

</div>

<div class="row">
<div class="form-group col-sm-6">
    {!! Form::label('role id', 'Rol asignado:') !!}
    {!! Form::select('roles', $roles, null, ['class' => 'roles form-control custom-select',
'placeholder' => 'Puede asignar un Rol...','onchange="requeridos();"', 'title'=>'Si no encuentra su Rol en el listado, asegúrese que el mismo tenga un Menú asociado ']) !!}
    <small class="text-muted fw-lighter">Si no encuentra su Rol en el listado, asegúrese que el mismo tenga un Menú asociado</small>
</div>
</div>


<!-- Submit Field -->

<div class="row form-group  mt-4">
    <div class="col text-center">
        <a href="{{route('users.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
    </div>
    <div class=" col text-center">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
<input type="text" name="tipo_usuario" value="Usuario Interno" hidden>
