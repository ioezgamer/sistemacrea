<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToParticipanteTutorTable extends Migration
{
    public function up()
    {
        Schema::table('Participante_Tutor', function (Blueprint $table) {
            $table->foreign('Tutor_Cedula')
                  ->references('Tutor_Cedula')
                  ->on('Tutores')
                  ->onDelete('cascade'); // Si se elimina un tutor, también se elimina la relación
        });
    }

    public function down()
    {
        Schema::table('Participante_Tutor', function (Blueprint $table) {
            $table->dropForeign(['Tutor_Cedula']);
        });
    }
}
