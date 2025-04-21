<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'Inscripciones';
    protected $primaryKey = 'Inscripcion_ID';
    public $incrementing = true;
    public $timestamps = false; // Desactiva timestamps
    protected $fillable = [
        'Participante_ID',
        'Programa_ID',
        'FechaInscripcion',
        'DiasAsistenciaEsperados',
        'ExpectativasTutorPrincipal',
        'Activo',
        'LugarEncuentro_ID', // Nueva columna
        'Subprogramas', // Nueva columna
    ];
    protected $casts = [
        'Subprogramas' => 'array',
        'DiasAsistenciaEsperados' => 'array',
    ];
    public function documentacion()
    {
        return $this->hasOne(DocumentacionRequerida::class, 'Inscripcion_ID', 'Inscripcion_ID');
    }
    public function participante()
    {
        return $this->belongsTo(Participante::class, 'Participante_ID');
    }

    public function lugarEncuentro()
    {
        return $this->belongsTo(LugarEncuentro::class, 'LugarEncuentro_ID', 'LugarEncuentro_ID');
    }
    // Inscripcion.php
public function programa()
{
    return $this->belongsTo(Programa::class, 'Programa_ID');
}

}
