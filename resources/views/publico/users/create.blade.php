@extends('layouts.app')
@section("titulo")
    Usuarios
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('users.index') !!}">Usuarios</a>
                </li>
                <li class="breadcrumb-item active1">Crear</li>
            </ol>
        </nav>
    </div>
    </header>
     <div class="container-fluid">
          <div class="animated fadeIn">
              @include('flash::message')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-user fa-lg"></i>
                                <strong>Crear Usuario</strong>
                                <div class="card-header-actions">

                                </div>
                            </div>
                            <div class="card-body">
                            <div class="row ">
                                <div class="col-md-3"></div>
                                <div class="col-md-6 border rounded p-3">


                                {!! Form::open(['route' => 'users.store']) !!}
                                <div class="row">
                                <div class="form-group col-sm-6">
                                        {!! Form::label('email', 'Email:') !!}
                                        <input type="email"
                                               class="form-control {{ $errors->has("email")?"is-invalid":"" }}"
                                               name="email"
                                               value="{{ old('email') }}" placeholder="Email" required>
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
                                <!-- Email Field -->

                                <div class="row">
                                    <!-- Password Field -->
                                    <div class="form-group col-sm-6">
                                        {!! Form::label('password', 'Contraseña:') !!}
                                        <input type="password" class="form-control {{ $errors->has('password')?'is-invalid':''}}" id="password" name="password" required>
                                        @error('password')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">

                                        {!! Form::label('password', 'Confirmar Contraseña:') !!}
                                        <input type="password" name="password_confirmation" class="form-control" required
                                               placeholder={{ __('Confirm Password') }}>
                                    </div>
                                </div>

                                    <br>

                                    <div class="form-group col-sm-6">
                                        {!! Form::label('role id', 'Rol asignado:') !!}

                                        {!! Form::select('roles', $roles, null, ['class' => 'roles form-control custom-select',
                                'placeholder' => 'Puede asignar un Rol...','onchange="requeridos(); EstablecimientoUser();"','required', 'title'=>'Si no encuentra su Rol en el listado, asegúrese que el mismo tenga un Menú asociado ']) !!}
                                        <small class="text-muted fw-lighter">Si no encuentra su Rol en el listado, asegúrese que el mismo tenga un Menú asociado</small>
                                    </div>
                                    <!-- Submit Field -->


                                    <div class="row form-group mt-4">
                                        <div class="col text-center">
                                            <a href="{{route('users.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
                                        </div>
                                        <div class=" col text-center">
                                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                        </div>
                                    </div>

                                    <input type="text" name="tipo_usuario" value="Usuario Interno" hidden>

                                {!! Form::close() !!}


                                </div>
                                <div class="col-md-3"></div>
                            </div>


                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
