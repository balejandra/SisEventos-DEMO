@extends('layouts.app')
@section("titulo")
    Zarpes
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
             <div class="col-md-12" id="errorPermiso">
            </div>
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fas fa-ship"></i>
                             <strong>Solicitud de Permisos de {{$titulo}}</strong>
                             <div class="card-header-actions">
                                 <a class="btn btn-primary btn-sm"  href="{{route('permisoszarpes.index')}}">Cancelar</a>
                             </div>

                         </div>
                         <div class="card-body" style="min-height: 350px;">

                             @include('zarpes.permiso_zarpe.stepsIndicator')

                         	 <form action="{{ route('permisoszarpes.permissionCreateSteptwoE') }}" method="POST">
				                @csrf

				                <div class="card">
				                    <div class="card-body" style="min-height: 250px;">
				                            @if ($errors->any())
				                                <div class="alert alert-danger">
				                                    <ul>
				                                        @foreach ($errors->all() as $error)
				                                            <li>{{ $error }}</li>
				                                        @endforeach
				                                    </ul>
				                                </div>
				                            @endif

                                           <div class="row gy-2 gx-3 justify-content-center mt-3">
											<div class="col-auto">
											<label for="title">Ingrese el número de Permiso de
estadía del buque:</label>
											</div>
                                            <div class="col-auto">
											
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control col-sm-6" name="permiso" id="permiso">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                 
                                                <button type="button" class="btn btn-primary" onclick="getPermisoEstadia($('#permiso').val())">Verificar</button>
                                            </div>
                                        </div>
                                                <br>
                                        	<div class="table-responsive" id="tableEstadiaVAl" style="display:none;" >
                                        		<table  class="table table-bordered table-small">
                                        			<tr>
                                        				<th class="bg-light" width="40%">Nro. solicitud</th>
                                        				<td id="solicitud"></td>
                                        			</tr>
                                        			<tr>
                                        				<th class="bg-light">Nombre de embarcación</th>
                                        				<td id="nombre"></td>
                                        			</tr>
                                        			<tr>
                                        				<th class="bg-light">Tipo</th>
                                        				<td id="tipo"></td>
                                        			</tr>
                                        			<tr>
                                        				<th class="bg-light">Nacionalidad</th>
                                        				<td id="nacionalidad"></td>
                                        			</tr>
													<tr>
                                        				<th class="bg-light">Número de registro</th>
                                        				<td id="nro_registro"></td>
                                        			</tr>
													<tr>
                                        				<th class="bg-light">Vigencia hasta</th>
                                        				<td id="vigencia"></td>
                                        			</tr>
                                        		</table>

                                        		<input type="hidden" id="permiso_de_estadia" name="permiso_de_estadia" value="">
                                        		<input type="hidden" id="numero_registro" name="numero_de_registro" value="">
                                        	</div>
                                        </div>

				                    <div class="card-footer text-right">
				                    	<div class="row">
				                    		<div class="col text-left">
				                                <a href="{{ route('permisoszarpes.createStepOne') }}" class="btn btn-primary pull-right">Anterior</a>
				                            </div>
				                            <div class="col text-right">
				                                <button type="submit" class="btn btn-primary">Siguiente</button>
				                            </div>
				                    	</div>
				                    </div>
				                </div>
				            </form>
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
@endsection
