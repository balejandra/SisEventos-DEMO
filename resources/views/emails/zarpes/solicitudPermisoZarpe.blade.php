@component('mail::message')

    Saludos,

    {{$mensaje}}

    Detalles de la embarcación:

@component('mail::panel')
    <b>Nro. de Solicitud:</b> {{$solicitud}} <br>
    <b>Buque Matrícula Nro.:</b>  {{$matricula}} <br>
    <b>Solicitante:</b>  {{$nombres_solic}} {{$apellidos_solic}} <br>
    <b>Fecha y hora de salida:</b>  {{$fecha_salida}} <br>
    <b>Fecha y hora de regreso:</b>  {{$fecha_regreso}} <br>

@endcomponent
@component('mail::subcopy')
    Instituto Nacional de Los Espacios Acuáticos - INEA. Síguenos en: <a href="http://twitter.com/#!/INEA200">http://twitter.com/#!/INEA200</a>

@endcomponent
@component('mail::footer')
    Sugerencia: Agregue {{$from}} a sus contactos de correo electrónico para así evitar recibir correo en spam.
    Gracias,
@endcomponent
@endcomponent
