<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
        .display-5 {
            font-family: 'Jost', sans-serif;
            font-size: 13px;
            line-height: 1.5;
        }

        .display-7 {
            font-family: 'Jost', sans-serif;
            font-size: 11px;
            line-height: 1.5;
        }

        .cid-sYSK2SiKvy {
            padding-top: 4rem;
            padding-bottom: 3rem;
            background-color: transparent;
        }

        .cid-sYSK2SiKvy .image-wrap img {
            width: 100%;
        }

        .cid-sYSK2SiKvy .mbr-text {
            color: #000080;
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
        span.content  {
            text-align: justify;
            text-justify: inter-word;
            color: blue;
        }

        .content-paragraph-rigth {
            text-align: right;
            padding-left: 20px;
            padding-right: 20px;
        }
        u{
            color:red;
        }
    </style>


</head>
<body>

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

<header class="cid-sYSK2SiKvy">

    <div style="padding-top: 12pt; position:absolute; left:220pt; width:80pt;">
        <img class="img-rounded" height="100px" src="{{ public_path('images/venezuela.jpeg') }}">
    </div>
    <div style="position:fixed;padding-top: 50pt; left: 370pt;">
        <h4 class="mbr-section-subtitle mbr-fonts-style mb-4 display-5 content-paragraph">
           <b>
            Nº: {{$zarpe->nro_solicitud}}
           </b>
        </h4>
    </div>
    <div style="position:fixed;padding-top: 550pt; left: 400pt;">
        @php
            $vencimiento = strtotime ( '+24 hour' , strtotime ($zarpe->fecha_hora_salida) ) ;
            $vencimiento = date ( 'Y-m-d H:i:s' , $vencimiento);
        @endphp
            @if($zarpe->bandera=='extranjera')
            @php
                    $QR =
                        "Nombre Embarcacion: ".$buque->nombre_buque."\n".
                        "Destino: " .$zarpe->capitania->nombre."\n".
                        "Fecha Emision: " .$zarpe->updated_at."\n".
                        "Fecha Vencimiento: " .$vencimiento
                        @endphp
    @else
            @php
                    $QR =
                        "Nombre Embarcacion: ".$buque->nombrebuque_actual."\n".
                        "Destino: " .$zarpe->capitania->nombre."\n".
                        "Fecha Emision: " .$zarpe->updated_at."\n".
                        "Fecha Vencimiento: " .$vencimiento
            @endphp
        @endif



        <img src="data:image/png;base64, {!! base64_encode(QrCode::size(100)->generate($QR)) !!} ">
    </div>
    <div style="padding-top:100pt; padding-left:150pt; padding-bottom:10pt;">

        <p class=" text-center mbr-text display-5" style="color:#000;">
            <b>  República Bolivariana de Venezuela<br>
            Ministerio del Poder Popular para el Transporte<br>
            Instituto Nacional de los Espacios Acuáticos<br>
            </b>
        <br>

        </p>
    </div>

</header>

<main>
    <div style="clear:both; position:relative; padding-top: 110px;" class="content-paragraph">



        <p class="mbr-text mbr-fonts-style display-7 content-paragraph text-justify">
            <b>
            El Buque
                @if($zarpe->bandera=='extranjera')
                           <u>{{$buque->nombre_buque}}</u>
                @else
                    <u>{{$buque->nombrebuque_actual}}</u>
                @endif
                , matrícula {{$zarpe->matricula}}, de bandera
            @if ($zarpe->bandera=='nacional')
                    <u>Venezolana</u>
                @elseif ($zarpe->bandera=='extranjera')
                    <u>Extranjera</u>
                @endif
            , del porte de
                @if($zarpe->bandera=='extranjera')
                    <u>{{$buque->arqueo_bruto}}</u>
                @else
                    <u>{{$buque->UAB}}</u>
                @endif
                 unidades de arqueo bruto y <u>{{$buque->eslora}}</u> metros de eslora,
            procedente de <u>{{$zarpe->establecimiento_nautico->nombre}}  </u>
            ubicado en la circunscripción acuática de <u>{{$capitania->nombre}}</u>,
            al mando del Capitán <u>{{$trip->nombre}} {{$trip->apellido}}</u>, con <u> {{$cantTrip}} </u> tripulantes y <u> {{$cantPas}} </u> pasajeros,
            ha cumplido con todos los requisitos de seguridad marítima y legales para hacerse a la mar,
            en concordancia con lo establecido en los Artículos 38 y 39 de la Ley General de Marina y
            Actividades Conexas y las disposiciones emitidas por la Autoridad Acuática.
            </b>
            <br>
            <i>
                The Vessel
                @if($zarpe->bandera=='extranjera')
                    <u>{{$buque->nombre_buque}}</u>
                @else
                    <u>{{$buque->nombrebuque_actual}}</u>
                @endif
                , registration number <u>{{$zarpe->matricula}}</u>, under the
                @if ($zarpe->bandera=='nacional')
                        <u>Venezuelan</u>
                    @elseif ($zarpe->bandera=='extranjera')
                        <u>foreign</u>
                    @endif
                flag, with a size of
                @if($zarpe->bandera=='extranjera')
                    <u>{{$buque->arqueo_bruto}}</u>
                @else
                    <u>{{$buque->UAB}}</u>
                @endif
                gross tonnage units
                and <u>{{$buque->eslora}}</u> meters in length, coming from <u>{{$zarpe->establecimiento_nautico->nombre}}</u> located in the
                aquatic district of <u>{{$capitania->nombre}}</u>, under the command of Captain  <u> {{$trip->nombre}} {{$trip->apellido}} </u>, with <u> {{$cantTrip}} </u> crew members and <u> {{$cantPas}} </u> passenger,
                has complied with all maritime safety and legal requirements to go to sea, in accordance with what is established in Articles 38 and 39 of the General Law of the Navy and Related Activities and the provisions issued by the Aquatic Authority.
            </i>
        </p>




        <p class="mbr-text mbr-fonts-style display-7 content-paragraph">
            <b>
        El suscrito Capitán de Puerto valida su notificación y lo autoriza para zarpar
        desde el lugar de procedencia, a partir del <u>{{$zarpe->fecha_hora_salida}}</u>, teniendo como punto de escala lat <u>@php echo coordenadasGrad(json_decode($zarpe->coordenadas)[0]); @endphp N</u>,
        long <u>@php echo coordenadasGrad(json_decode($zarpe->coordenadas)[1]); @endphp W</u>, estimando arribar a la escala el
        <u>{{$zarpe->fecha_llegada_escala}}</u>,
        con destino a {{$zarpe->capitania->nombre}},
        con el propósito de efectuar navegación <u> {{ $DescripcionNavegacion->descripcion }}</u>,
        estimando arribar al destino seleccionado el <u>{{$zarpe->fecha_hora_regreso}}</u>
            </b>

            <br>
            <i>
                The undersigned Port Captain validates his notification and authorizes
                him to set sail from the place of origin, as of <u>{{$zarpe->fecha_hora_salida}}</u>,
                having lat <u>@php echo coordenadasGrad(json_decode($zarpe->coordenadas)[0]); @endphp N</u>, long <u>@php echo coordenadasGrad(json_decode($zarpe->coordenadas)[1]); @endphp W</u> as the stopover point,
                estimating to arrive at the stopover on <u>{{$zarpe->fecha_llegada_escala}}</u>,
                bound for {{$zarpe->capitania->nombre}},
                for the purpose of navigation <u>{{ $DescripcionNavegacion->descripcion }}</u>, estimating to arrive on the selected destination
                <u>{{$zarpe->fecha_hora_regreso}}</u>
            </i>
        </p>


        <p class="mbr-text mbr-fonts-style display-7 content-paragraph">
            <b>
            Este documento tendrá validez por 24 horas, a partir de la fecha estimada de zarpe y sólo lo autorizará navegar en los lapsos y lugares descritos.
            </b>
            <br>
            <i>
            This document will be valid for 24 hours, from the estimated date of departure and will only authorize navigation in the times and places described.
            </i>
        </p>


        <p class="mbr-text mbr-fonts-style display-7 content-paragraph">
            <b>
            Este documento no tiene enmiendas.
            </b>
            <br>
            <i>
            This document has no amendments.
            </i>
        </p>

        <p class="mbr-text mbr-fonts-style display-7 content-paragraph">
            <b>
            Lugar y fecha de emisión:   <u>{{$capitania->nombre}}, {{$zarpe->updated_at}}</u>
            </b>
            <br>
            <i>
            Place and date of issue: <u>{{$capitania->nombre}}, {{$zarpe->updated_at}}</u>
            </i>

        </p>

        <br>
        <br>
        <p class="mbr-text text-center mbr-fonts-style display-7">Capitán de Puerto/Comodoro<br>
            <span class="content">
                ( Signature and stamp Harbor Master)
            </span>
        </p>
        <br>
        <p class="mbr-text text-center mbr-fonts-style display-7">
            <b>Recuerde realizar la notificación del zarpe y el arribo en el sistema</b>
            /
            <i>Remember to notify the departure and arrival in the system.</i>
        </p>

       
    </div>
</main>
</body>
</html>
