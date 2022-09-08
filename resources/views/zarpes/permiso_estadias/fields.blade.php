<!-- Nombre Buque Field -->
<div class="row justify-content-center">
<span class="title-estadia">Datos Básicos del Buque</span>
<div class="form-group col-sm-3">
    {!! Form::label('nombre_buque', 'Nombre del Buque:') !!}
    {!! Form::text('nombre_buque', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Numero Registro Field -->
<div class="form-group col-sm-2">
    {!! Form::label('nro_registro', 'Nro. de Registro del Buque:') !!}
    {!! Form::text('nro_registro', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Tipo Buque Field -->
<div class="form-group col-sm-2">
    {!! Form::label('tipo_buque', 'Tipo de Buque:') !!}
    <select name="tipo_buque" id="tipo_buque" class="form-control custom-select" required>
        <option value="">Seleccione el tipo</option>
        <option value="deportivo">Deportivo</option>
        <option value="recreativo">Recreativo</option>
    </select>
</div>

<!-- Nacionalidad Buque Field -->
<div class="form-group col-sm-2" >
    {!! Form::label('paises', 'Nacionalidad del Buque:') !!}
    <select id="nacionalidad_buque" name="nacionalidad_buque"
            class="form-control custom-select"  required>
        <option value="">Seleccione la Nacionalidad</option>
        @foreach ($paises as $pais)
            <option value="{{$pais->name}}">{{$pais->name}} </option>
        @endforeach
    </select>
</div>

<!-- Propietario Field -->
<div class="form-group col-sm-3">
    {!! Form::label('nombre_propietario', 'Nombres del Propietario:') !!}
    {!! Form::text('nombre_propietario', null, ['class' => 'form-control', 'required']) !!}
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
    {!! Form::number('cant_tripulantes', null, ['class' => 'form-control', 'required','onKeyDown'=>"return soloNumeros(event)"]) !!}
</div>

    <div class="form-group col-sm-3">
        {!! Form::label('cant_pasajeros', 'Cantidad Máxima  de Personas a Bordo:') !!}
        {!! Form::number('cant_pasajeros', null, ['class' => 'form-control', 'required', 'style'=>'width: 64%;','onKeyDown'=>"return soloNumeros(event)"]) !!}
    </div>
    <hr class="dropdown-divider">
    <span class="title-estadia">Dimensiones Principales del Buque</span>
<!-- Arqueo Bruto Field -->
<div class="form-group col-sm-2">
    {!! Form::label('arqueo_bruto', 'Arqueo Bruto:') !!}
    {!! Form::number('arqueo_bruto', null, ['class' => 'form-control', 'required','onKeyDown'=>"return soloNumeros(event)"]) !!}
</div>
    <!-- Eslora Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('eslora', 'Eslora:') !!}
        {!! Form::text('eslora', null, ['class' => 'form-control', 'required','onKeyDown'=>"return soloNumeros(event)"]) !!}
    </div>

    <div class="form-group col-sm-2">
        {!! Form::label('potencia_kw', 'Potencia Motores KW:') !!}
        {!! Form::text('potencia_kw', null, ['class' => 'form-control', 'required','onKeyDown'=>"return soloNumeros(event)"]) !!}
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
    {!! Form::text('puerto_origen', null, ['class' => 'form-control'], 'required') !!}
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
            class="form-control custom-select {{ $errors->has("capitania_id")?"is-invalid":"" }}"  required>
        <option value="">Seleccione la Circunscripción</option>
        @foreach ($capitanias as $capitania)
            <option value="{{$capitania->id}}">{{$capitania->nombre}} </option>
        @endforeach
    </select>
    @error('capitania_id')
    <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>
    <!-- Puerto Origen Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('permanencia_marina', 'Establecimiento Náutico de Arribo:') !!}
        {!! Form::select('establecimiento_nautico_id',[], null, ['id'=>'establecimientos','class' => ' form-control custom-select','placeholder' => 'Escoja una Circunscripción para cargar los Establecimientos...']) !!}

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
        {!! Form::label('actividades', 'Actividades que Realizará:') !!}
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
    <div class='mx-4 my-2' id="msjEstadia"></div>

    <span class="title-estadia">Recaudos</span>
<div class="form-group col-sm-4">
    {!! Form::label('documento_1', 'Zarpe Original de Procedencia:') !!}
    <input type="file" class="form-control" name="zarpe_procedencia" id="zarpe_procedencia" accept="application/pdf, image/*" required  onchange="validarExtension('zarpe_procedencia','msjEstadia')">
</div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Registro de la Embarcación:') !!}
        <input type="file" class="form-control" name="registro_embarcacion" id="registro_embarcacion" accept="application/pdf, image/*" required onchange="validarExtension('registro_embarcacion','msjEstadia')">
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Despacho de Aduana de Procedencia:') !!}
        <input type="file" class="form-control" name="despacho_aduana_procedencia" id="despacho_aduana_procedencia" accept="application/pdf, image/*" required onchange="validarExtension('despacho_aduana_procedencia','msjEstadia')">
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Pasaportes de los Tripulantes:') !!}
        <input type="file" class="form-control" name="pasaportes_tripulantes" id="pasaporte_tripulantes" accept="application/pdf, image/*" required onchange="validarExtension('pasaporte_tripulantes','msjEstadia')">
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('documento_1', 'Nominación Agencia Naviera:') !!}
        <input type="file" class="form-control" name="nominacion_agencia" id="nominacion_agencia" accept="application/pdf, image/*" required onchange="validarExtension('nominacion_agencia','msjEstadia')">
    </div>

</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Generar Solicitud', ['class' => 'btn btn-primary']) !!}
</div>
