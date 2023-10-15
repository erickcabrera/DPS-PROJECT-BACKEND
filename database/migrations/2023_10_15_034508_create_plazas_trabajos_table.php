<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlazasTrabajosTable extends Migration
{
    public function up()
    {
        Schema::create('plazas_trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_plaza');
            $table->unsignedBigInteger('propuesta_id');
            $table->unsignedBigInteger('usuario_recurso_humanos_id');
            $table->decimal('salario', 10, 2);
            $table->integer('cantidad_solicitada');
            $table->date('fecha_recepcion_validacion_perfil');
            $table->date('fecha_modificacion_perfil')->nullable();
            $table->date('fecha_publicacion_perfil');
            $table->enum('estatus', ['Cerrado', 'Cancelado', 'Otro']);
            $table->date('fecha_finalizacion')->nullable();
            $table->timestamps();

            $table->foreign('propuesta_id')->references('id')->on('propuestas');
            $table->foreign('usuario_recurso_humanos_id')->references('id')->on('usuarios');
        });
    }

    public function down()
    {
        Schema::dropIfExists('plazas_trabajos');
    }
}
