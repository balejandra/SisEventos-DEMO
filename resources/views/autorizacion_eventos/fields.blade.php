<!-- Nro Solicitud Field -->
<div class="row justify-content-center">
    <div id="msjRuta"></div>
<!-- Nombre Evento Field -->
<div class="form-group col-sm-4">
    {!! Form::label('nombre_evento', 'Nombre Evento:') !!}
    {!! Form::text('nombre_evento', null, ['class' => 'form-control']) !!}
</div>
<!-- Fecha Field -->
<div class="form-group col-sm-3">
    {!! Form::label('fecha', 'Fecha:') !!}
    <input type="date" name="fecha" class="form-control" id="fecha" onblur="Fecha15dias()" >
</div>

<!-- Horario Field -->
<div class="form-group col-sm-3">
    {!! Form::label('horario', 'Horario:') !!}
    {!! Form::time('horario', null, ['class' => 'form-control']) !!}
</div>

<!-- Lugar Field -->
<div class="form-group col-sm-4">
    {!! Form::label('lugar', 'Lugar:') !!}
    {!! Form::text('lugar', null, ['class' => 'form-control']) !!}
</div>

<!-- Cant Organizadores Field -->
<div class="form-group col-sm-3">
    {!! Form::label('cant_organizadores', 'Cantidad Organizadores:') !!}
    {!! Form::number('cant_organizadores', null, ['class' => 'form-control']) !!}
</div>

<!-- Cant Asistentes Field -->
<div class="form-group col-sm-3">
    {!! Form::label('cant_asistentes', 'Cantidad Asistentes:') !!}
    {!! Form::number('cant_asistentes', null, ['class' => 'form-control']) !!}
</div>

<!-- Nombre Contacto Field -->
<div class="form-group col-sm-4">
    {!! Form::label('nombre_contacto', 'Nombre Contacto:') !!}
    {!! Form::text('nombre_contacto', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefono Contacto Field -->
<div class="form-group col-sm-4">
    {!! Form::label('telefono_contacto', 'Teléfono Contacto:') !!}
    {!! Form::text('telefono_contacto', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Contacto Field -->
<div class="form-group col-sm-4">
    {!! Form::label('email_contacto', 'Email Contacto:') !!}
    {!! Form::email('email_contacto', null, ['class' => 'form-control']) !!}
</div>
    <span class="title-estadia">Recaudos</span>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Cédula de Identidad del Solicitante y responsable Legal:') !!}
        <input type="file" class="form-control" name="cedula" id="cedula" accept="application/pdf, image/*" required  onchange="validarExtension('cedula','msjEstadia')">
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Registro de Información Fiscal (RIF) Vigente:') !!}
        <input type="file" class="form-control" name="RIF" id="RIF" accept="application/pdf, image/*" required  onchange="validarExtension('RIF','msjEstadia')">
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Acta Constitutiva Estatutaria de la empresa (en caso de ser una persona jurídica):') !!}
        <input type="file" class="form-control" name="acta_constitutiva" id="acta_constitutiva" accept="application/pdf, image/*"  onchange="validarExtension('acta_constitutiva','msjEstadia')">
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Registro de Información Fiscal (RIF) de la empresa (Vigente) (en caso de ser una persona jurídica):') !!}
        <input type="file" class="form-control" name="RIF_empresa" id="RIF_empresa" accept="application/pdf, image/*"  onchange="validarExtension('RIF_empresa','msjEstadia')">
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Listado de comidas que se consumirán:') !!}
        <input type="file" class="form-control" name="listado_comidas" id="listado_comidas" accept="application/pdf, image/*" required onchange="validarExtension('listado_comidas','msjEstadia')">
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Listado de bebidas que se consumirán:') !!}
        <input type="file" class="form-control" name="listado_bebidas" id="listado_bebidas" accept="application/pdf, image/*" required onchange="validarExtension('listado_bebidas','msjEstadia')">
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Listado de Precio por persona que será cancelado por el evento (si aplica):') !!}
        <input type="file" class="form-control" name="listado_precios" id="listado_precios" accept="application/pdf, image/*" onchange="validarExtension('listado_precios','msjEstadia')">
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Listado de equipos a utilizar (si aplica):') !!}
        <input type="file" class="form-control" name="listado_equipos" id="listado_equipos" accept="application/pdf, image/*" onchange="validarExtension('listado_equipos','msjEstadia')">
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Pago de Tasa de Solicitud:') !!}
        <input type="file" class="form-control" name="pago_solicitud" id="pago_solicitud" accept="application/pdf, image/*" required onchange="validarExtension('pago_solicitud','msjEstadia')">
    </div>

</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Generar Solicitud', ['class' => 'btn btn-primary']) !!}
</div>
