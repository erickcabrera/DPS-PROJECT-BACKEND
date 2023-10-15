<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiltracionEntrevistasTable extends Migration
{
    public function up()
    {
        Schema::create('filtracion_entrevistas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plaza_trabajo_id');
            $table->unsignedBigInteger('candidato_id');
            $table->enum('estatus', ['Candidato contratado', 'Otro']);
            $table->timestamps();

            $table->foreign('plaza_trabajo_id')->references('id')->on('plazas_trabajos');
            $table->foreign('candidato_id')->references('id')->on('candidatos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('filtracion_entrevistas');
    }
}
