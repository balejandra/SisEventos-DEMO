@component('mail::message')

    Saludos

    Notificacion URGENTE, la siguiente embarcación presenta 2 horas de retraso de su arribo a destino programado

@component('mail::panel')
    <h2>Nro. de Solicitud: {{$codigo}} </h2>
    <br>
    <h2>Buque Matrícula Nro: {{$buque}} </h2>
    <br>
    <h2>Fecha Llegada: {{$hora_llegada}} </h2>
@endcomponent
    Para más detalles ingrese a la página web:

@component('mail::button', ['url' => env('APP_URL')])
    INEA
@endcomponent

    Sugerencia: Agregue {{$from}} a sus contactos de correo electrónico para así evitar recibir correo en spam.
    Gracias,
@endcomponent
