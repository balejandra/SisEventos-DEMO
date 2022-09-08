<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitaPermisoEstadiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->create('visita_permiso_estadias', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('permiso_estadia_id');
            $table->foreign('permiso_estadia_id')->references('id')->on('permiso_estadias')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('nombre_visitador');
            $table->date('fecha_visita')->nullable();
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
        Schema::connection('pgsql_zarpes_schema')->dropIfExists('visita_permiso_estadias');
    }
}
