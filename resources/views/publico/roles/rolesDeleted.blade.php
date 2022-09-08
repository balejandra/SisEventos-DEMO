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
                        <div class="card-header  btncancelarZarpes text-white">
                            <i class="fas fa-trash-restore"></i>
                            <strong>Roles Eliminados</strong>
                            @can('crear-rol')
                                <div class="card-header-actions">
                                    <a class="btn btn-primary btn-sm"  href="{{ route('roles') }}">Volver a Roles</a>
                                </div>
                            @endcan

                        </div>
                        <div class="card-body">
                            <style>
                                table.dataTable {
                                    margin: 0 auto;
                                }
                            </style>

                            <table class="table table-striped table-bordered table-grow" style="width:80%" id="generic-table">
                                <thead>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Eliminado</th>
                                <th>Permisos</th>
                                <th class="text-center" width="15%">Acciones</th>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td> {{$role->id}} </td>
                                        <td>{{$role->name}} </td>
                                        <td>{{date_format($role->deleted_at,'d-m-Y')}} </td>
                                        <td width="45%">
                                            @forelse($role->permissions as $permission)
                                                <span class="badge badge-info">{{$permission->name}} </span>
                                            @empty
                                                <span class="badge badge-danger">Sin permisos asignados</span>
                                            @endforelse
                                        </td>
                                        <td>
                                            @can('eliminar-rol')
                                                <a class="btn btn-sm btn-warning confirmation_other"
                                                   data-route=" {{route('roleDeleted.restore',$role->id)}}" data-action="RESTAURAR">
                                                    <i class="fas fa-trash-restore"></i>
                                                </a>
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
