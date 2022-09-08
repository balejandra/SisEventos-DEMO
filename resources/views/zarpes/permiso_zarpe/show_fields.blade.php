@php
    function coordenadasGrad($coordenada){
        $gcoordenada=intval($coordenada);
        $mcoordenada1=number_format(($coordenada-$gcoordenada)*60, 4, '.', '');
        $mcoordenada2=intval($mcoordenada1);
        $scoordenada1=number_format(($mcoordenada1-$mcoordenada2)*60, 4, '.', '');
        $scoordenada2=number_format($scoordenada1,1,'.','');
        $scoordenada2= abs($scoordenada2);
        if($scoordenada2 < 10 ){
            $scoordenada2='0'.$scoordenada2;
        }
         return abs($gcoordenada).'°'.abs($mcoordenada2).'\''.$scoordenada2.'"';

    }
@endphp


<strong>Detalle del Zarpe</strong>

<div class="container">
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Nro. de Solicitud
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoZarpe->nro_solicitud }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Fecha de Solicitud
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    @php
                        $fecha=explode(' ',$permisoZarpe->created_at);
                        $f=explode('-',$fecha[0]);
                        $createdAt=$f[2].'/'.$f[1].'/'.$f[0]." ".$fecha[1];
                    @endphp
                    {{  $createdAt}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Bandera
                </div>
                <div class="col-md-3 col-sm-3 p-2 text-capitalize">
                    {{ $permisoZarpe->bandera }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th ">
                    Nombre Solicitante
                </div>
                <div class="col-md-3 col-sm-3 p-2 text-capitalize">
                    {{ $permisoZarpe->user->nombres}} {{ $permisoZarpe->user->apellidos}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Matrícula Buque
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoZarpe->matricula }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Nombre Buque
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    @if($permisoZarpe->bandera=='extranjera')
                        <td>{{ $buque->nombre_buque }}</td>
                    @else
                        <td>{{ $buque->nombrebuque_actual }}</td>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Tipo de Navegación
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoZarpe->tipo_zarpe->nombre }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Descripción de Navegación
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{$descripcionNavegacion->descripcion}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Origen
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{$capitaniaOrigen->nombre}} <br> {{ $permisoZarpe->establecimiento_nautico->nombre }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Coordenadas (escala)
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    @php $coords=json_decode($permisoZarpe->coordenadas); @endphp
                    Latitud: @php echo coordenadasGrad($coords[0]); @endphp N <br>
                    Longitud: @php echo coordenadasGrad($coords[1]); @endphp W
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Destino
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoZarpe->capitania->nombre }} <br> {{$establecimientoDestino->nombre}}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Fecha y Hora Salida
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                @php
                        $fechaS=explode(' ',$permisoZarpe->fecha_hora_salida);
                        $fS=explode('-',$fechaS[0]);
                        $fecha_hora_salida=$fS[2].'/'.$fS[1].'/'.$fS[0]." ".$fechaS[1];
                    @endphp
                    {{$fecha_hora_salida}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Fecha y Hora Regreso
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    @php
                        $fechaR=explode(' ',$permisoZarpe->fecha_hora_regreso);
                        $fR=explode('-',$fechaR[0]);
                        $fecha_hora_regreso=$fR[2].'/'.$fR[1].'/'.$fR[0]." ".$fechaR[1];
                    @endphp
                    {{$fecha_hora_regreso }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Estatus
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $permisoZarpe->status->nombre }}
                </div>
            </div>
        </div>
    </div>
    <br>

    @if ($permisoZarpe->bandera=='nacional')
        <strong>Certificados de Seguridad Marítima</strong>

        <table class="table table-hover nooptionsearch border table-grow" style="width: 80%">
            <thead>
            <th>Tipo de Certificado</th>
            <th>Número de Certificado</th>
            <th>Fecha de Expedición</th>
            </thead>
            <tbody>
            @foreach($certificados as $certificado)
                <tr>
                    <td>{{ $certificado->nombre_certificado }}</td>
                    <td>{{$certificado->nro_correlativo}}</td>
                    <td>{{ $certificado->fecha_expedicion}}</td>

            @endforeach
        </table>

    @endif

    <strong>Tripulantes</strong>

    <table class="table table-hover nooptionsearch border table-grow" style="width: 100%">
        <thead>
        <th>Función</th>
        <th>Nombres y Apellidos</th>
        <th>C.I. / Pasaporte</th>
        <th>Fecha de Nacimiento</th>
        <th>Sexo</th>
        <th>Tipo Doc.</th>
        <th>Rango</th>
        <th>Fecha de Emisión</th>
        <th>Nro. de Documento</th>
        <th>Documentos</th>

        </thead>
        <tbody>
        @foreach($tripulantes as $tripulante)
            <tr>
                <td>{{$tripulante->funcion}} </td>
                <td>{{$tripulante->nombres}} {{$tripulante->apellidos}} </td>
                <td>{{$tripulante->tipo_doc}} {{$tripulante->nro_doc}}</td>
                <td>{{$tripulante->fecha_nacimiento}}</td>
                <td>{{$tripulante->sexo}} </td>
                <td>
                    @if($tripulante->tipo_doc=='V')
                        {{$tripulante->documento_acreditacion}}
                    @else
                        N/A
                    @endif
                </td>
                <td>{{$tripulante->rango}}</td>
                <td>
                    @if($tripulante->fecha_emision=="")
                        N/A
                    @else
                        {{$tripulante->fecha_emision}}
                    @endif
                </td>
                <td>
                    @if($tripulante->tipo_doc=='V')
                        {{$tripulante->nro_ctrl}}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if($tripulante->tipo_doc=='V')
                        N/A
                    @else
                        @if($tripulante->doc!="")
                        <a class="document-link" title="Pasaporte" href="{{asset('documentos/permisozarpe/'.$tripulante->doc)}}" target="_blank"> Pasaporte </a>

                        @endif
                        @if($tripulante->documento_acreditacion!="")
                        <br>
                        <a class="document-link" title="Pasaporte" href="{{asset('documentos/permisozarpe/'.$tripulante->documento_acreditacion)}}" target="_blank"> Documento de acreditación </a>

                        @endif

                    @endif
                </td>
            </tr>
             @endforeach
        </tbody>
    </table>
    <br>

    <strong>Pasajeros</strong>
    <table class="table table-hover nooptionsearch border table-grow" style="width: 80%">

        <thead>
        <th>Nombres y Apellidos</th>
        <th>Documentación</th>
        <th>Sexo</th>
        <th>Menor</th>
        <th>Representante</th>
        <th>Documentos</th>

        </thead>
        <tbody>
        @foreach($pasajeros as $pasajero)
            <tr>
                <td> {{$pasajero->nombres}}  {{$pasajero->apellidos}}</td>
                <td> {{$pasajero->tipo_doc}}  {{$pasajero->nro_doc}}</td>
                <td>{{$pasajero->sexo}} </td>
                @if($pasajero->menor_edad==true)
                    <td>SI</td>
                    <td>{{$pasajero->representante}} </td>

                    <td>
                        @if ($pasajero->pasaporte_menor)
                            <a class="document-link"
                               href="{{asset('documentos/permisozarpe/'.$pasajero->pasaporte_menor)}}" target="_blank">
                                Pasaporte</a> <br>
                        @endif
                        @if ($pasajero->partida_nacimiento)
                            <a class="document-link"
                               href="{{asset('documentos/permisozarpe/'.$pasajero->partida_nacimiento)}}"
                               target="_blank">
                                Partida de Nacimiento</a> <br>
                        @endif
                        @if ($pasajero->autorizacion)
                            <a class="document-link"
                               href="{{asset('documentos/permisozarpe/'.$pasajero->autorizacion)}}" target="_blank">
                                Autorización</a>
                        @endif

                    </td>
                @else
                    <td>NO</td>
                    <td>{{$pasajero->representante}} </td>
                    <td> @if ($pasajero->pasaporte_mayor)
                            <a class="document-link"
                               href="{{asset('documentos/permisozarpe/'.$pasajero->pasaporte_mayor)}}" target="_blank">
                                Pasaporte</a>
                        @endif
                    </td>
                @endif
                @endforeach
            </tr>
        </tbody>
    </table>
    <br>

    <strong>Equipos de Seguridad</strong>
    <table class="table table-hover nooptionsearch border table-grow" style="width: 60%">
        <thead>
        <tr>
            <th>Equipo</th>
            <th>Cantidad</th>
            <th>Otros</th>
        </tr>
        </thead>
        <tbody>
        @foreach($equipos as $equipo)
            <tr>
                <td>
                    {{$equipo->equipo->equipo}}
                </td>

                <td>
                {{$equipo->cantidad}}

                <td>
                    @if($equipo->otros=="fecha_ultima_inspeccion")
                        Fecha de última inspección {{$equipo->valores_otros}}
                    @else
                        {{$equipo->otros}} {{$equipo->valores_otros}}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>

    <strong>Historial de revisiones</strong>
    <table class="table table-hover nooptionsearch border table-grow" style="width: 100%">
        <thead>
        <tr>
            <th>Nombre y Apellido</th>
            <th>Accion</th>
            <th>Motivo</th>
            <th>Fecha</th>
        </tr>
        </thead>
        <tbody>
        @foreach($revisiones as $revision)
            <tr>
                <td>{{$revision->user->nombres}} {{$revision->user->apellidos}}</td>
                <td>{{$revision->accion}}</td>
                <td>{{$revision->motivo}}</td>
                <td>{{$revision->created_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<br>
<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    @can('aprobar-zarpe')
        @if(($permisoZarpe->status->id==3))
            <a data-route="{{route('status',[$permisoZarpe->id,'aprobado',$permisoZarpe->establecimiento_nautico_id])}}"
               class="btn btn-success confirmation" title="Aprobar" data-action="APROBAR">
                Aprobar <i class="fa fa-check"></i>
            </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @endif
    @endcan
    @can('rechazar-zarpe')
        @if ($permisoZarpe->status->id==3)
            <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-rechazo"
               onclick="modalrechazarzarpe({{$permisoZarpe->id}},'{{$permisoZarpe->nro_solicitud}}')">
                Rechazar <i class="fa fa-ban"></i>
            </a>

            <!-- Modal Rechazar -->
            <div class="modal fade" id="modal-rechazo" data-bs-backdrop="static" data-bs-keyboard="false"
                 tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <form id="rechazar-zarpe" action="" class="modal-form">
                    <div class="modal-dialog modal-fullscreen-sm-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Rechazar Solicitud Zarpe</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Por favor indique el motivo del rechazo de la Solicitud Nro. <span
                                        id="solicitudzarpe"></span></p>
                                <div class="col-sm-12">
                                    <div class="input-group mb-3">
                                        <select class="form-select" aria-label="motivo" id="motivo1" name="motivo"
                                                onchange="motivoRechazo();" required>
                                            <option value="">Seleccione un motivo</option>
                                            <option value="Disposiciones del Ejecutivo Nacional">Disposiciones del
                                                Ejecutivo Nacional.
                                            </option>
                                            <option value="Instrucciones especiales de la autoridad acuática">
                                                Instrucciones especiales de la autoridad acuática.
                                            </option>
                                            <option value="Condiciones meteorológicas adversas">Condiciones
                                                meteorológicas adversas.
                                            </option>
                                            <option value="Observaciones en los documentos">Observaciones en los
                                                documentos
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 form-group" style="display: none" id="inputmotivo">
                                    <input type="text" class="form-control" name="motivo" id="motivo2">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar
                                </button>
                                <button type="submit" class="btn btn-primary" data-action="RECHAZAR">Rechazar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    @endcan
        @if(($permisoZarpe->status->id=='1') && (date_format($permisoZarpe->fecha_hora_salida,'Y-m-d H:i:s')<=(date('Y-m-d H:i:s'))))
        @can('informar-navegacion')
            <a class="btn btn-warning confirmation"
               data-route=" {{route('status',[$permisoZarpe->id,'navegando',$permisoZarpe->establecimiento_nautico_id])}}"
               data-action="INFORMAR NAVEGACION de" data-toggle="tooltip">
                Navegando <i class="fas fa-water"></i>
            </a>
        @endcan
    @endif
        @can('informar-navegacion')
            @if ($permisoZarpe->status->id==1)
                <a class="btn btn-danger confirmation"
                   data-route="{{route('status',[$permisoZarpe->id,'anular-usuario',0])}}" data-toggle="tooltip"
                   data-bs-placement="bottom" title="Anular Solicitud" data-action="ANULAR" >
                    Anular <i class="fas fa-window-close"></i>
                </a>
            @endif
        @endcan
    @can('informar-arribo')
        @if ($permisoZarpe->status->id==5)
            <a class="btn btn-warning confirmation"
               data-route="{{route('status',[$permisoZarpe->id,'cerrado',0])}}" data-toggle="tooltip"
               data-bs-placement="bottom" title="Informar Arribo" data-action="INFORMAR ARRIBO de">
                Informar Arribo <i class="fas fa-anchor"></i>
            </a>
        @endif
    @endcan
    @if(($permisoZarpe->status->id==5)||($permisoZarpe->status->id==14))
        @can('anular-sar')
            <a class="btn btn-outline-danger confirmation"
               data-route=" {{route('status',[$permisoZarpe->id,'anulado_sar',$permisoZarpe->establecimiento_nautico_id])}}"
               data-toggle="tooltip" data-action="ANULAR">
                Anular por SAR <i class="fas fa-window-close"></i>
            </a>
        @endcan
    @endif
    @if (($permisoZarpe->status->id==1)||($permisoZarpe->status->id==4) ||($permisoZarpe->status->id==5))
        <a class="btn btn-dark"
           href="{{route('zarpepdf',$permisoZarpe->id)}}"
           target="_blank" data-toggle="tooltip"
           data-bs-placement="bottom"
           title="Descargar PDF">Descargar PDF
            <i class="fas fa-file-pdf"></i>
        </a>
    @endif
</div>
