<!-- Nombre Buque Field -->
<div class="row justify-content-center">
<span class="title-estadia">Datos Básicos del Buque</span>
<div class="form-group col-sm-3">
    {!! Form::label('nombre_buque', 'Nombre del  Buque:') !!}
    {!! Form::text('nombre_buque', $permiso->nombre_buque, ['class' => 'form-control', 'required','readonly']) !!}
</div>

<!-- Numero Registro Field -->
<div class="form-group col-sm-2">
    {!! Form::label('nro_registro', 'Nro. de Registro del Buque:') !!}
    {!! Form::text('nro_registro', $permiso->nro_registro, ['class' => 'form-control', 'required','readonly']) !!}
</div>

<!-- Tipo Buque Field -->
<div class="form-group col-sm-2">
    {!! Form::label('tipo_buque', 'Tipo de Buque:') !!}
    <select name="tipo_buque" id="tipo_buque" class="form-control custom-select" required>
        <option value="">Seleccione el tipo de Buque</option>
        <option value="deportivo">Deportivo</option>
        <option value="recreativo">Recreativo</option>
    </select>
</div>

<!-- Nacionalidad Buque Field -->
<div class="form-group col-sm-2" >
    {!! Form::label('tipo_buque', 'Nacionalidad del Buque:') !!}
    <input type="text" name="nacionalidad_buque" value="{{$permiso->nacionalidad_buque}}" readonly class="form-control">
</div>
<!-- Propietario Field -->
<div class="form-group col-sm-3">
    {!! Form::label('nombre_propietario', 'Nombre del Propietario:') !!}
    {!! Form::text('nombre_propietario', $permiso->nombre_propietario, ['class' => 'form-control', 'required','readonly']) !!}
</div>
    <hr class="dropdown-divider">
    <span class="title-estadia">Datos de la Tripulación</span>
<!-- Pasaporte Capitan Field -->
<div class="form-group col-sm-3">
    {!! Form::label('pasaporte_capitan', 'Nro. Pasaporte del Capitán:') !!}
    {!! Form::text('pasaporte_capitan', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Nombrescompletos Capitan Field -->
<div class="form-group col-sm-3">
    {!! Form::label('nombre_capitan', 'Nombre y Apellido del Capitán:') !!}
    {!! Form::text('nombre_capitan', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Eslora Field -->
<div class="form-group col-sm-2">
    {!! Form::label('cant_tripulantes', 'Cantidad de Tripulantes:') !!}
    {!! Form::number('cant_tripulantes', null, ['class' => 'form-control', 'required']) !!}
</div>
<div class="form-group col-sm-3">
    {!! Form::label('cant_pasajeros', 'Cantidad máxima  de personas a bordo:') !!}
    {!! Form::number('cant_pasajeros', null, ['class' => 'form-control', 'required','style'=>'width: 64%;']) !!}

</div>
    <hr class="dropdown-divider">
    <span class="title-estadia">Dimensiones Principales del Buque</span>
<!-- Arqueo Bruto Field -->
<div class="form-group col-sm-2">
    {!! Form::label('arqueo_bruto', 'Arqueo Bruto:') !!}
    <input type="text" name="arqueo_bruto" id="arqueo_bruto" class="form-control" readonly required value="{{$permiso->arqueo_bruto}}">
</div>
    <!-- Eslora Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('eslora', 'Eslora:') !!}
        {!! Form::text('eslora', $permiso->eslora, ['class' => 'form-control', 'required','readonly']) !!}
    </div>

    <div class="form-group col-sm-2">
        {!! Form::label('potencia_kw', 'Potencia Motores KW:') !!}
        {!! Form::text('potencia_kw', $permiso->potencia_kw, ['class' => 'form-control', 'required','readonly']) !!}
    </div>
    <div class="form-group col-sm-2">
        {!! Form::label('puntal', 'Puntal:') !!}
        {!! Form::text('puntal', null, ['class' => 'form-control', 'required','onKeyDown'=>"return soloNumeros(event)"]) !!}
    </div>
    <div class="form-group col-sm-2">
        {!! Form::label('manga', 'Manga:') !!}
        {!! Form::text('manga', null, ['class' => 'form-control', 'required','onKeyDown'=>"return soloNumeros(event)"]) !!}
    </div>
    <hr class="dropdown-divider">
    <span class="title-estadia">Procedencia y Permanencia</span>

<!-- Puerto Origen Field -->
<div class="form-group col-sm-3">
    {!! Form::label('puerto_origen', 'Puerto de Origen / País:') !!}
    {!! Form::text('puerto_origen', null, ['class' => 'form-control', 'required','readonly']) !!}
</div>
    <!-- Puerto Origen Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('ultimo_puerto_zarpe', 'Zarpe Último Puerto:') !!}
        {!! Form::text('ultimo_puerto_zarpe', null, ['class' => 'form-control'], 'required') !!}
    </div>
<!-- Ultimo Puertovisitado Field -->
<div class="form-group col-sm-3">
    {!! Form::label('capitania_id', 'Circunscripción Acuática de Arribo:') !!}
    <select id="capitania_id" name="capitania_id" onclick="EstablecimientoFindNautico();"
            class="form-control custom-select" required>
        <option value="">Seleccione la Circunscripción</option>
        @foreach ($capitanias as $capitania)
            <option value="{{$capitania->id}}">{{$capitania->nombre}} </option>
        @endforeach
    </select>
</div>

    <!-- Puerto Origen Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('permanencia_marina', 'Establecimiento Náutico de Arribo:') !!}
        {!! Form::select('establecimiento_nautico_id',[], null, ['id'=>'establecimientos','class' => ' form-control custom-select','placeholder' => 'Escoja una Capitanía para cargar los Establecimientos...']) !!}

    </div>
    <div class="form-group col-sm-2">
        @php
            $fechaActual=new DateTime();
            $fechaActual->setTimeZone(new DateTimeZone('America/Caracas'));
            $fechaActual=$fechaActual->format('Y-m-d');
        @endphp
        {!! Form::label('fecha_arribo', 'Fecha de Arribo:') !!}
        <input type="date" name="fecha_arribo" class="form-control" min="{{$fechaActual}}" max="9999-12-31" required >
    </div>

    <div class="form-group col-sm-3">
        {!! Form::label('actividades', 'Actividades que realizara:') !!}
        <select name="actividades" id="actividades" class="form-control custom-select" required>
            <option value="">Seleccione la Actividad</option>
            <option value="deportivo">Deportivo</option>
            <option value="recreativo">Recreativo</option>
            <option value="cambio de bandera">Cambio de Bandera</option>
            <option value="mantenimiento">Mantenimiento</option>
        </select>
    </div>
    <!-- Tiempo Estadia Field -->
<div class="form-group col-sm-2">
    {!! Form::label('tiempo_estadia', 'Vigencia:') !!}
    <input type="text" name="tiempo_estadia" readonly value="90 días" id="tiempo_estadia" class="form-control">
</div>

    <hr class="dropdown-divider">

    <div class='mx-4 my-2' id="msjEstadia2"></div>

    <span class="title-estadia">Recaudos</span>
<div class="form-group col-sm-4">
    {!! Form::label('documento_1', 'Zarpe original de procedencia:') !!}
    <input type="file" class="form-control" name="zarpe_procedencia" id="zarpe_procedencia" accept="application/pdf" required onchange="validarExtension('zarpe_procedencia','msjEstadia2')">
</div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Registro de la embarcación:') !!}
        <input type="file" class="form-control" name="registro_embarcacion" id="registro_embarcacion" accept="application/pdf" required  onchange="validarExtension('registro_embarcacion','msjEstadia2')">
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Despacho de aduana de procedencia:') !!}
        <input type="file" class="form-control" name="despacho_aduana_procedencia" id="despacho_aduana_procedencia" accept="application/pdf" required onchange="validarExtension('despacho_aduana_procedencia','msjEstadia2')">
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Pasaportes de los tripulantes:') !!}
        <input type="file" class="form-control" name="pasaportes_tripulantes" id="pasaporte_tripulantes" accept="application/pdf" required onchange="validarExtension('pasaporte_tripulantes','msjEstadia2')">
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Nominación Agencia Naviera:') !!}
        <input type="file" class="form-control" name="nominacion_agencia" id="nominacion_agencia" accept="application/pdf, image/*" required onchange="validarExtension('nominacion_agencia','msjEstadia2')">
    </div>
</div>
<!-- Submit Field -->
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Generar Solicitud', ['class' => 'btn btn-primary']) !!}
</div>
