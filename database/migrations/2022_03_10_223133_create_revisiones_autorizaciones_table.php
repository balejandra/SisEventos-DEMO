<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionesAutorizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisiones_autorizaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('public.users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('autorizacion_evento_id');
            $table->foreign('autorizacion_evento_id')->references('id')->on('autorizaciones_eventos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('accion');
            $table->string('motivo');
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
        Schema::dropIfExists('revisiones_autorizaciones');
    }
}
