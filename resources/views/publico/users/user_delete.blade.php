@extends('layouts.app')
@section("titulo")
    Usuarios
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Usuarios</li>
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
                        <div class="card-header btncancelarZarpes text-white">
                            <i class="fas fa-users-slash"></i>
                            <strong >Usuarios Eliminados</strong>
                            @can('crear-usuario')
                                <div class="card-header-actions">
                                    <a class="btn btn-primary btn-sm"  href="{{ route('users.index') }}">Volver a Usuarios</a>
                                </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            <style>
                                table.dataTable {
                                    margin: 0 auto;
                                }
                            </style>
                            <table class="table table-striped table-bordered table-grow" id="generic-table" style="width:70%">
                                <thead>
                                <th width="15%">Id</th>
                                <th>Email</th>
                                <th>Nombres</th>
                                <th width="15%">Tipo de Usuario</th>
                                <th width="10%">Acciones</th>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->nombres }}</td>
                                        <td>{{ $user->tipo_usuario }}</td>
                                        <td>
                                            @can('eliminar-usuario')
                                                <a class="btn btn-sm btn-warning confirmation_other"  data-action="RESTAURAR"
                                                   data-route="  {{ route('userDeleted.restore', [$user->id]) }}">
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

