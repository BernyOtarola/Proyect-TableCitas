<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspecialidadessucursalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('especialidadessucursal')) {
            Schema::create('especialidadessucursal', function (Blueprint $table) {
                $table->increments('idEspecialidadesSucursal');
                $table->unsignedInteger('sucursal');
                $table->unsignedInteger('especialidad');
                $table->foreign('sucursal')->references('idSucursal')->on('sucursal')->onDelete('cascade');
                $table->foreign('especialidad')->references('idEspecialidad')->on('especialidades')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especialidadessucursal');
    }
}
