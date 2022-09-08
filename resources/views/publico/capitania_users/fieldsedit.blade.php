@push('scripts')
    <script src="{{asset('js/buscador.js')}}"></script>
@endpush
<div class="row">
    <div class="form-group col-md-4 col-sm-12">
        {!! Form::label('cargo', 'Cargo:') !!}
        {!! Form::select('cargo',$roles, null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione un cargo','onchange="cargoCapitaniaUser();"']) !!}
    </div>

    <!-- User Id Field -->
    <div class="form-group col-md-4 col-sm-12">
        {!! Form::label('email_user', 'Email del Usuario:') !!}
        {!! Form::text('email_user', $capitaniaUser->user->email, ['id'=>'email_user','class' => 'form-control','placeholder' => 'Seleccione un usuario']) !!}
        <input type="text" name="user_id" id="user_id" value="{{$capitaniaUser->user->id}}" hidden>
    </div>
    <div class="col-md-4 col-sm-12">
        {!! Form::label('nombres', 'Nombres y Apellidos:') !!}
        <input type="text" id="nombres" value="{{$capitaniaUser->user->nombres}} {{$capitaniaUser->user->apellidos}}" class="form-control" disabled>
    </div>

    <!-- Capitania Id Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('capitania_id', 'Capitanía:') !!}
        {!! Form::select('capitania_id', $capitania, null, ['class' => 'form-control custom-select','placeholder' => 'Seleccione una capitania','onchange="EstablecimientoUser();"']) !!}
    </div>
    @if (($capitaniaUser->cargo==5) ||($capitaniaUser->cargo==6))
        <div class="form-group col-sm-6" id="divestablecimiento" style="display: block">
            @else
                <div class="form-group col-sm-6" id="divestablecimiento" style="display: none">
                    @endif
                    {!! Form::label('establecimientos', 'Establecimiento Náutico Asignado:') !!}
                    {!! Form::select('establecimiento_nautico_id',$establecimientos, null, ['id'=>'establecimientos','class' => ' form-control custom-select','placeholder' => 'Esta...']) !!}
                </div>

        <div class="form-group mt-4 col-sm-2">
            <label class="checkbox-inline">
                {!! Form::hidden('habilitado', 0) !!}
                {!! Form::checkbox('habilitado', '1') !!}
            </label>
            {!! Form::label('habilitado', 'Habilitado') !!}
        </div>
                <!-- Submit Field -->
                <div class="row form-group  mt-4">
                    <div class="col text-center">
                        <a href="{{route('capitaniaUsers.index')}} " class="btn btn-primary btncancelarZarpes">Cancelar</a>
                    </div>
                    <div class="col text-center">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
        </div>
