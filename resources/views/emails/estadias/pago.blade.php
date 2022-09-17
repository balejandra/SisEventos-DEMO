@component('mail::message')

    Saludos,
    A su Solicitud de Autorizacion de Evento N° {{$solicitud}} le ha sido aprobado el pago correspondiente, con el siguiente detalle:

@component('mail::panel')
    <h2>Nombre del Evento: {{$nombre_evento}}</h2>
    <h2>Solicitante:{{$nombres_solic}} {{$apellidos_solic}}</h2>
    <h2>Forma de Pago:{{$forma_pago}}</h2>
    <h2>Codigo Transaccion:</b> {{$codigo_transaccion}}</h2>
@endcomponent
@component('mail::subcopy')

@endcomponent
@component('mail::footer')
    Sugerencia: Agregue {{$from}} a sus contactos de correo electrónico para así evitar recibir correo en spam.
    Gracias,
@endcomponent
@endcomponent
