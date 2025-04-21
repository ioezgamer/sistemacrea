<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    protected $table = 'comunidad';
    protected $primaryKey = 'Comunidad_ID';
    public $incrementing = true;
    protected $fillable = ['NombreComunidad'];

    public function participantes()
    {
        return $this->hasMany(Participante::class, 'Comunidad_ID');
    }

    public function escuelas()
    {
        return $this->hasMany(Escuela::class, 'Comunidad_ID');
    }

    public function tutoresPrincipales()
    {
        return $this->hasMany(TutorPrincipal::class, 'Comunidad_ID');
    }

    public function tutoresSecundarios()
    {
        return $this->hasMany(TutorSecundario::class, 'Comunidad_ID');
    }
}
