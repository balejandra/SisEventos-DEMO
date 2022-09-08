<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoPermisoEstadiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->create('documento_permiso_estadia', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('permiso_estadia_id');
            $table->foreign('permiso_estadia_id')->references('id')->on('permiso_estadias')
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
        Schema::connection('pgsql_zarpes_schema')->dropIfExists('documento_permiso_estadia');
    }
}
