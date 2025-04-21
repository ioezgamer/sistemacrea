<?php

require 'vendor/autoload.php';

use App\Models\Inscripcion;
use Illuminate\Support\Facades\DB;

// Configura el entorno de Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Migrar los datos de Subprogramas
$inscripciones = Inscripcion::all();

foreach ($inscripciones as $inscripcion) {
    // Migrar Subprogramas
    if (!is_null($inscripcion->Subprogramas)) {
        if (is_string($inscripcion->Subprogramas) && !empty($inscripcion->Subprogramas)) {
            // Si es una cadena, convertirla a un arreglo
            $subprogramasArray = array_map('trim', explode(',', $inscripcion->Subprogramas));
            $inscripcion->Subprogramas = $subprogramasArray; // Esto se guardará como JSON gracias al casting
            $inscripcion->save();
            echo "Migrado Subprogramas para Inscripcion ID: {$inscripcion->Inscripcion_ID} - Nuevo valor: " . json_encode($subprogramasArray) . "\n";
        } elseif (is_array($inscripcion->Subprogramas) && !empty($inscripcion->Subprogramas)) {
            // Si ya es un arreglo, asegurarse de que se guarde como JSON
            $inscripcion->Subprogramas = $inscripcion->Subprogramas;
            $inscripcion->save();
            echo "Subprogramas ya es un arreglo para Inscripcion ID: {$inscripcion->Inscripcion_ID} - Valor: " . json_encode($inscripcion->Subprogramas) . "\n";
        }
    }

    // Migrar DiasAsistenciaEsperados
    if (!is_null($inscripcion->DiasAsistenciaEsperados)) {
        if (is_string($inscripcion->DiasAsistenciaEsperados) && !empty($inscripcion->DiasAsistenciaEsperados)) {
            $diasArray = array_map('trim', explode(',', $inscripcion->DiasAsistenciaEsperados));
            $inscripcion->DiasAsistenciaEsperados = $diasArray;
            $inscripcion->save();
            echo "Migrado DiasAsistenciaEsperados para Inscripcion ID: {$inscripcion->Inscripcion_ID} - Nuevo valor: " . json_encode($diasArray) . "\n";
        } elseif (is_array($inscripcion->DiasAsistenciaEsperados) && !empty($inscripcion->DiasAsistenciaEsperados)) {
            $inscripcion->DiasAsistenciaEsperados = $inscripcion->DiasAsistenciaEsperados;
            $inscripcion->save();
            echo "DiasAsistenciaEsperados ya es un arreglo para Inscripcion ID: {$inscripcion->Inscripcion_ID} - Valor: " . json_encode($inscripcion->DiasAsistenciaEsperados) . "\n";
        }
    }
}

echo "Migración de datos completada.\n";