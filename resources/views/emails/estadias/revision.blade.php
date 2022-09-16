@component('mail::message')

    Estimado Ciudadano

    {{$mensaje}}

@component('mail::panel')
    <h2>Nombre Evento: {{$nombre_evento}} </h2>
    <h2>Fecha y Hora Evento: {{$fecha}} {{$hora}} </h2>
    @if ($idstatus==2)
    <h2>Motivo Rechazo: {{$motivo}} </h2>
    @endif
@endcomponent
@component('mail::subcopy')

@endcomponent
@component('mail::footer')
    Sugerencia: Agregue {{$from}} a sus contactos de correo electrónico para así evitar recibir correo en spam.
    Gracias,
@endcomponent
@endcomponent
