<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use App\Models\Participante;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    // Mostrar el formulario para tomar asistencia
    public function index(Request $request)
    {
        $programas = Programa::all();
        $programa_id = $request->input('programa_id');
        $fecha_inicio = $request->input('fecha_inicio', Carbon::now()->startOfWeek()->format('Y-m-d')); // Lunes de la semana actual
        $fecha_fin = Carbon::parse($fecha_inicio)->endOfWeek()->subDays(2)->format('Y-m-d'); // Viernes de la semana actual

        $participantes = [];
        $asistencias = [];
        $diasSemana = [
            'Lunes' => Carbon::parse($fecha_inicio)->format('Y-m-d'),
            'Martes' => Carbon::parse($fecha_inicio)->addDays(1)->format('Y-m-d'),
            'Miércoles' => Carbon::parse($fecha_inicio)->addDays(2)->format('Y-m-d'),
            'Jueves' => Carbon::parse($fecha_inicio)->addDays(3)->format('Y-m-d'),
            'Viernes' => Carbon::parse($fecha_inicio)->addDays(4)->format('Y-m-d'),
        ];

        if ($programa_id) {
            // Obtener participantes inscritos en el programa
            $participantes = Participante::whereHas('inscripcion', function ($query) use ($programa_id) {
                $query->where('Programa_ID', $programa_id);
            })
            ->with([
                'comunidad',
                'inscripcion.programa',
                'asistencias' => function ($query) use ($fecha_inicio, $fecha_fin, $programa_id) {
                    $query->whereBetween('Fecha', [$fecha_inicio, $fecha_fin])
                          ->where('Programa_ID', $programa_id);
                }
            ])
            ->get();

            // Preparar asistencias para mostrar
            foreach ($participantes as $participante) {
                $asistencias[$participante->Participante_ID] = [];
                foreach ($diasSemana as $dia => $fecha) {
                    $asistencia = $participante->asistencias->firstWhere('Fecha', $fecha);
                    $asistencias[$participante->Participante_ID][$dia] = $asistencia ? $asistencia->Estado : 'Ausente';
                }

                // Calcular total asistido y porcentaje
                $totalAsistido = $participante->asistencias->where('Estado', 'Presente')->count();
                $totalDias = count($diasSemana);
                $porcentaje = $totalDias > 0 ? ($totalAsistido / $totalDias) * 100 : 0;

                $participante->totalAsistido = $totalAsistido;
                $participante->porcentajeAsistencia = round($porcentaje, 2);
            }
        }

        return view('asistencia.index', compact('programas', 'programa_id', 'participantes', 'asistencias', 'diasSemana', 'fecha_inicio'));
    }

    // Guardar la asistencia
    public function store(Request $request)
    {
        $programa_id = $request->input('programa_id');
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = Carbon::parse($fecha_inicio)->endOfWeek()->subDays(2)->format('Y-m-d');
        $asistencias = $request->input('asistencias', []);

        $diasSemana = [
            'Lunes' => Carbon::parse($fecha_inicio)->format('Y-m-d'),
            'Martes' => Carbon::parse($fecha_inicio)->addDays(1)->format('Y-m-d'),
            'Miércoles' => Carbon::parse($fecha_inicio)->addDays(2)->format('Y-m-d'),
            'Jueves' => Carbon::parse($fecha_inicio)->addDays(3)->format('Y-m-d'),
            'Viernes' => Carbon::parse($fecha_inicio)->addDays(4)->format('Y-m-d'),
        ];

        foreach ($asistencias as $participante_id => $dias) {
            foreach ($dias as $dia => $estado) {
                if (isset($diasSemana[$dia]) && in_array($estado, ['Presente', 'Ausente', 'Justificado'])) {
                    Asistencia::updateOrCreate(
                        [
                            'Participante_ID' => $participante_id,
                            'Programa_ID' => $programa_id,
                            'Fecha' => $diasSemana[$dia],
                        ],
                        [
                            'Estado' => $estado,
                        ]
                    );
                }
            }
        }

        return redirect()->route('asistencia.index', ['programa_id' => $programa_id, 'fecha_inicio' => $fecha_inicio])
                         ->with('success', 'Asistencia registrada exitosamente.');
    }

    public function reporte(Request $request)
{
    $programa_id = $request->input('programa_id');
    $fecha_inicio = $request->input('fecha_inicio');
    $fecha_fin = $request->input('fecha_fin');

    $programas = Programa::all();
    $reporte = [];

    if ($programa_id && $fecha_inicio && $fecha_fin) {
        $participantes = Participante::whereHas('inscripcion', function ($query) use ($programa_id) {
            $query->where('Programa_ID', $programa_id);
        })
        ->with([
            'asistencias' => function ($query) use ($fecha_inicio, $fecha_fin, $programa_id) {
                $query->whereBetween('Fecha', [$fecha_inicio, $fecha_fin])
                      ->where('Programa_ID', $programa_id);
            }
        ])
        ->get();

        foreach ($participantes as $participante) {
            $totalAsistido = $participante->asistencias->where('Estado', 'Presente')->count();
            $totalDias = $participante->asistencias->count();
            $porcentaje = $totalDias > 0 ? ($totalAsistido / $totalDias) * 100 : 0;

            $reporte[] = [
                'participante' => $participante,
                'totalAsistido' => $totalAsistido,
                'totalDias' => $totalDias,
                'porcentaje' => round($porcentaje, 2),
            ];
        }
    }

    return view('asistencia.reporte', compact('programas', 'programa_id', 'fecha_inicio', 'fecha_fin', 'reporte'));
}
}