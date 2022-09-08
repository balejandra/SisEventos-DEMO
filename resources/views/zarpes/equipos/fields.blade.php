<div class="row  ">
    <div class="col-md-3 "></div>

    <div class="col-sm-12 col-md-12 col-lg-6 border rounded">

        <div class="row p-3">

             <!-- Equipo Field -->
            <div class="form-group col-sm-6 ">
                {!! Form::label('equipo', 'Equipo:') !!}
                {!! Form::text('equipo', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-check form-switch col-sm-6 my-3">
                <input type="checkbox" name="cantidad" class="form-check-input" id="cantidad" value="false" style="margin-left: auto;"  onclick="javascript:inputcant()">
            &nbsp; <label class="form-check-label" for="flexSwitchCheckDefault" style="margin-inline-start: 30px;">Cantidad </label>
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('equipo', 'Otros:') !!}
                {!! Form::text('otros', null, ['class' => 'form-control']) !!}
            </div>

        </div>
        <div class="row">
            <!-- Submit Field -->
            <div class="form-group text-center col-sm-6">
                <a href="{{ route('equipos.index') }}" class="btn btn-light btncancelarZarpes">Cancelar</a>
            </div>
            <div class="form-group text-center col-sm-6">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}

            </div>

        </div>

    </div>

    <div class="col-md-3 "></div>
</div>


