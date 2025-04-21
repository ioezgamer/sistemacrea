<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorPrincipal extends Model
{
    protected $table = 'Tutores';
    protected $primaryKey = 'Tutor_Cedula';
    public $incrementing = true;
    public $timestamps = false; // Desactiva timestamps
    protected $fillable = [
        'Participante_ID', 'TipoTutor', 'Tutor_Cedula', 'Nombres', 'Apellidos',
        'Comunidad_ID', 'Direccion', 'Telefono', 'SectorEconomico', 'NivelEducacionFormal'
    ];

    public function participante()
    {
        return $this->belongsTo(Participante::class, 'Participante_ID');
    }

    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class, 'Comunidad_ID');
    }
}