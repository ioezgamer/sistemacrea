<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    protected $table = 'Escuelas';
    protected $primaryKey = 'Escuela_ID';
    public $incrementing = true;
    public $timestamps = false; // Desactiva timestamps
    protected $fillable = ['Participante_ID', 'NombreEscuela', 'Comunidad_ID'];

    public function participante()
    {
        return $this->belongsTo(Participante::class, 'Participante_ID');
    }

    public function comunidad()
    {
        return $this->belongsTo(Comunidad::class, 'Comunidad_ID');
    }
}