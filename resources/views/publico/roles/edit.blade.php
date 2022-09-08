@extends('layouts.app')
@section("titulo")
    Roles
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('roles') !!}">Roles</a>
                </li>
                <li class="breadcrumb-item active1">Editar</li>
            </ol>
        </nav>
    </div>
    </header>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('coreui-templates::common.errors')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-id-badge fa-lg"></i>
                            <strong>Editar Rol</strong>

                            <div class="card-header-actions">

                            </div>
                        </div>
                        <div class="card-body">
                        <div class="row  ">
                            <div class="col-md-2  "></div>
                            <div class="col-md-8 col-lg-8 col-sm-12 border rounded py-3">

                            <form action="{{route('roles.update', $role->id)}} " method="post" class="needs-validation"
                                  novalidate>
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="col-md-12 col-lg-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre :</label>
                                            <input type="text" class="form-control" id="name"
                                                   placeholder="Nombre del permiso" name="name"
                                                   value="{{ $role->name }}" required>
                                            @if($errors->has('name'))
                                                <span class="error text-danger" for='input-name'>
                                            {{ $errors->first('name') }}
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="h6 mt-3">Permisos:</label>

                                        <div class="container">
                                            <div class="row">
                                                @foreach($permissions as $id => $permission)
                                                    <div class="col-sm-3">
                                                        <div class="form-check form-switch form-check-inline mt-sm-2"
                                                             style="float:left">
                                                            <input class="form-check-input form-field-acceptconditions"
                                                                   type="checkbox" name="permissions[]" id="{{$id}}"
                                                                   value="{{$id}}"
                                                                   {{ $role->permissions->contains($id) ? 'checked' : '' }} data-toggle="tooltip"
                                                                   data-placement="right" title=" {{$permission}} ">
                                                            <p class="form-check-label"
                                                               for="inlineCheckbox1 texto-recortado">{{ $permission}}</p>
                                                        </div>
                                                    </div>


                                                @endforeach
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="row mt-4">
                                    <div class="col text-center">
                                        <a href="{{route('roles')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
                                    </div>
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary btn-bg-inea">Modificar</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                            </div>


                            <div class="col-md-2"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
