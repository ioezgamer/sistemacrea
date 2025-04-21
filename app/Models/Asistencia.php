<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'Asistencias';
    protected $primaryKey = 'Asistencia_ID';
    public $timestamps = false;

    protected $fillable = [
        'Participante_ID',
        'Programa_ID',
        'Fecha',
        'Estado',
    ];

    // Relación con Participante
    public function participante()
    {
        return $this->belongsTo(Participante::class, 'Participante_ID');
    }

    // Relación con Programa
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'Programa_ID');
    }
}