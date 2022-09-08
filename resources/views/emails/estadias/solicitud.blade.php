@component('mail::message')

    Estimado Ciudadano

    {{$mensaje}}

@component('mail::panel')
    <h2>Nro. de Solicitud: {{$solicitud}} </h2>
    <h2>Nombre Embarcación: {{$nombre_buque}} </h2>
    <h2>Buque Registro Nro.: {{$matricula}} </h2>
    <h2>Solicitante: {{$nombres_solic}} {{$apellidos_solic}}</h2>
@endcomponent
@component('mail::subcopy')
    Instituto Nacional de Los Espacios Acuáticos - INEA. Síguenos en: <a href="http://twitter.com/#!/INEA200">http://twitter.com/#!/INEA200</a>

@endcomponent
@component('mail::footer')
    Sugerencia: Agregue {{$from}} a sus contactos de correo electrónico para así evitar recibir correo en spam.
    Gracias,
@endcomponent
@endcomponent
