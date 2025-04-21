<?php

namespace App\Http\Controllers;

use App\Models\Participante;
use App\Models\Comunidad;
use App\Models\Escuela;
use App\Models\Inscripcion;
use App\Models\ParticipanteTutor;
use App\Models\Tutor;
use App\Models\TutorSecundario;
use Illuminate\Http\Request;
use App\Models\Programa;
use App\Models\DocumentacionRequerida;
use App\Models\LugarEncuentro;
use Carbon\Carbon;
class ParticipanteController extends Controller
{
    public function index()
    {
        // Cargar los participantes con sus relaciones (inscripción, programa, lugar de encuentro)
        $participantes = Participante::with(['inscripcion.programa', 'inscripcion.lugarEncuentro'])->get();

        return view('participante.index', compact('participantes'));
    }
    public function create()
{
    $comunidades = Comunidad::all();

    $programas = Programa::all();
    $lugaresEncuentro = LugarEncuentro::all(); // Cargar los lugares de encuentro

    return view('participante.create', compact('comunidades', 'programas', 'lugaresEncuentro'));
}
    

    public function store(Request $request)
    {
        $request->validate([
            'participante.PrimerNombre' => 'required|string|max:255',
            'participante.PrimerApellido' => 'required|string|max:255',
            'participante.FechaNacimiento' => 'required|date',
            'participante.GradoActual' => 'required|integer|between:0,12',
            'inscripcion.FechaInscripcion' => 'required|date_format:d-m-Y',
            'inscripcion.Programa_ID' => 'required|exists:Programas,Programa_ID',
            'escuela.NombreEscuela' => 'required|string|max:255',
            'documentacion.TieneCedula' => 'required|in:0,1',
            'documentacion.TienePartidaNacimiento' => 'required|in:0,1',
            'documentacion.TieneBoletinDiploma' => 'required|in:0,1',
            'documentacion.TieneCopiaCedulaTutor' => 'required|in:0,1',
            'inscripcion.Subprogramas' => 'nullable|array',
            'inscripcion.Subprogramas.*' => 'in:RAC,RACREA,CLC,CLCREA,BM,CLM,DJ',
            'tutor_principal.Tutor_Cedula' => 'required|string|max:20',
        'tutor_principal.Nombres' => 'required|string|max:255',
        'tutor_principal.Apellidos' => 'required|string|max:255',
        'tutor_principal.TipoTutor' => 'required|string|max:255',
        'tutor_principal.Telefono' => 'nullable|string|max:20',
        'tutor_principal.DIRECCION' => 'nullable|string|max:255',
        'tutor_principal.SectorEconomico' => 'nullable|string|max:255',
        'tutor_principal.NivelEducacionFormal' => 'nullable|string|max:255',
        'tutor_principal.Comunidad_ID' => 'nullable|exists:Comunidad,Comunidad_ID',
        // Validación del tutor secundario (si existe)
        'tutor_secundario.Tutor_Cedula' => 'required_if:tutor_secundario.TipoTutor,!=,|string|max:20',
        'tutor_secundario.Nombres' => 'required_if:tutor_secundario.TipoTutor,!=,|string|max:255',
        'tutor_secundario.Apellidos' => 'required_if:tutor_secundario.TipoTutor,!=,|string|max:255',
        'tutor_secundario.TipoTutor' => 'nullable|string|max:255',
        'tutor_secundario.Telefono' => 'nullable|string|max:20',
        'tutor_secundario.DIRECCION' => 'nullable|string|max:255',
        'tutor_secundario.SectorEconomico' => 'nullable|string|max:255',
        'tutor_secundario.NivelEducacionFormal' => 'nullable|string|max:255',
        'tutor_secundario.Comunidad_ID' => 'nullable|exists:Comunidad,Comunidad_ID',
        'participante.TipoParticipante' => 'string|max:255',
        ]);

        // Crear el Participante
        $participante = Participante::create($request->input('participante'));
        $fechaInscripcion = Carbon::createFromFormat('d-m-Y', $request->input('inscripcion.FechaInscripcion'))->format('Y-m-d');
        // Crear la Inscripción
        $inscripcionData = $request->input('inscripcion');
        $inscripcionData['Participante_ID'] = $participante->Participante_ID;
        $inscripcionData['fecha_inscripcion'] = $fechaInscripcion;
        $inscripcionData['Subprogramas'] = isset($inscripcionData['Subprogramas']) ? implode(',', $inscripcionData['Subprogramas']) : null;
        $inscripcion = Inscripcion::create($inscripcionData);
        // Crear la Escuela
        $escuelaData = $request->input('escuela');
        Escuela::create($escuelaData);

// Crear o actualizar el Tutor Principal
$tutorPrincipalData = $request->input('tutor_principal');
$tutorPrincipal = Tutor::updateOrCreate(
    ['Tutor_Cedula' => $tutorPrincipalData['Tutor_Cedula']],
    [
        'Nombres' => $tutorPrincipalData['Nombres'],
        'Apellidos' => $tutorPrincipalData['Apellidos'],
        'TipoTutor' => $tutorPrincipalData['TipoTutor'],
        'Telefono' => $tutorPrincipalData['Telefono'] ?? null,
        'DIRECCION' => $tutorPrincipalData['DIRECCION'] ?? null,
        'SectorEconomico' => $tutorPrincipalData['SectorEconomico'] ?? null,
        'NivelEducacionFormal' => $tutorPrincipalData['NivelEducacionFormal'] ?? null,
        'Comunidad_ID' => $tutorPrincipalData['Comunidad_ID'] ?? null,
    ]
);

// Asociar el tutor principal al participante
ParticipanteTutor::updateOrCreate(
    [
        'Participante_ID' => $participante->Participante_ID,
        'Tutor_Cedula' => $tutorPrincipal->Tutor_Cedula,
    ],
    [
        'Rol' => 'Principal',
    ]
);

// Crear o actualizar el Tutor Secundario (si existe)
if ($request->filled('tutor_secundario.TipoTutor')) {
    $tutorSecundarioData = $request->input('tutor_secundario');
    $tutorSecundario = Tutor::updateOrCreate(
        ['Tutor_Cedula' => $tutorSecundarioData['Tutor_Cedula']],
        [
            'Nombres' => $tutorSecundarioData['Nombres'],
            'Apellidos' => $tutorSecundarioData['Apellidos'],
            'TipoTutor' => $tutorSecundarioData['TipoTutor'],
            'Telefono' => $tutorSecundarioData['Telefono'] ?? null,
            'DIRECCION' => $tutorSecundarioData['DIRECCION'] ?? null,
            'SectorEconomico' => $tutorSecundarioData['SectorEconomico'] ?? null,
            'NivelEducacionFormal' => $tutorSecundarioData['NivelEducacionFormal'] ?? null,
            'Comunidad_ID' => $tutorSecundarioData['Comunidad_ID'] ?? null,
        ]
    );

    // Asociar el tutor secundario al participante
    ParticipanteTutor::updateOrCreate(
        [
            'Participante_ID' => $participante->Participante_ID,
            'Tutor_Cedula' => $tutorSecundario->Tutor_Cedula,
        ],
        [
            'Rol' => 'Secundario',
        ]
    );
}

        // Crear la Documentación Requerida (vinculada a la inscripción)
        $documentacionData = $request->input('documentacion');
        $documentacionData['Inscripcion_ID'] = $inscripcion->Inscripcion_ID; // Usar Inscripcion_ID
        DocumentacionRequerida::create($documentacionData);

        return redirect()->route('participante.create')->with('success', 'Participante registrado exitosamente.');
    }
    private function calcularEdad($fechaNacimiento)
    {
        $nacimiento = new \DateTime($fechaNacimiento);
        $hoy = new \DateTime();
        $edad = $hoy->diff($nacimiento)->y;
        return $edad;
    }

    // Mostrar los detalles de un participante
    public function show($id)
    {
        $participante = Participante::with([
            'inscripcion.programa',
            'inscripcion.lugarEncuentro',
            'inscripcion.documentacion',
            'tutores.comunidad', // Añade la relación 'comunidad' del tutor principal
        ])->findOrFail($id);
    
        return view('participante.show', compact('participante'));
    }

    // Mostrar el formulario de edición
    public function edit($id)
    {
        $participante = Participante::with([
            'inscripcion.programa',
            'inscripcion.lugarEncuentro',
            'inscripcion.documentacion',
            'tutorPrincipalRelation.comunidad',
            'tutorSecundarioRelation.comunidad',
            'escuela',
        ])->findOrFail($id);
    
        $comunidades = Comunidad::all(); // Para el dropdown de comunidades
        $programas = Programa::all(); // Para el dropdown de programas
        $lugaresEncuentro = LugarEncuentro::all(); // Para el dropdown de lugares de encuentro
    
        return view('participante.edit', compact('participante', 'comunidades', 'programas', 'lugaresEncuentro'));
    }

    public function update(Request $request, $id)
{
    $participante = Participante::with([
        'inscripcion.programa',
        'inscripcion.lugarEncuentro',
        'inscripcion.documentacion',
        'tutorPrincipalRelation.comunidad', // Usa tutorPrincipalRelation
        'tutorSecundarioRelation.comunidad', // Usa tutorSecundarioRelation
        'escuela',
    ])->findOrFail($id);

    // Actualizar datos del participante
    $participante->update($request->only([
        'PrimerNombre', 'SegundoNombre', 'PrimerApellido', 'SegundoApellido',
        'FechaNacimiento', 'Edad', 'Genero', 'CedulaParticipante', 'Comunidad_ID',
        'Ciudad', 'Departamento', 'SectorEconomicoAdulto', 'NivelEducacionAdulto',
        'GradoActual', 'TurnoEscolar', 'RepiteGrado', 'AsisteOtrosProgramasComunidad',
        'DescripcionOtrosProgramas', 'TipoParticipante'
    ]));

    // Actualizar o crear inscripción
    if ($request->has('inscripcion')) {
        $inscripcionData = $request->input('inscripcion');
        if (isset($inscripcionData['DiasAsistenciaEsperados'])) {
            $inscripcionData['DiasAsistenciaEsperados'] = implode(',', $inscripcionData['DiasAsistenciaEsperados']);
        }
        $participante->inscripcion()->updateOrCreate(
            ['Participante_ID' => $participante->Participante_ID],
            $inscripcionData
        );
    }

    // Actualizar o crear escuela
    if ($request->has('escuela')) {
        $participante->escuela()->updateOrCreate(
            ['Participante_ID' => $participante->Participante_ID],
            $request->input('escuela')
        );
    }

    // Actualizar o crear tutor principal
    if ($request->has('tutor_principal')) {
        $tutorPrincipalData = $request->input('tutor_principal');
        $tutorPrincipal = Tutor::updateOrCreate(
            ['Tutor_Cedula' => $tutorPrincipalData['Tutor_Cedula']],
            $tutorPrincipalData
        );

        // Asociar el tutor principal al participante
        $participante->tutores()->syncWithoutDetaching([
            $tutorPrincipal->Tutor_Cedula => ['Rol' => 'principal']
        ]);
    }

    // Actualizar o crear tutor secundario (si se proporcionó)
    if ($request->has('tutor_secundario') && !empty($request->input('tutor_secundario.Tutor_Cedula'))) {
        $tutorSecundarioData = $request->input('tutor_secundario');
        $tutorSecundario = Tutor::updateOrCreate(
            ['Tutor_Cedula' => $tutorSecundarioData['Tutor_Cedula']],
            $tutorSecundarioData
        );

        // Asociar el tutor secundario al participante
        $participante->tutores()->syncWithoutDetaching([
            $tutorSecundario->Tutor_Cedula => ['Rol' => 'secundario']
        ]);
    }

    // Actualizar o crear documentación
    if ($request->has('documentacion')) {
        $documentacionData = $request->input('documentacion');
        $participante->inscripcion->documentacion()->updateOrCreate(
            ['Inscripcion_ID' => $participante->inscripcion->Inscripcion_ID],
            $documentacionData
        );
    }

    return redirect()->route('participante.show', $participante->Participante_ID)
                     ->with('success', 'Participante actualizado exitosamente.');
}
    // Eliminar un participante
    public function destroy($id)
    {
        $participante = Participante::findOrFail($id);
        $participante->delete();

        return redirect()->route('participante.index')->with('success', 'Participante eliminado exitosamente.');
    }
}