<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosmedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('horariosmedicos')) {
            Schema::create('horariosmedicos', function (Blueprint $table) {
                $table->increments('idHorariosMedicos');
                $table->unsignedInteger('idSucursalMedico');
                $table->string('dia', 10);
                $table->time('horaInicio');
                $table->time('horaFin');
                $table->foreign('idSucursalMedico')->references('idSucursalesMedicos')->on('sucursalesmedicos')->onDelete('cascade');
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
        Schema::dropIfExists('horariosmedicos');
    }
}
