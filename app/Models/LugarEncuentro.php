<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LugarEncuentro extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'LugaresEncuentro';

    // Clave primaria
    protected $primaryKey = 'LugarEncuentro_ID';

    // Indicar que la clave primaria es autoincremental
    public $incrementing = true;

    // Deshabilitar timestamps, ya que la tabla no tiene created_at ni updated_at
    public $timestamps = false;

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'NombreLugar',
    ];

    // Relación con Inscripcion (un lugar de encuentro puede tener muchas inscripciones)
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'LugarEncuentro_ID', 'LugarEncuentro_ID');
    }
}