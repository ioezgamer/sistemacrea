<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('participantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('cedula')->unique();
            $table->date('fecha_nacimiento')->nullable();
            $table->unsignedBigInteger('comunidad_id')->nullable(); // Ejemplo de FK a comunidad
            $table->timestamps();

            // Clave foránea (si ya tenés una tabla "comunidads")
            $table->foreign('comunidad_id')
                  ->references('id')
                  ->on('comunidades')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participantes');
    }
};
