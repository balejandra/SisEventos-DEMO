@component('mail::message')

    Saludos,

    Su Solicitud de Permiso de Estadía se le ha asignado un visitador, con el siguiente detalle:

@component('mail::panel')
    <b>Nro. de Solicitud:</b> {{$solicitud}} <br>
    <b>Buque Registro Nro.:</b>  {{$matricula}} <br>
    <b>Solicitante:</b>  {{$nombres_solic}} {{$apellidos_solic}} <br>
    <b>Visitador:</b>  {{$visitador}} <br>
    <b>Fecha de Visita:</b>  {{$fecha_visita}} <br>

@endcomponent
@component('mail::subcopy')
    Instituto Nacional de Los Espacios Acuáticos - INEA. Síguenos en: <a href="http://twitter.com/#!/INEA200">http://twitter.com/#!/INEA200</a>

@endcomponent
@component('mail::footer')
    Sugerencia: Agregue {{$from}} a sus contactos de correo electrónico para así evitar recibir correo en spam.
    Gracias,
@endcomponent
@endcomponent
