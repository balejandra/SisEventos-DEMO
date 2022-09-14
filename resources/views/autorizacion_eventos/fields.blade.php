<!-- Nro Solicitud Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nro_solicitud', 'Nro Solicitud:') !!}
    {!! Form::text('nro_solicitud', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Nombre Evento Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre_evento', 'Nombre Evento:') !!}
    {!! Form::text('nombre_evento', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha', 'Fecha:') !!}
    {!! Form::text('fecha', null, ['class' => 'form-control','id'=>'fecha']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#fecha').datetimepicker({
               format: 'YYYY-MM-DD HH:mm:ss',
               useCurrent: true,
               icons: {
                   up: "icon-arrow-up-circle icons font-2xl",
                   down: "icon-arrow-down-circle icons font-2xl"
               },
               sideBySide: true
           })
       </script>
@endpush


<!-- Horario Field -->
<div class="form-group col-sm-6">
    {!! Form::label('horario', 'Horario:') !!}
    {!! Form::text('horario', null, ['class' => 'form-control']) !!}
</div>

<!-- Lugar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lugar', 'Lugar:') !!}
    {!! Form::text('lugar', null, ['class' => 'form-control']) !!}
</div>

<!-- Cant Organizadores Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cant_organizadores', 'Cant Organizadores:') !!}
    {!! Form::number('cant_organizadores', null, ['class' => 'form-control']) !!}
</div>

<!-- Cant Asistentes Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cant_asistentes', 'Cant Asistentes:') !!}
    {!! Form::number('cant_asistentes', null, ['class' => 'form-control']) !!}
</div>

<!-- Nombre Contacto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nombre_contacto', 'Nombre Contacto:') !!}
    {!! Form::text('nombre_contacto', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefono Contacto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefono_contacto', 'Telefono Contacto:') !!}
    {!! Form::text('telefono_contacto', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Contacto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_contacto', 'Email Contacto:') !!}
    {!! Form::email('email_contacto', null, ['class' => 'form-control']) !!}
</div>

<!-- Vigencia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vigencia', 'Vigencia:') !!}
    {!! Form::text('vigencia', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_id', 'Status Id:') !!}
    {!! Form::text('status_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('autorizacionEventos.index') }}" class="btn btn-secondary">Cancel</a>
</div>
