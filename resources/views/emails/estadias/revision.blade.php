@component('mail::message')

    Estimado Ciudadano

    {{$mensaje}}

@component('mail::panel')
    <h2>Nombre Embarcación: {{$nombre_buque}} </h2>
    <h2>Buque Registro Nro.: {{$matricula}} </h2>
    @if ($idstatus==2)
    <h2>Motivo Rechazo: {{$motivo}} </h2>
    @endif
@endcomponent
@component('mail::subcopy')
    Instituto Nacional de Los Espacios Acuáticos - INEA. Síguenos en: <a href="http://twitter.com/#!/INEA200">http://twitter.com/#!/INEA200</a>

@endcomponent
@component('mail::footer')
    Sugerencia: Agregue {{$from}} a sus contactos de correo electrónico para así evitar recibir correo en spam.
    Gracias,
@endcomponent
@endcomponent
