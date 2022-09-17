<strong>Detalle de la Autorizacion de Eventos</strong>

<div class="container">
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Nro. de Solicitud
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $autorizacionEvento->nro_solicitud }}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Fecha de la Solicitud
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ date_format($autorizacionEvento->created_at,'d-m-Y')}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Nombre del Solicitante
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $autorizacionEvento->user->nombres}} {{ $autorizacionEvento->user->apellidos}}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Nombre Evento
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $autorizacionEvento->nombre_evento }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Fecha
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $autorizacionEvento->fecha}}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Horario
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $autorizacionEvento->horario }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Lugar
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $autorizacionEvento->lugar}}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Cantidad Organizadores
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $autorizacionEvento->cant_organizadores }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Cantidad Asistentes
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $autorizacionEvento->cant_asistentes}}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Nombre Contacto
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $autorizacionEvento->nombre_contacto }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Telefono Contacto
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $autorizacionEvento->telefono_contacto}}
                </div>
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Email Contacto
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $autorizacionEvento->email_contacto }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="row border">
                <div class="col-md-3 col-sm-3 bg-light p-2 text-th">
                    Estatus
                </div>
                <div class="col-md-3 col-sm-3 p-2">
                    {{ $autorizacionEvento->status->nombre}}
                </div>
            </div>
        </div>
    </div>
    <br>
    <strong>Documentos Adjuntos</strong>
    <div class="container">
        <div class="row">

            @foreach($documentos as $documento)
                <div class="col-sm-6">
                    <a class="document-link" href="{{asset('documentos/autorizacionevento/'.$documento->documento)}}" target="_blank">
                        {{$documento->recaudo }}</a>
                </div>
            @endforeach
        </div>
    </div>

    <br>

    <strong>Pagos</strong>
    <table class="table table-hover nooptionsearch border table-grow" style="width: 100%">
        <thead>
        <tr>
            <th>Monto Pagar en Petro</th>
            <th>Monto Pagar en Bolivares</th>
            <th>Forma de Pago</th>
            <th>Codigo Transaccion</th>
            <th>Fecha de Pago</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pagos as $pago)
            <tr>
                <td>{{$pago->monto_pagar_petros}}</td>
                <td>{{$pago->monto_pagar_bolivares}}</td>
                <td>{{$pago->forma_pago}}</td>
                <td>{{$pago->codigo_transaccion}}</td>
                <td>{{$pago->fecha_pago}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <strong>Historial de Revisiones</strong>
    <table class="table table-hover nooptionsearch border table-grow" style="width: 100%">
        <thead>
        <tr>
            <th>Nombre y Apellido</th>
            <th>Acción</th>
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
    <br>

</div>
