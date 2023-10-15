<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvioCvsTable extends Migration
{
    public function up()
    {
        Schema::create('envio_cvs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plaza_trabajo_id');
            $table->unsignedBigInteger('candidato_id');
            $table->date('fecha_envio_cv');
            $table->string('numero_terna', 10);
            $table->timestamps();

            $table->foreign('plaza_trabajo_id')->references('id')->on('plazas_trabajos');
            $table->foreign('candidato_id')->references('id')->on('candidatos');
        });
    }

    public function down()
    {
        Schema::dropIfExists('envio_cvs');
    }
}
