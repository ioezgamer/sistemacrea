<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    protected $table = 'participantes';
    protected $primaryKey = 'Participante_ID';
    public $incrementing = true;
    public $timestamps = false; // Desactiva timestamps
    protected $fillable = [
        'PrimerNombre', 'SegundoNombre', 'PrimerApellido', 'SegundoApellido',
        'FechaNacimiento', 'Edad', 'Genero', 'CedulaParticipante', 'Comunidad_ID',
        'Ciudad', 'Departamento', 'SectorEconomicoAdulto', 'NivelEducacionAdulto',
        'GradoActual', 'TurnoEscolar', 'RepiteGrado', 'AsisteOtrosProgramasComunidad',
        'DescripcionOtrosProgramas', 'TipoParticipante'
    ];

    // Relación con Comunidad
    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class, 'Comunidad_ID');
    }

    // Relación con Inscripcion
    public function inscripcion()
    {
        return $this->hasOne(Inscripcion::class, 'Participante_ID');
    }

    // Relación con Escuela
    public function escuela()
    {
        return $this->hasOne(Escuela::class, 'Participante_ID', 'Participante_ID');
    }
    
    // Relación muchos a muchos con Tutor
    public function tutores()
    {
        return $this->belongsToMany(Tutor::class, 'Participante_Tutor', 'Participante_ID', 'Tutor_Cedula')
                    ->withPivot('Rol')
                    ->using(ParticipanteTutor::class);
    }

    // Relación para el tutor principal (como HasOne)
    public function tutorPrincipalRelation()
    {
        return $this->hasOne(Tutor::class, 'Tutor_Cedula', 'Tutor_Cedula')
                    ->join('Participante_Tutor', 'Tutores.Tutor_Cedula', '=', 'Participante_Tutor.Tutor_Cedula')
                    ->where('Participante_Tutor.Participante_ID', $this->Participante_ID)
                    ->where('Participante_Tutor.Rol', 'principal');
    }

    // Relación para el tutor secundario (como HasOne)
    public function tutorSecundarioRelation()
    {
        return $this->hasOne(Tutor::class, 'Tutor_Cedula', 'Tutor_Cedula')
                    ->join('Participante_Tutor', 'Tutores.Tutor_Cedula', '=', 'Participante_Tutor.Tutor_Cedula')
                    ->where('Participante_Tutor.Participante_ID', $this->Participante_ID)
                    ->where('Participante_Tutor.Rol', 'secundario');
    }

    // Accessor para el tutor principal
    public function getTutorPrincipalAttribute()
    {
        return $this->tutorPrincipalRelation()->first();
    }

    // Accessor para el tutor secundario
    public function getTutorSecundarioAttribute()
    {
        return $this->tutorSecundarioRelation()->first();
    }

    public function asistencias()
{
    return $this->hasMany(Asistencia::class, 'Participante_ID');
}
    
}