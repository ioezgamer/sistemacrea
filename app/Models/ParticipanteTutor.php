<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ParticipanteTutor extends Pivot
{
    // Especificar el nombre de la tabla
    protected $table = 'Participante_Tutor';

    // Desactivar los timestamps si la tabla no tiene created_at y updated_at
    public $timestamps = false;

    // Definir los campos que se pueden rellenar
    protected $fillable = [
        'Participante_ID',
        'Tutor_Cedula',
        'Rol',
    ];

    // Relación con el modelo Participante
    public function participante()
    {
        return $this->belongsTo(Participante::class, 'Participante_ID', 'Participante_ID');
    }

    // Relación con el modelo Tutor
    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'Tutor_Cedula', 'Tutor_Cedula');
    }
}