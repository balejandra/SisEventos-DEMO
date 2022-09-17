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

   <!-- <div style="padding-top: 40pt; padding-left: 20px; position:absolute;  width:80pt;">
        <img class="img-rounded" height="100px" src="{{ public_path('images/inea.png') }}">
    </div>-->

    <div style="position:fixed;padding-top: 120pt; left: 420pt;">
        @php
            $QR =
                "Nro Solicitud: ".$estadia->nro_solicitud."\n".
                "Nombre Evento: ".$estadia->nombre_evento."\n".
                "Fecha Evento: ".$estadia->fecha."\n".
                "Hora Evento: " .$estadia->hora."\n".
                "Lugar Evento: " .$estadia->lugar."\n".
                "Fecha Emision: " .$estadia->updated_at."\n"
        @endphp

        <img src="data:image/png;base64, {!! base64_encode(QrCode::size(100)->generate($QR)) !!} ">
    </div>
    <div style="padding-top:50pt; padding-left:130pt;">
        <p class=" text-center mbr-text display-7">
            REPÚBLICA BOLIVARIANA DE VENEZUELA<br>
            <br>
            <span style="font-size: 20px; font-weight: bold">SOLICITUD DE AUTORIZACIÓN DE EVENTOS</span><br>
        </p>
    </div>

</header>

<main>
    <div style="clear:both; position:relative; padding-top: 120px;" class="content-paragraph">

        <h4 class="mbr-section-subtitle mbr-fonts-style mb-4 display-5 content-paragraph">N° de Permiso: {{$estadia->nro_solicitud}}</h4>
        <p class="mbr-text mbr-fonts-style display-7 content-paragraph">
        <table>
            <thead>
            <tr>
                <th>NOMBRE DEL EVENTO</th>
                <th>FECHA EVENTO</th>
                <th>HORARIO DEL EVENTO</th>
                <th>LUGAR DEL EVENTO</th>
                <th>NOMBRE CONTACTO</th>
                <th>TELEFONO CONTACTO</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$estadia->nombre_evento}}</td>
                <td>{{$estadia->fecha}}</td>
                <td>{{$estadia->horario}}</td>
                <td>{{$estadia->lugar}}</td>
                <td>{{$estadia->nombre_contacto}}</td>
                <td>{{$estadia->telefono_contacto    }}</td>
            </tr>
            <tr><td colspan="6"></td></tr>
            <tr>
                <th colspan="2">CONCEPTO</th>
                <th COLSPAN="2">MONTO EN PETROS</th>
                <th colspan="2">MONTO EN BOLIVARES</th>
            </tr>
            <tr>
                <td colspan="2">Pago por realizar {{$estadia->nombre_evento}}</td>
                <td colspan="2">{{$pago->monto_pagar_petros}}</td>
                <td colspan="2">{{$pago->monto_pagar_bolivares}}</td>
            </tr>
            <tr><td colspan="6"></td>
            </tr>
            <tr>
<td colspan="6"></td>
            </tr>
            <tr>
                <th colspan="4">TOTAL A PAGAR</th>
                <th colspan="2">{{$pago->monto_pagar_bolivares}}</th>

            </tr>
        </table>

        <p class="mbr-text mbr-fonts-style display-7 content-paragraph">Lugar y fecha
            <u> {{date_format($estadia->updated_at,'d-m-Y')}} </u><br>
        </p>
        <br>
    </div>
</main>
</body>
</html>
