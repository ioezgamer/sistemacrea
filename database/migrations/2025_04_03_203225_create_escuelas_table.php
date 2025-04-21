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
        Schema::create('escuelas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo_centro')->nullable();
            $table->string('direccion')->nullable();
            $table->unsignedBigInteger('comunidad_id')->nullable();
            $table->timestamps();

            // Relación con comunidades
            $table->foreign('comunidad_id')->references('id')->on('comunidades')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escuelas');
    }
};
