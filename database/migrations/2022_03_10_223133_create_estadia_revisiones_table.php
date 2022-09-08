<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadiaRevisionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('pgsql_zarpes_schema')->create('estadia_revisiones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('public.users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('permiso_estadia_id');
            $table->foreign('permiso_estadia_id')->references('id')->on('permiso_estadias')
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
        Schema::connection('pgsql_zarpes_schema')->dropIfExists('estadia_revisiones');
    }
}
