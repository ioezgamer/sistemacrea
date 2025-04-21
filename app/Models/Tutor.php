<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    // Especificar el nombre de la tabla
    protected $table = 'Tutores';

    // Definir la clave primaria
    protected $primaryKey = 'Tutor_Cedula';

    // Indicar que la clave primaria no es autoincremental
    public $incrementing = false;

    // Especificar el tipo de la clave primaria
    protected $keyType = 'string';

    // Desactivar los timestamps si la tabla no tiene created_at y updated_at
    public $timestamps = false;

    // Definir los campos rellenables
    protected $fillable = [
        'Tutor_Cedula',
        'Nombres',
        'Apellidos',
        'Telefono',
        'Direccion',
        'SectorEconomico',
        'NivelEducacionFormal',
        'TipoTutor',
        'Comunidad_ID',
        // No incluimos Participante_ID en $fillable, ya que debería manejarse a través de Participante_Tutor
    ];

    // Relación con Participante_Tutor
    public function participantes()
    {
        return $this->belongsToMany(Participante::class, 'Participante_Tutor', 'Tutor_Cedula', 'Participante_ID')
                    ->withPivot('Rol')
                    ->using(ParticipanteTutor::class);
    }
    // Relación con Comunidad (si existe el modelo Comunidad)
    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class, 'Comunidad_ID', 'Comunidad_ID');
    }
}