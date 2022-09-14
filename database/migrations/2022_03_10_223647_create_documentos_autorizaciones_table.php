<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosAutorizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_autorizaciones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('autorizacion_evento_id');
            $table->foreign('autorizacion_evento_id')->references('id')->on('autorizaciones_eventos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('recaudo');
            $table->string('documento');
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
        Schema::dropIfExists('documentos_autorizaciones');
    }
}
