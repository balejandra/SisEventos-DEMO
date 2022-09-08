@extends('layouts.app')
@section("titulo")
    Menus y Roles
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
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>
                            Roles asociados a {{$titulo}}
                            <div class="card-header-actions">
                                <a href= "{{route('menus.index')}} " class="btn btn-primary btn-sm">Cancelar</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <style>
                                table.dataTable {
                                    margin: 0 auto;
                                }
                            </style>
                            <table class="table table-striped table-bordered table-grow" style="width:70%" id="generic-table">
                                    <thead>
                                    <tr>
                                        <th>Menú</th>
                                        <th>Rol Asociado</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($count as $menuRol)
                                        @php($rol='')
                                        <tr>

                                            <td >
                                                {{ $menuRol->name}}
                                            </td>
                                            <td>
                                            @forelse($menuRols as $Roles)
                                                @if($Roles->name_menu==$menuRol->name and  $rol!=$Roles->name_role)

                                                    <span class="badge badge-info">
                                                        {{ $Roles->name_role}}
                                                    </span>
                                                @endif
                                                 @empty
                                                    <span class="badge badge-danger">
                                                    Sin roles asignados
                                                </span>


                                            @endforelse
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

