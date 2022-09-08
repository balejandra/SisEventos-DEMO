<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
        .display-5 {
            font-family: 'Jost', sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }

        .display-7 {
            font-family: 'Jost', sans-serif;
            font-size: 10px;
            line-height: 1.5;
        }

        .cid-sYSK2SiKvy {
            padding-top: 4rem;
            padding-bottom: 3rem;
            background-color: #ffffff;
        }

        .cid-sYSK2SiKvy .image-wrap img {
            width: 100%;
        }

        .cid-sYSK2SiKvy .mbr-text {
            color: #050505;
            text-align: center;
        }

        a {
            font-style: normal;
            font-weight: 400;
            cursor: pointer;
        }

        .mbr-section-subtitle {
            line-height: 1.3;
        }

        .mbr-text {
            font-style: normal;
            line-height: 1.7;
            text-align: justify;
            text-justify: inter-word;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .display-5,
        .display-7,
        span,
        p,
        a {
            line-height: 1.3;
            word-break: break-word;
            word-wrap: break-word;
            font-weight: 400;
        }

        b,
        strong {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        img,
        iframe {
            display: block;
            width: 100%;
        }

        html,
        body {
            height: auto;
            min-height: 100vh;
        }

        blockquote {
            font-style: italic;
            padding: 3rem;
            font-size: 1.09rem;
            position: relative;
            border-left: 3px solid;
        }

        .mb-4 {
            margin-bottom: 2rem !important;
        }

        .cid-sYSK2SiKvy .image-wrap img {
            display: block;
            margin: auto;
        }

        @page {
            margin-top: 140px;
        }

        header {
            top: -200px;
            position: fixed;
        }

        .content-paragraph {
            text-align: justify;
            text-justify: inter-word;
            padding-left: 20px;
            padding-right: 20px;
        }

        span.content {
            text-align: justify;
            text-justify: inter-word;
            color: blue;
        }

        .content-paragraph-rigth {
            text-align: right;
            padding-left: 20px;
            padding-right: 20px;
        }

        th, td {
            font-family: 'Montserrat-Medium', sans-serif;
            font-size: 8px;
        }

        table {
            width: 100%;
            max-width: 100%;
            padding: 20px;
            margin-bottom: 0px;
            border-spacing: 0;
            border-collapse: collapse;
            background-color: transparent;
        }

        thead {
            text-align: left;
            display: table-header-group;
            vertical-align: middle;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 6px;
        }
    </style>


</head>
<body>

<header class="cid-sYSK2SiKvy">

    <div style="padding-top: 40pt; padding-left: 20px; position:absolute;  width:80pt;">
        <img class="img-rounded" height="100px" src="{{ public_path('images/inea.png') }}">
    </div>

    <div style="position:fixed;padding-top: 40pt; left: 420pt;">
        @php
            $QR =
                "Nro Solicitud: ".$estadia->nro_registro."\n".
                "Nombre Embarcacion: ".$estadia->nombre_buque."\n".
                "Numero de Registro: ".$estadia->nro_registro."\n".
                "Destino: " .$estadia->capitania->nombre."\n".
                "Fecha Emision: " .$estadia->updated_at."\n".
                "Fecha Vencimiento: " .$estadia->vencimiento."\n"
        @endphp

        <img src="data:image/png;base64, {!! base64_encode(QrCode::size(100)->generate($QR)) !!} ">
    </div>
    <div style="padding-top:20pt; padding-left:130pt;">
        <p class=" text-center mbr-text display-7">
            REPÚBLICA BOLIVARIANA DE VENEZUELA<br>
            MINISTERIO DEL PODER POPULAR PARA EL TRANSPORTE<br>
            INSTITUTO NACIONAL DE LOS ESPACIOS ACUÁTICOS<br>
            CAPITANÍA DE PUERTO DE <span style="text-transform: uppercase">{{$estadia->capitania->nombre}}</span>  <br>
            <br>
            <span style="font-size: 20px; font-weight: bold">PERMISO DE ESTADÍA</span><br>
            <span class="display-7">TEMPORAL PERMANENCY AUTHORIZATION</span><br>
            <span style="font-size: 16px">EMBARCACIÓN DEPORTIVA EXTRANJERA</span><br>
            <span class="display-7">FOREIGN SPORT VESSEL</span>
        </p>
    </div>

</header>

<main>
    <div style="clear:both; position:relative; padding-top: 120px;" class="content-paragraph">

        <h4 class="mbr-section-subtitle mbr-fonts-style mb-4 display-5 content-paragraph">N° de Permiso: {{$estadia->nro_solicitud}}</h4>
        <p class="mbr-text mbr-fonts-style display-7 content-paragraph">
            Vista la solicitud correspondiente y previa consignación en este despacho de la documentación pertinente, el
            Capitán de Puerto de
            <u>{{$estadia->capitania->nombre}}</u> autoriza a la embarcación abajo identificada para permanecer en aguas venezolanas
            durante el lapso de noventa (90) días, pudiendo solicitar prorroga por el mismo tiempo hasta alcanzar un (01) año de
            permanencia continua en el país. Finalizado este lapso el buque deberá salir de aguas venezolanas durante cuarenta y cinco
            (45) días continuos antes de poder ingresar nuevamente, so pena de que el mismo sea sometido a la legislación en materia de
            Aduana en concordancia con el Permiso de Admisión Temporal emitido por la Autoridad Aduanera Nacional. Este permiso debe ser
            mostrado a la Autoridad Acuática antes de zarpar. El Capitán del Buque, está en la obligación de comunicar al Capitán de
            Puerto la falta de algún miembro de la tripulación al momento de zarpe, sin perjuicio de notificarlo también a las demás
            autoridades a quienes compete.
            <br>
            <BR>
            According to the corresponding request and previous consignment in this office the pertinent documentation, the
            <u>{{$estadia->capitania->nombre}}</u> Harbour Master admits the ship described below to remain in Venezuelan waters of the
            lapse of ninety (90) days, being able to request an extension for the same time until achieve one (01) year of continuous
            permanence in the country. Once this lapse has expired, the ship must leave Venezuelan waters for at least forty-five (45)
            continuous days before be able to enter again, under penalty of being submitted to Custom’s law regulations about smuggling
            activities. This permission must be showed to the Aquatic Authority prior to sailing out, in order to obtain port clearance.
            The Master of the Vessel, is obliged to inform the Harbour Master the lack of any crew member at the time of Port Clearance,
            without prejudice to also notify it to all Authorities to who it may concern.
        <table>
            <thead>
            <tr>
                <th>NOMBRE DEL BUQUE <br>Vessel'sname</th>
                <th>NÚMERO DE REGISTRO <br>Number of Register</th>
                <th>TIPO DE BUQUE <br>Type of ship</th>
                <th>NACIONALIDAD DEL BUQUE <br>Ship flag</th>
                <th>PROPIETARIO <br>Ship Owner</th>
                <th>NOMBRE DEL CAPITÁN <br>Captain's name</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$estadia->nombre_buque}}</td>
                <td>{{$estadia->nro_registro}}</td>
                <td style="text-transform: capitalize">{{$estadia->tipo_buque}}</td>
                <td>{{$estadia->nacionalidad_buque}}</td>
                <td>{{$estadia->nombre_propietario}}</td>
                <td>{{$estadia->nombre_capitan}}</td>
            </tr>
            <tr>
                <th>PASAPORTE <br>Passport Nro</th>
                <th>ESLORA <br>Lenght (mts.)</th>
                <th>MANGA <br>Breadth (mts.)</th>
                <th>PUNTAL <br>Depth (mts.)</th>
                <th>ARQUEO BRUTO <br>Gross Tonnage</th>
                <th>POTENCIA MOTORES (KW) <br>Motor Power (kw)</th>
            </tr>
            <tr>
                <td>{{$estadia->pasaporte_capitan}}</td>
                <td>{{$estadia->eslora}}</td>
                <td>{{$estadia->manga}}</td>
                <td>{{$estadia->puntal}}</td>
                <td>{{$estadia->arqueo_bruto}}</td>
                <td>{{$estadia->potencia_kw}}</td>
            </tr>
            <tr>
                <th>ACTIVIDADES A REALIZAR<br>Ship’s purpose</th>
                <th>NÚMERO DE TRIPULANTES <br>Number of Crew members</th>
                <th>NÚMERO DE PASAJEROS <br>Number of Passengers</th>
                <th colspan="2">PROCEDENCIA <br>Port of origin</th>
                <th>ZARPE ÚLTIMO PUERTO <br>Last port</th>
            </tr>
            <tr>
                <td style="text-transform: capitalize">{{$estadia->actividades}}</td>
                <td>{{$estadia->cant_tripulantes}}</td>
                <td>{{$estadia->cant_pasajeros}}</td>
                <td colspan="2">{{$estadia->puerto_origen}}</td>
                <td>{{$estadia->ultimo_puerto_zarpe}}</td>

            </tr>
            <tr>
                <th colspan="2">DESTINO <br>Port of destination</th>
                <th colspan="2">EN LA MARINA DE<br>Nautical Club</th>
                <th>FECHA DE ARRIBO <br>Arrival Date</th>
                <th>TIEMPO DE ESTADÍA <br>Permanency</th>

            </tr>
            <tr>
                <td colspan="2">{{$estadia->capitania->nombre}}</td>
                <td colspan="2">{{$estadia->establecimientos->nombre}}</td>
                <td>{{date_format($estadia->fecha_arribo,'d-m-Y')}}</td>
                <td>{{$estadia->tiempo_estadia}}</td>
            </tr>
            <tr>
                <td colspan="3">VÁLIDO DESDE / Valid since: {{date_format($estadia->updated_at,'d-m-Y')}}</td>
                <td colspan="3">VÁLIDO HASTA / Valid until: {{date_format($estadia->vencimiento,'d-m-Y')}}</td>
            </tr>
            </tbody>
        </table>

        <p class="mbr-text mbr-fonts-style display-7 content-paragraph">Lugar y fecha
            <u> {{date_format($estadia->updated_at,'d-m-Y')}} </u><br>
                PLACE AND DATE <u>  {{date_format($estadia->updated_at,'d-m-Y')}} </u>
        </p>
        <br>
        <p class="mbr-text text-center mbr-fonts-style display-7">Capitán de Puerto<br>
                HARBOUR MASTE
        </p>
    </div>
</main>
</body>
</html>
