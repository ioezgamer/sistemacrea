<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Participante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="p-6 text-gray-900 ">
                    <!-- Botones de Acción -->
                    <div class="mb-6 flex justify-between items-center">
                       
                        <x-boton-regresar>
                            <a href="{{ route('participante.index') }}">
                                Lista participantes
                            </a>
                        </x-boton-regresar>
                                <x-editar-button>
                                    <a href="{{ route('participante.edit', $participante->Participante_ID) }}">
                                       Editar participante
                                    </a>
                                </x-editar-button>
                            
                       
                    </div>

                    <!-- Contenedor de la Hoja -->
                    <div class="pdf-container bg-white shadow-lg rounded-lg p-8 mx-auto" style="width: 210mm; min-height: 297mm; margin: 0 auto; position: relative;">
                        <!-- Encabezado de la Hoja -->
                        <div class="pdf-header border-b border-gray-200 pb-4 mb-6">
                            <h1 class="text-2xl font-bold text-gray-800 text-center">Detalles del Participante</h1>
                            <p class="text-sm text-gray-600 text-center mt-2">
                                Generado el {{ \Carbon\Carbon::now()->locale('es')->translatedFormat('l d \d\e F \d\e\l Y') }}
                            </p>
                        </div>

                        <!-- Contenido Principal -->
                        <div class="space-y-8">
                            <!-- Información del Participante -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Información del Participante</h3>
                                <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Nombre Completo</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $participante->PrimerNombre }} {{ $participante->SegundoNombre }} {{ $participante->PrimerApellido }} {{ $participante->SegundoApellido }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Fecha de Nacimiento</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ $participante->FechaNacimiento ? \Carbon\Carbon::parse($participante->FechaNacimiento)->locale('es')->translatedFormat('l d \d\e F \d\e\l Y') : 'N/A' }}
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Edad</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $participante->Edad ?? 'N/A' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Comunidad/Barrio</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $participante->comunidad->NombreComunidad?? 'N/A' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Municipio</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $participante->Ciudad?? 'N/A' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Departamento</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $participante->Departamento?? 'N/A' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Género</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $participante->Genero ?? 'N/A' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Grado Actual</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $participante->GradoActual ?? 'N/A' }}</dd>
                                    </div>
                                </dl>
                            </div>
<!-- Documentación -->
<div>
    <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Documentación requerida</h3>
    <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
        <div>
            <dt class="text-sm font-medium text-gray-500">Tiene copia de cédula</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $participante->inscripcion->documentacion->TieneCedula ? 'Sí' : 'No' }}</dd>
        </div>
        <div>
            <dt class="text-sm font-medium text-gray-500">Tiene copia de partida de nacimiento</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $participante->inscripcion->documentacion->TienePartidaNacimiento ? 'Sí' : 'No' }}</dd>
        </div>
        <div>
            <dt class="text-sm font-medium text-gray-500">Tiene copia de Boletín/Diploma</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $participante->inscripcion->documentacion->TieneBoletinDiploma ? 'Sí' : 'No' }}</dd>
        </div>
        <div>
            <dt class="text-sm font-medium text-gray-500">Tiene copia de cédula del tutor</dt>
            <dd class="mt-1 text-sm text-gray-900">{{ $participante->inscripcion->documentacion->TieneCopiaCedulaTutor ? 'Sí' : 'No' }}</dd>
        </div>
    </dl>
</div>

                            <!-- Información de la Inscripción -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Información de la Inscripción</h3>
                                <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Programa</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $participante->inscripcion->programa->NombrePrograma ?? 'N/A' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Lugar de Encuentro</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $participante->inscripcion->lugarEncuentro->NombreLugar ?? 'N/A' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Fecha de Inscripción</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            @if ($participante->inscripcion && $participante->inscripcion->FechaInscripcion)
                                                {{ \Carbon\Carbon::parse($participante->inscripcion->FechaInscripcion)->locale('es')->translatedFormat('l d \d\e F \d\e\l Y') }}
                                            @else
                                                N/A
                                            @endif
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Subprogramas</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            @if ($participante->inscripcion && !is_null($participante->inscripcion->Subprogramas))
                                                @php
                                                    $subprogramas = $participante->inscripcion->Subprogramas;
                                                    if (is_array($subprogramas) && !empty($subprogramas)) {
                                                        $subprogramasDisplay = implode(', ', $subprogramas);
                                                    } elseif (is_string($subprogramas) && $subprogramas !== '') {
                                                        $subprogramasDisplay = $subprogramas;
                                                    } else {
                                                        $subprogramasDisplay = 'N/A';
                                                    }
                                                @endphp
                                                {{ $subprogramasDisplay }}
                                            @else
                                                N/A
                                            @endif
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Días de Asistencia Esperados</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            @if ($participante->inscripcion && $participante->inscripcion->DiasAsistenciaEsperados)
                                                @if (is_array($participante->inscripcion->DiasAsistenciaEsperados))
                                                    {{ implode(', ', $participante->inscripcion->DiasAsistenciaEsperados) }}
                                                @else
                                                    {{ $participante->inscripcion->DiasAsistenciaEsperados }}
                                                @endif
                                            @else
                                                N/A
                                            @endif
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Expectativas del Tutor Principal</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $participante->inscripcion->ExpectativasTutorPrincipal ?? 'N/A' }}</dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Información de la Escuela -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Información de la Escuela</h3>
                                <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Escuela</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $participante->escuela->NombreEscuela ?? 'N/A' }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Comunidad de la escuela</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $participante->escuela->comunidad->NombreComunidad ?? 'N/A' }}</dd>
                                    </div>
                                    
                                </dl>
                            </div>

<!-- Tutores -->
<!-- Tutor Principal -->
@php
    $tutorPrincipal = $participante->tutores->firstWhere('pivot.Rol', 'principal');
@endphp
@if ($tutorPrincipal)
    <div>
        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Tutor Principal</h3>
        <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2 lg:grid-cols-3">
            <div>
                <dt class="text-sm font-medium text-gray-500">Nombre Completo</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ $tutorPrincipal->Nombres ?? 'N/A' }}
                    {{ $tutorPrincipal->Apellidos ?? '' }}
                </dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Tipo de Tutor</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $tutorPrincipal->TipoTutor ?? 'N/A' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Cédula</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $tutorPrincipal->Tutor_Cedula ?? 'N/A' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Teléfono</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $tutorPrincipal->Telefono ?? 'N/A' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Dirección</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $tutorPrincipal->Direccion ?? 'N/A' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Comunidad</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    @if ($tutorPrincipal->comunidad)
                        {{ $tutorPrincipal->comunidad->NombreComunidad ?? 'N/A' }}
                    @else
                        N/A
                    @endif
                </dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Sector Económico</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $tutorPrincipal->SectorEconomico ?? 'N/A' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Nivel de Educación Formal</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $tutorPrincipal->NivelEducacionFormal ?? 'N/A' }}</dd>
            </div>
        </dl>
    </div>
@else
    <p class="mt-4 text-sm text-gray-500">No hay tutor principal asociado.</p>
@endif

<!-- Tutor Secundario -->
@php
    $tutorSecundario = $participante->tutores->firstWhere('pivot.Rol', 'secundario');
@endphp
@if ($tutorSecundario)
    <div>
        <h3 class="text-lg font-medium text-gray-900 border-b border-gray-200 pb-2">Tutor Secundario</h3>
        <dl class="mt-4 grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2 lg:grid-cols-3">
            <div>
                <dt class="text-sm font-medium text-gray-500">Nombre Completo</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    {{ $tutorSecundario->Nombres ?? 'N/A' }}
                    {{ $tutorSecundario->Apellidos ?? '' }}
                </dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Tipo de Tutor</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $tutorSecundario->TipoTutor ?? 'N/A' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Cédula</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $tutorSecundario->Tutor_Cedula ?? 'N/A' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Teléfono</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $tutorSecundario->Telefono ?? 'N/A' }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Comunidad</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    @if ($tutorSecundario->comunidad)
                        {{ $tutorSecundario->comunidad->NombreComunidad ?? 'N/A' }}
                    @else
                        N/A
                    @endif
                </dd>
            </div>
        </dl>
    </div>
@else
    <p class="mt-4 text-sm text-gray-500">No hay tutor secundario asociado.</p>
@endif

                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>