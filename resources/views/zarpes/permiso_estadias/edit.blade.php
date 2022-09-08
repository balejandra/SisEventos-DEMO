@extends('layouts.app')
@section("titulo")
    Estadias
@endsection
@section('content')
    @push('scripts')
        <script src="{{asset('js/estadia.js')}}"></script>
    @endpush
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('permisosestadia.index') !!}">Permiso Estadía</a>
                </li>
                <li class="breadcrumb-item ">Editar</li>
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
                            <i class="fas fa-water"></i>
                            <strong>Editar Permiso de Estadía</strong>
                        </div>
                        <div class="card-body">
                            {!! Form::model($permisoEstadia, ['route' => ['permisosestadia.update', $permisoEstadia->id], 'method' => 'patch','files' => true]) !!}

                            @include('zarpes.permiso_estadias.show_fields')
                            <div class="row justify-content-center">
                                <hr>
                            <div class='mx-4 my-2' id="msjEstadia2"></div>

                                <span class="title-estadia">Recaudos Faltantes</span>

                                <div class="form-group col-sm-4">
                                    {!! Form::label('permiso_seniat', 'Permiso de Admisión Temporal emitida por el SENIAT:') !!}
                                    <input type="file" class="form-control" name="permiso_seniat"
                                           id="permiso_seniat" accept="application/pdf, image/*" required  onchange="validarExtension('permiso_seniat','msjEstadia2')">
                                </div>
                                <div class="form-group col-sm-4">
                                    {!! Form::label('comprobante_alicuota', 'Comprobante de Pago de Alícuota:') !!}
                                    <input type="file" class="form-control" name="comprobante_alicuota"
                                           id="comprobante_alicuota" accept="application/pdf, image/*"required  onchange="validarExtension('comprobante_alicuota','msjEstadia2')">
                                </div>
                                <div class="form-group col-sm-4">
                                    {!! Form::label('inspeccion_visita', 'Inspección por el Visitador:') !!}
                                    <input type="file" class="form-control" name="inspeccion_visita"
                                           id="inspeccion_visita" accept="application/pdf, image/*" required  onchange="validarExtension('inspeccion_visita','msjEstadia2')">
                                </div>
                                <div class="form-group col-sm-4">
                                    {!! Form::label('comprobante_saime', 'Comprobante de Visita SAIME:') !!}
                                    <input type="file" class="form-control" name="comprobante_saime"
                                           id="comprobante_saime" accept="application/pdf, image/*" required  onchange="validarExtension('comprobante_saime','msjEstadia2')">
                                </div>
                                <div class="form-group col-sm-4">
                                    {!! Form::label('comprobante_insai', 'Comprobante de Visita INSAI:') !!}
                                    <input type="file" class="form-control" name="comprobante_insai"
                                           id="comprobante_insai" accept="application/pdf, image/*" required  onchange="validarExtension('comprobante_insai','msjEstadia2')">
                                </div>
                                <div class="form-group col-sm-4">
                                    {!! Form::label('pago_permisoEstadia', 'Pago del Permiso Especial de Estadía:') !!}
                                    <input type="file" class="form-control" name="pago_permisoEstadia"
                                           id="pago_permisoEstadia" accept="application/pdf, image/*" required  onchange="validarExtension('pago_permisoEstadia','msjEstadia2')">
                                </div>
                                <div class="form-group col-sm-4">
                                    {!! Form::label('comprobante_ochina', 'Comprobante de Pago a OCHINA:') !!}
                                    <input type="file" class="form-control" name="comprobante_ochina"
                                           id="comprobante_ochina" accept="application/pdf, image/*" required  onchange="validarExtension('comprobante_ochina','msjEstadia2')">
                                </div>
                            </div>
                            <br>
                                <!-- Submit Field -->
                                <div class="row form-group text-center">
                                    <div class="col">
                                        <a href="{{route('permisosestadia.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
                                    </div>
                                    <div class="col">
                                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                                    </div>

                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
