<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropuestasTable extends Migration
{
    public function up()
    {
        Schema::create('propuestas', function (Blueprint $table) {
            $table->id();
            $table->date('FechaEnvioPropuesta');
            $table->foreignId('UsuarioEjecutivoComercialID')->constrained('usuarios'); // Relación con la tabla de usuarios
            $table->foreignId('ClienteID')->constrained('clientes'); // Relación con la tabla de clientes
            $table->string('TipoPropuestaEnviada');
            $table->decimal('MontoPropuesta', 10, 2);
            $table->decimal('Descuento', 5, 2);
            $table->enum('EstadoPropuesta', ['Pendiente', 'En Proceso', 'Ganada', 'Perdida', 'Otro']);
            $table->dateTime('FechaActualizacionSeguimiento')->nullable();
            $table->text('ComentariosSeguimiento')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('propuestas');
    }
};
