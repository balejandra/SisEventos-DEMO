<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutorizacionEventoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autorizaciones_eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nro_solicitud');
            $table->foreignId('user_id')->constrained('public.users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('nombre_evento');
            $table->date('fecha');
            $table->time('horario');
            $table->string('lugar');
            $table->integer('cant_organizadores');
            $table->integer('cant_asistentes');
            $table->string('nombre_contacto');
            $table->string('telefono_contacto');
            $table->string('email_contacto');
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
        Schema::dropIfExists('autorizacion_evento');
    }
}
