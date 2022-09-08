@extends('layouts.app')
@section("titulo")
    Menus
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">{{$titulo}}</li>
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
                        <div class="card-header  btncancelarZarpes text-white">
                            <i class="fas fa-trash-restore"></i>
                            <strong>{{$titulo}} Eliminados</strong>
                            <div class="card-header-actions">
                                <a class="btn btn-primary btn-sm"  href="{{ route('menus.index') }}">Volver a Menú</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped " id="generic-table" style="width:100%">
                                <thead>

                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Url</th>
                                <th>Padre</th>
                                <th>Orden</th>
                                <th>Icono</th>
                                <th>Eliminado</th>
                                <th>Acciones</th>
                                </thead>
                                <tbody>
                                @foreach($menus as $menu)
                                    <tr>
                                        <td>{{ $menu->id }}</td>
                                        <td>{{ $menu->name }}</td>
                                        <td>{{ $menu->description }}</td>
                                        <td>{{ $menu->url }}</td>
                                        <td>{{ $menu->parent }}</td>
                                        <td>{{ $menu->order }}</td>
                                        <td>{{ $menu->icono }}</td>
                                        <td>{{ $menu->deleted_at }}</td>
                                        <td>
                                            @can('eliminar-menu')
                                                <a class="btn btn-sm btn-warning confirmation_other" data-route="{{ route('menuDeleted.restore', [$menu->id]) }}"
                                                data-action="RESTAURAR">
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
    </div>
@endsection

