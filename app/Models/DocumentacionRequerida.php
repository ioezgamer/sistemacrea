<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentacionRequerida extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'DocumentacionRequerida';

    // Clave primaria
    protected $primaryKey = 'Documentacion_ID';

    // Indicar que la clave primaria es autoincremental
    public $incrementing = true;

    // Deshabilitar timestamps, ya que la tabla no tiene created_at ni updated_at
    public $timestamps = false;

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'Inscripcion_ID',
        'TieneCedula',
        'TienePartidaNacimiento',
        'TieneBoletinDiploma',
        'TieneCopiaCedulaTutor',
    ];

    // Definir la relación con el modelo Participante
    public function inscripcion()
    {
        return $this->belongsTo(Inscripcion::class, 'Inscripcion_ID', 'Inscripcion_ID');
    }

    // Castear los campos BIT a boolean para un manejo más natural en PHP
    protected $casts = [
        'TieneCedula' => 'boolean',
        'TienePartidaNacimiento' => 'boolean',
        'TieneBoletinDiploma' => 'boolean',
        'TieneCopiaCedulaTutor' => 'boolean',
    ];
}