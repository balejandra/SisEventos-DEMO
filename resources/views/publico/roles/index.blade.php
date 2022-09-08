@extends('layouts.app')
@section("titulo")
    Roles
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Roles</li>
            </ol>
        </nav>
    </div>
    </header>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')


              @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" id="msj" role="success">
                <button type="button" class="close success-op" data-dismiss="alert" aria-label="close">
                    &times;
                </button>
                {{session('success')}}
            </div>
        @endif



             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-id-badge"></i>
                            <strong>Roles</strong>
                            @can('crear-rol')
                                <div class="card-header-actions">
                                    <a class="btn btn-primary btn-sm"  href="{{ route('roles.create') }}">Nuevo</a>
                                    <a class="btn btn-warning btn-sm"  href="{{ route('roleDelete.index') }}">Roles Eliminados</a>
                                </div>
                            @endcan

                        </div>
                        <div class="card-body">


                            <table class="table table-striped table-bordered" style="width:100%" id="generic-table">
                                <thead>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Creado</th>
                                <th>Permisos</th>
                                <th class="text-center" width="15%">Acciones</th>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td> {{$role->id}} </td>
                                        <td>{{$role->name}} </td>
                                        <td>{{date_format($role->created_at,'d-m-Y')}} </td>
                                        <td width="45%">
                                            @forelse($role->permissions as $permission)
                                                <span class="badge badge-info">{{$permission->name}} </span>
                                            @empty
                                                <span class="badge badge-danger">Sin permisos asignados</span>
                                            @endforelse
                                        </td>
                                        <td class="text-center">
                                            @can('consultar-rol')
                                                <a class="btn btn-sm btn-success"
                                                   href=" {{route('roles.show',$role->id)}}">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                            @endcan
                                            @can('editar-rol')
                                                <a class="btn btn-sm btn-info"
                                                   href=" {{route('roles.edit',$role->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('eliminar-rol')

                                                <div class='btn-group'>
                                                    {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete','class'=>'delete-form']) !!}

                                                    <button type="submit" class="btn btn-sm btn-danger" id="eliminar" data-mensaje="el rol {{$role->name}}">
                                                        <i class="fa fa-trash"></i></button>
                                                    {!! Form::close() !!}
                                                </div>
                                        @endcan
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>

                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
