<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialAsignacionesTable extends Migration
{
    public function up()
    {
        Schema::create('historial_asignaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plaza_trabajo_id');
            $table->unsignedBigInteger('analista_rrhh_id');
            $table->dateTime('fecha_asignacion');
            $table->dateTime('fecha_desasignacion')->nullable();
            $table->timestamps();

            $table->foreign('plaza_trabajo_id')->references('id')->on('plazas_trabajos');
            $table->foreign('analista_rrhh_id')->references('id')->on('usuarios');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historial_asignaciones');
    }
}
