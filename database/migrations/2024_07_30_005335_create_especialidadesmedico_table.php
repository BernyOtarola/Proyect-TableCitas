<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspecialidadesmedicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('especialidadesmedico')) {
            Schema::create('especialidadesmedico', function (Blueprint $table) {
                $table->increments('idEspecidadesMedico');
                $table->unsignedInteger('medico');
                $table->unsignedInteger('especialidad');
                $table->foreign('medico')->references('idMedicos')->on('medicos')->onDelete('cascade');
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
        Schema::dropIfExists('especialidadesmedico');
    }
}
