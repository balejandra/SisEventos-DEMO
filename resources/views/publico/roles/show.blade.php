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
                <li class="breadcrumb-item active1">Consulta</li>
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
                                <strong>Consultar Rol</strong>

                                <div class="card-header-actions">

                                  </div>
                            </div>
                            <div class="card-body">



            <div class="my-2">
            <div class="container">

                    <div class="row">
                    	<div class="col-md-12">
                    		Permisos asignados:
                    	</div>
                        @forelse($role->permissions as $permission)

                            <div class="col-md-1 mx-1">
                            	<span class="badge badge-info">{{$permission->name}} </span>
                            </div>
                        @empty
                            <div class="col-md-12 border rounded p-2">
                            	<span class="badge badge-danger">Sin permisos asignados</span>
                            </div>


                        @endforelse
                    </div>


                    <div class="row mt-4">
                        <div class="col-md-12 text-center">
                        <a href="{{route('roles')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
                        </div>
                    </div>


                </div>
            </div>


                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
