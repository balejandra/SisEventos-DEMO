<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::create('menus_roles', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('menu_id');
                $table->foreign('menu_id', 'fk_menurol_menu')->references('id')->on('menus')
                    ->onDelete('cascade')
                    ->onUpdate('restrict');
                $table->unsignedBigInteger('role_id');
                $table->foreign('role_id', 'fk_menurol_roles')->references('id')->on('roles')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
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
        Schema::dropIfExists('menus_roles');
    }
}
