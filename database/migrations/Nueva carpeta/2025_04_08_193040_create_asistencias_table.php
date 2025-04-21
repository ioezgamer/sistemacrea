<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciasTable extends Migration
{
    public function up()
    {
        Schema::create('Asistencias', function (Blueprint $table) {
            $table->id('Asistencia_ID');
            $table->unsignedBigInteger('Programa_ID');
            $table->date('Fecha');
            $table->enum('Estado', ['Presente', 'Ausente', 'Justificado'])->default('Ausente');
            $table->timestamps();

            $table->integer('Participante_ID');
            $table->foreign('Participante_ID')->references('Participante_ID')->on('Participantes')->onDelete('cascade');
            

            // Índice único para evitar registros duplicados por participante, programa y fecha
            $table->unique(['Participante_ID', 'Programa_ID', 'Fecha']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('Asistencias');
    }
}