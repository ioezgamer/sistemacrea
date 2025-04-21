<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    protected $table = 'programas'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'Programa_ID'; // Nombre de la clave primaria

    public $timestamps = false; // Si no usás created_at y updated_at

    protected $fillable = ['NombrePrograma', 'LugarEncuentro']; // Columnas que se pueden llenar en asignación masiva

    // Relación con Asistencias
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'Programa_ID');
    }
}
