<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisoEstadiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->create('permiso_estadias', function (Blueprint $table) {
            $table->id();
            $table->string('nro_solicitud');
            $table->foreignId('user_id')->constrained('public.users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('nombre_buque');
            $table->string('nro_registro');
            $table->string('tipo_buque');
            $table->string('nacionalidad_buque');
            $table->string('arqueo_bruto');
            $table->string('nombre_propietario');
            $table->string('nombre_capitan');
            $table->string('pasaporte_capitan');
            $table->integer('cant_tripulantes');
            $table->string('actividades');
            $table->string('puerto_origen');
            $table->foreignId('capitania_id')->constrained('public.capitanias')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('establecimiento_nautico_destino')->nullable();
            $table->foreign('establecimiento_nautico_destino')->references('id')->on('establecimiento_nauticos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('tiempo_estadia');
            $table->string('vigencia')->nullable();
            $table->bigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('pgsql_zarpes_schema')->dropIfExists('permiso_estadias');
    }
}
