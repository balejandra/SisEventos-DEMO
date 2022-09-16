<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_eventos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('autorizacion_evento_id');
            $table->foreign('autorizacion_evento_id')->references('id')->on('autorizaciones_eventos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->double('monto_pagar_petros');
            $table->double('monto_pagar_bolivares');
            $table->string('forma_pago')->nullable();
            $table->string('codigo_transaccion')->nullable();
            $table->string('fecha_pago')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos_eventos');
    }
}
