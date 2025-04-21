<x-app-layout>
    <div class="bg-gray-100 font-sans py-12">
        <div class="max-w-4xl mx-auto p-8 bg-white rounded-xl shadow-xl">
            <h1 class="text-3xl font-semibold text-gray-800 text-center mb-8">Editar Participante</h1>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-md mb-6" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 rounded-md mb-6" role="alert">
                    <p class="font-bold mb-2">Por favor corrige los siguientes errores:</p>
                    <ul class="list-disc list-inside ml-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('participante.update', $participante->Participante_ID) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Sección Inscripción Inicial -->
                <fieldset class="bg-white p-8 rounded-lg shadow-md border border-gray-200">
                    <div>
                        <label for="fechaInscripcion" class="block text-sm font-medium text-gray-700">Fecha de Inscripción <span class="text-red-500">*</span></label>
                        <input type="date" id="fechaInscripcion" name="inscripcion[FechaInscripcion]" required value="{{ old('inscripcion.FechaInscripcion', $participante->inscripcion->FechaInscripcion) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                </fieldset>

                <!-- Sección Información del Participante -->
                <fieldset class="bg-white p-8 rounded-lg shadow-md border border-gray-200">
                    <legend class="text-xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-4">Información del Participante</legend>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                        <div>
                            <label for="primerNombreP" class="block text-sm font-medium text-gray-700">Primer Nombre <span class="text-red-500">*</span></label>
                            <input type="text" id="primerNombreP" name="participante[PrimerNombre]" required value="{{ old('participante.PrimerNombre', $participante->PrimerNombre) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="segundoNombreP" class="block text-sm font-medium text-gray-700">Segundo Nombre</label>
                            <input type="text" id="segundoNombreP" name="participante[SegundoNombre]" value="{{ old('participante.SegundoNombre', $participante->SegundoNombre) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="primerApellidoP" class="block text-sm font-medium text-gray-700">Primer Apellido <span class="text-red-500">*</span></label>
                            <input type="text" id="primerApellidoP" name="participante[PrimerApellido]" required value="{{ old('participante.PrimerApellido', $participante->PrimerApellido) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="segundoApellidoP" class="block text-sm font-medium text-gray-700">Segundo Apellido</label>
                            <input type="text" id="segundoApellidoP" name="participante[SegundoApellido]" value="{{ old('participante.SegundoApellido', $participante->SegundoApellido) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="fechaNacimientoP" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento <span class="text-red-500">*</span></label>
                            <input type="date" id="fechaNacimientoP" name="participante[FechaNacimiento]" required oninput="calcularEdad()" value="{{ old('participante.FechaNacimiento', $participante->FechaNacimiento) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="edadP" class="block text-sm font-medium text-gray-700">Edad</label>
                            <input type="number" id="edadP" name="participante[Edad]" min="0" readonly value="{{ old('participante.Edad', $participante->Edad) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-gray-100 cursor-not-allowed">
                        </div>
                        <div>
                            <label for="generoP" class="block text-sm font-medium text-gray-700">Género</label>
                            <select id="generoP" name="participante[Genero]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="" {{ old('participante.Genero', $participante->Genero) == '' ? 'selected' : '' }}>Seleccione...</option>
                                <option value="Masculino" {{ old('participante.Genero', $participante->Genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino" {{ old('participante.Genero', $participante->Genero) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            </select>
                        </div>
                        <div>
                            <label for="cedulaP" class="block text-sm font-medium text-gray-700">Cédula <span class="text-xs text-gray-500" id="cedulaLabelSpan">(Si aplica / Adulto)</span></label>
                            <input type="text" id="cedulaP" name="participante[CedulaParticipante]" placeholder="Ej: 001-123456-0001A" value="{{ old('participante.CedulaParticipante', $participante->CedulaParticipante) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="comunidadP" class="block text-sm font-medium text-gray-700">Comunidad / Barrio</label>
                            <select id="comunidadP" name="participante[Comunidad_ID]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Seleccione...</option>
                                @foreach ($comunidades as $comunidad)
                                    <option value="{{ $comunidad->Comunidad_ID }}" {{ old('participante.Comunidad_ID', $participante->Comunidad_ID) == $comunidad->Comunidad_ID ? 'selected' : '' }}>
                                        {{ $comunidad->NombreComunidad }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="ciudadP" class="block text-sm font-medium text-gray-700">Ciudad</label>
                            <input type="text" id="ciudadP" name="participante[Ciudad]" value="{{ old('participante.Ciudad', $participante->Ciudad) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label for="departamentoP" class="block text-sm font-medium text-gray-700">Departamento</label>
                            <input type="text" id="departamentoP" name="participante[Departamento]" value="{{ old('participante.Departamento', $participante->Departamento) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    <!-- Campos para Adultos -->
                    <div class="campo-adulto hidden mt-8 pt-6 border-t border-gray-200">
                        <p class="text-sm font-medium text-gray-500 mb-4">Información Adicional (Adultos >= 18 años)</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                            <div>
                                <label for="sectorEconomicoAdulto" class="block text-sm font-medium text-gray-700">Sector Económico</label>
                                <input type="text" id="sectorEconomicoAdulto" name="participante[SectorEconomicoAdulto]" value="{{ old('participante.SectorEconomicoAdulto', $participante->SectorEconomicoAdulto) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="nivelEducacionAdulto" class="block text-sm font-medium text-gray-700">Nivel de Educación Formal</label>
                                <input type="text" id="nivelEducacionAdulto" name="participante[NivelEducacionAdulto]" value="{{ old('participante.NivelEducacionAdulto', $participante->NivelEducacionAdulto) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>
                    </div>
                </fieldset>

                <!-- Sección Información Escolar -->
                <fieldset class="bg-white p-8 rounded-lg shadow-md border border-gray-200">
                    <legend class="text-xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-4">Información Escolar</legend>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                        <div>
                            <label for="nombreEscuela" class="block text-sm font-medium text-gray-700">Nombre de la Escuela <span class="text-red-500">*</span></label>
                            <input type="text" id="nombreEscuela" name="escuela[NombreEscuela]" required value="{{ old('escuela.NombreEscuela', $participante->escuela->NombreEscuela ?? '') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="comunidadEscuela" class="block text-sm font-medium text-gray-700">Comunidad / Barrio de la Escuela</label>
                            <select id="comunidadEscuela" name="escuela[Comunidad_ID]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Seleccione...</option>
                                @foreach ($comunidades as $comunidad)
                                    <option value="{{ $comunidad->Comunidad_ID }}" {{ old('escuela.Comunidad_ID', $participante->escuela->Comunidad_ID ?? '') == $comunidad->Comunidad_ID ? 'selected' : '' }}>
                                        {{ $comunidad->NombreComunidad }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="gradoActualP" class="block text-sm font-medium text-gray-700">Grado Actual <span class="text-red-500">*</span></label>
                            <select id="gradoActualP" name="participante[GradoActual]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Seleccione...</option>
                                @for ($i = 0; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ old('participante.GradoActual', $participante->GradoActual) === (string)$i ? 'selected' : '' }}>
                                        {{ $i == 0 ? '0 (Preescolar)' : $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label for="turnoEscolarP" class="block text-sm font-medium text-gray-700">Turno Escolar</label>
                            <select id="turnoEscolarP" name="participante[TurnoEscolar]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="" {{ old('participante.TurnoEscolar', $participante->TurnoEscolar) == '' ? 'selected' : '' }}>Seleccione...</option>
                                <option value="Matutino" {{ old('participante.TurnoEscolar', $participante->TurnoEscolar) == 'Matutino' ? 'selected' : '' }}>Matutino</option>
                                <option value="Vespertino" {{ old('participante.TurnoEscolar', $participante->TurnoEscolar) == 'Vespertino' ? 'selected' : '' }}>Vespertino</option>
                                <option value="Nocturno" {{ old('participante.TurnoEscolar', $participante->TurnoEscolar) == 'Nocturno' ? 'selected' : '' }}>Nocturno</option>
                                <option value="Sabatino" {{ old('participante.TurnoEscolar', $participante->TurnoEscolar) == 'Sabatino' ? 'selected' : '' }}>Sabatino</option>
                                <option value="Dominical" {{ old('participante.TurnoEscolar', $participante->TurnoEscolar) == 'Dominical' ? 'selected' : '' }}>Dominical</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="repiteGradoP" class="block text-sm font-medium text-gray-700">¿Repite Grado?</label>
                            <select id="repiteGradoP" name="participante[RepiteGrado]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Seleccione...</option>
                                <option value="1" {{ old('participante.RepiteGrado', $participante->RepiteGrado) == '1' ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ old('participante.RepiteGrado', $participante->RepiteGrado) === '0' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                <!-- Sección Inscripción al Programa -->
                <fieldset class="bg-white p-8 rounded-lg shadow-md border border-gray-200">
                    <legend class="text-xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-4">Inscripción al Programa</legend>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                        <div>
                            <label for="programaId" class="block text-sm font-medium text-gray-700">Programa al que se inscribe <span class="text-red-500">*</span></label>
                            <select id="programaId" name="inscripcion[Programa_ID]" required onchange="toggleSubprogramas()"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Seleccione un programa...</option>
                                @foreach ($programas as $programa)
                                    <option value="{{ $programa->Programa_ID }}" {{ old('inscripcion.Programa_ID', $participante->inscripcion->Programa_ID) == $programa->Programa_ID ? 'selected' : '' }}>
                                        {{ $programa->NombrePrograma }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="lugarEncuentro" class="block text-sm font-medium text-gray-700">Lugar de Encuentro <span class="text-red-500">*</span></label>
                            <select id="lugarEncuentro" name="inscripcion[LugarEncuentro_ID]" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Seleccione un lugar...</option>
                                @foreach ($lugaresEncuentro as $lugar)
                                    <option value="{{ $lugar->LugarEncuentro_ID }}" {{ old('inscripcion.LugarEncuentro_ID', $participante->inscripcion->LugarEncuentro_ID) == $lugar->LugarEncuentro_ID ? 'selected' : '' }}>
                                        {{ $lugar->NombreLugar }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- Subprogramas -->
<div id="subprogramasContainer" class="mt-6 hidden">
    <label class="block text-sm font-medium text-gray-700 mb-2">Subprogramas</label>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <!-- Éxito Académico -->
        <div id="exitoAcademicoSubprogramas" class="hidden">
            <p class="text-sm font-medium text-gray-600 mb-2">Éxito Académico</p>
            <label class="flex items-center text-sm text-gray-600">
                <input type="checkbox" name="inscripcion[Subprogramas][RAC]" value="RAC" 
                    {{ in_array('RAC', array_values(old('inscripcion.Subprogramas', is_array($participante->inscripcion->Subprogramas) ? $participante->inscripcion->Subprogramas : []))) ? 'checked' : '' }}
                    class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> RAC
            </label>
            <label class="flex items-center text-sm text-gray-600">
                <input type="checkbox" name="inscripcion[Subprogramas][RACREA]" value="RACREA" 
                    {{ in_array('RACREA', array_values(old('inscripcion.Subprogramas', is_array($participante->inscripcion->Subprogramas) ? $participante->inscripcion->Subprogramas : []))) ? 'checked' : '' }}
                    class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> RACREA
            </label>
        </div>
        <!-- Biblioteca -->
<div id="bibliotecaSubprogramas" class="hidden">
    <p class="text-sm font-medium text-gray-600 mb-2">Biblioteca</p>
    <label class="flex items-center text-sm text-gray-600">
        <input type="checkbox" name="inscripcion[Subprogramas][CLC]" value="CLC" 
            {{ in_array('CLC', array_values(old('inscripcion.Subprogramas', is_array($participante->inscripcion->Subprogramas) ? $participante->inscripcion->Subprogramas : []))) ? 'checked' : '' }}
            class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> CLC
    </label>
    <label class="flex items-center text-sm text-gray-600">
        <input type="checkbox" name="inscripcion[Subprogramas][CLCREA]" value="CLCREA" 
            {{ in_array('CLCREA', array_values(old('inscripcion.Subprogramas', is_array($participante->inscripcion->Subprogramas) ? $participante->inscripcion->Subprogramas : []))) ? 'checked' : '' }}
            class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> CLCREA
    </label>
    <label class="flex items-center text-sm text-gray-600">
        <input type="checkbox" name="inscripcion[Subprogramas][BM]" value="BM" 
            {{ in_array('BM', array_values(old('inscripcion.Subprogramas', is_array($participante->inscripcion->Subprogramas) ? $participante->inscripcion->Subprogramas : []))) ? 'checked' : '' }}
            class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> BM
    </label>
    <label class="flex items-center text-sm text-gray-600">
        <input type="checkbox" name="inscripcion[Subprogramas][CLM]" value="CLM" 
            {{ in_array('CLM', array_values(old('inscripcion.Subprogramas', is_array($participante->inscripcion->Subprogramas) ? $participante->inscripcion->Subprogramas : []))) ? 'checked' : '' }}
            class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> CLM
    </label>
</div>

<!-- Desarrollo Juvenil -->
<div id="desarrolloJuvenilSubprogramas" class="hidden">
    <p class="text-sm font-medium text-gray-600 mb-2">Desarrollo Juvenil</p>
    <label class="flex items-center text-sm text-gray-600">
        <input type="checkbox" name="inscripcion[Subprogramas][DJ]" value="DJ" 
            {{ in_array('DJ', array_values(old('inscripcion.Subprogramas', is_array($participante->inscripcion->Subprogramas) ? $participante->inscripcion->Subprogramas : []))) ? 'checked' : '' }}
            class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> DJ
    </label>
</div>
</div>
                    <div<label class="block text-sm font-medium text-gray-700">Días de Asistencia Esperados</label>
                    <div class="mt-2 space-y-2">
                        @php
                            // Obtener los días seleccionados, manejando diferentes formatos
                            $diasSeleccionados = old('inscripcion.DiasAsistenciaEsperados', $participante->inscripcion->DiasAsistenciaEsperados ?? []);
                            
                            // Si $diasSeleccionados es una cadena, convertirla a array
                            if (is_string($diasSeleccionados)) {
                                $diasSeleccionados = explode(',', $diasSeleccionados); // Asumiendo que está separado por comas
                                $diasSeleccionados = array_map('trim', $diasSeleccionados); // Limpiar espacios
                            } elseif (!is_array($diasSeleccionados)) {
                                $diasSeleccionados = []; // Fallback a array vacío si no es cadena ni array
                            }
                        @endphp
                        @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $dia)
                            <label class="flex items-center text-sm text-gray-600">
                                <input type="checkbox" name="inscripcion[DiasAsistenciaEsperados][]" value="{{ $dia }}"
                                       @if(in_array($dia, $diasSeleccionados)) checked @endif
                                       class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> {{ $dia }}
                            </label>
                        @endforeach
                    </div>
                    </div>
                    <div class="mt-6">
                        <label for="expectativasTutor" class="block text-sm font-medium text-gray-700">Expectativas del Tutor Principal</label>
                        <textarea id="expectativasTutor" name="inscripcion[ExpectativasTutorPrincipal]" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('inscripcion.ExpectativasTutorPrincipal', $participante->inscripcion->ExpectativasTutorPrincipal) }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6 mt-6">
                        <div>
                            <label for="asisteOtrosProg" class="block text-sm font-medium text-gray-700">¿El participante asiste a otros programas?</label>
                            <select id="asisteOtrosProg" name="participante[AsisteOtrosProgramasComunidad]" onchange="toggleOtrosProgramas()"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="0" {{ old('participante.AsisteOtrosProgramasComunidad', $participante->AsisteOtrosProgramasComunidad) == '0' ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('participante.AsisteOtrosProgramasComunidad', $participante->AsisteOtrosProgramasComunidad) == '1' ? 'selected' : '' }}>Sí</option>
                            </select>
                        </div>
                        <div id="descOtrosProgContainer" class="{{ old('participante.AsisteOtrosProgramasComunidad', $participante->AsisteOtrosProgramasComunidad) == '1' ? '' : 'hidden' }}">
                            <label for="descOtrosProg" class="block text-sm font-medium text-gray-700">Si asiste a otros, ¿cuáles y qué días? <span class="text-xs text-gray-500">(Opcional)</span></label>
                            <textarea id="descOtrosProg" name="participante[DescripcionOtrosProgramas]" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('participante.DescripcionOtrosProgramas', $participante->DescripcionOtrosProgramas) }}</textarea>
                        </div>
                    </div>
                </fieldset>

                <!-- Sección Información del Tutor Principal -->
<fieldset class="bg-white p-8 rounded-lg shadow-md border border-gray-200">
    <legend class="text-xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-4">Información del Tutor Principal</legend>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
        <div>
            <label for="tutorPTipo" class="block text-sm font-medium text-gray-700">Tipo de Tutor <span class="text-red-500">*</span></label>
            <select id="tutorPTipo" name="tutor_principal[TipoTutor]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="" {{ old('tutor_principal.TipoTutor', $participante->tutorPrincipal->TipoTutor ?? '') == '' ? 'selected' : '' }}>Seleccione...</option>
                <option value="Padre" {{ old('tutor_principal.TipoTutor', $participante->tutorPrincipal->TipoTutor ?? '') == 'Padre' ? 'selected' : '' }}>Padre</option>
                <option value="Madre" {{ old('tutor_principal.TipoTutor', $participante->tutorPrincipal->TipoTutor ?? '') == 'Madre' ? 'selected' : '' }}>Madre</option>
                <option value="Abuelo/a" {{ old('tutor_principal.TipoTutor', $participante->tutorPrincipal->TipoTutor ?? '') == 'Abuelo/a' ? 'selected' : '' }}>Abuelo/a</option>
                <option value="Tío/a" {{ old('tutor_principal.TipoTutor', $participante->tutorPrincipal->TipoTutor ?? '') == 'Tío/a' ? 'selected' : '' }}>Tío/a</option>
                <option value="Hermano/a" {{ old('tutor_principal.TipoTutor', $participante->tutorPrincipal->TipoTutor ?? '') == 'Hermano/a' ? 'selected' : '' }}>Hermano/a</option>
                <option value="Otro" {{ old('tutor_principal.TipoTutor', $participante->tutorPrincipal->TipoTutor ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>
        <div>
            <label for="tutorPCedula" class="block text-sm font-medium text-gray-700">Número de Cédula <span class="text-red-500">*</span></label>
            <input type="text" id="tutorPCedula" name="tutor_principal[Tutor_Cedula]" placeholder="Ej: 001-123456-0002B" required value="{{ old('tutor_principal.Tutor_Cedula', $participante->tutorPrincipal->Tutor_Cedula ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="tutorPNombres" class="block text-sm font-medium text-gray-700">Nombres <span class="text-red-500">*</span></label>
            <input type="text" id="tutorPNombres" name="tutor_principal[Nombres]" required value="{{ old('tutor_principal.Nombres', $participante->tutorPrincipal->Nombres ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="tutorPApellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
            <input type="text" id="tutorPApellidos" name="tutor_principal[Apellidos]" value="{{ old('tutor_principal.Apellidos', $participante->tutorPrincipal->Apellidos ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="tutorPComunidad" class="block text-sm font-medium text-gray-700">Comunidad / Barrio</label>
            <select id="tutorPComunidad" name="tutor_principal[Comunidad_ID]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Seleccione...</option>
                @foreach ($comunidades as $comunidad)
                    <option value="{{ $comunidad->Comunidad_ID }}" {{ old('tutor_principal.Comunidad_ID', $participante->tutorPrincipal->Comunidad_ID ?? '') == $comunidad->Comunidad_ID ? 'selected' : '' }}>{{ $comunidad->NombreComunidad }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="tutorPTelefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
            <input type="tel" id="tutorPTelefono" name="tutor_principal[Telefono]" value="{{ old('tutor_principal.Telefono', $participante->tutorPrincipal->Telefono ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <div class="md:col-span-2">
            <label for="tutorPDireccion" class="block text-sm font-medium text-gray-700">Dirección</label>
            <textarea id="tutorPDireccion" name="tutor_principal[Direccion]" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('tutor_principal.Direccion', $participante->tutorPrincipal->DIRECCION ?? '') }}</textarea>
        </div>
        <div>
            <label for="tutorPSector" class="block text-sm font-medium text-gray-700">Sector Económico</label>
            <select id="tutorPSector" name="tutor_principal[SectorEconomico]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="" {{ old('tutor_principal.SectorEconomico', $participante->tutorPrincipal->SectorEconomico ?? '') == '' ? 'selected' : '' }}>Seleccione...</option>
                <option value="Agricultura" {{ old('tutor_principal.SectorEconomico', $participante->tutorPrincipal->SectorEconomico ?? '') == 'Agricultura' ? 'selected' : '' }}>Agricultura</option>
                <option value="Comercio" {{ old('tutor_principal.SectorEconomico', $participante->tutorPrincipal->SectorEconomico ?? '') == 'Comercio' ? 'selected' : '' }}>Comercio</option>
                <option value="Construcción" {{ old('tutor_principal.SectorEconomico', $participante->tutorPrincipal->SectorEconomico ?? '') == 'Construcción' ? 'selected' : '' }}>Construcción</option>
                <option value="Educación" {{ old('tutor_principal.SectorEconomico', $participante->tutorPrincipal->SectorEconomico ?? '') == 'Educación' ? 'selected' : '' }}>Educación</option>
                <option value="Salud" {{ old('tutor_principal.SectorEconomico', $participante->tutorPrincipal->SectorEconomico ?? '') == 'Salud' ? 'selected' : '' }}>Salud</option>
                <option value="Servicios" {{ old('tutor_principal.SectorEconomico', $participante->tutorPrincipal->SectorEconomico ?? '') == 'Servicios' ? 'selected' : '' }}>Servicios</option>
                <option value="Tecnología" {{ old('tutor_principal.SectorEconomico', $participante->tutorPrincipal->SectorEconomico ?? '') == 'Tecnología' ? 'selected' : '' }}>Tecnología</option>
                <option value="Transporte" {{ old('tutor_principal.SectorEconomico', $participante->tutorPrincipal->SectorEconomico ?? '') == 'Transporte' ? 'selected' : '' }}>Transporte</option>
                <option value="Otro" {{ old('tutor_principal.SectorEconomico', $participante->tutorPrincipal->SectorEconomico ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>
        <div>
            <label for="tutorPNivelEducacion" class="block text-sm font-medium text-gray-700">Nivel de Educación Formal</label>
            <select id="tutorPNivelEducacion" name="tutor_principal[NivelEducacionFormal]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="" {{ old('tutor_principal.NivelEducacionFormal', $participante->tutorPrincipal->NivelEducacionFormal ?? '') == '' ? 'selected' : '' }}>Seleccione...</option>
                <option value="Sin educación formal" {{ old('tutor_principal.NivelEducacionFormal', $participante->tutorPrincipal->NivelEducacionFormal ?? '') == 'Sin educación formal' ? 'selected' : '' }}>Sin educación formal</option>
                <option value="Primaria incompleta" {{ old('tutor_principal.NivelEducacionFormal', $participante->tutorPrincipal->NivelEducacionFormal ?? '') == 'Primaria incompleta' ? 'selected' : '' }}>Primaria incompleta</option>
                <option value="Primaria completa" {{ old('tutor_principal.NivelEducacionFormal', $participante->tutorPrincipal->NivelEducacionFormal ?? '') == 'Primaria completa' ? 'selected' : '' }}>Primaria completa</option>
                <option value="Secundaria incompleta" {{ old('tutor_principal.NivelEducacionFormal', $participante->tutorPrincipal->NivelEducacionFormal ?? '') == 'Secundaria incompleta' ? 'selected' : '' }}>Secundaria incompleta</option>
                <option value="Secundaria completa" {{ old('tutor_principal.NivelEducacionFormal', $participante->tutorPrincipal->NivelEducacionFormal ?? '') == 'Secundaria completa' ? 'selected' : '' }}>Secundaria completa</option>
                <option value="Técnico" {{ old('tutor_principal.NivelEducacionFormal', $participante->tutorPrincipal->NivelEducacionFormal ?? '') == 'Técnico' ? 'selected' : '' }}>Técnico</option>
                <option value="Universitario incompleto" {{ old('tutor_principal.NivelEducacionFormal', $participante->tutorPrincipal->NivelEducacionFormal ?? '') == 'Universitario incompleto' ? 'selected' : '' }}>Universitario incompleto</option>
                <option value="Universitario completo" {{ old('tutor_principal.NivelEducacionFormal', $participante->tutorPrincipal->NivelEducacionFormal ?? '') == 'Universitario completo' ? 'selected' : '' }}>Universitario completo</option>
                <option value="Posgrado" {{ old('tutor_principal.NivelEducacionFormal', $participante->tutorPrincipal->NivelEducacionFormal ?? '') == 'Posgrado' ? 'selected' : '' }}>Posgrado</option>
            </select>
        </div>
    </div>
</fieldset>

<!-- Sección Información del Tutor Secundario -->
<fieldset class="bg-white p-8 rounded-lg shadow-md border border-gray-200">
    <legend class="text-xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-4">Información del Tutor Secundario <span class="text-sm font-normal text-gray-500">(Opcional)</span></legend>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
        <div>
            <label for="tutorSTipo" class="block text-sm font-medium text-gray-700">Tipo de Tutor</label>
            <select id="tutorSTipo" name="tutor_secundario[TipoTutor]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="" {{ old('tutor_secundario.TipoTutor', $participante->tutorSecundario->TipoTutor ?? '') == '' ? 'selected' : '' }}>Seleccione...</option>
                <option value="Padre" {{ old('tutor_secundario.TipoTutor', $participante->tutorSecundario->TipoTutor ?? '') == 'Padre' ? 'selected' : '' }}>Padre</option>
                <option value="Madre" {{ old('tutor_secundario.TipoTutor', $participante->tutorSecundario->TipoTutor ?? '') == 'Madre' ? 'selected' : '' }}>Madre</option>
                <option value="Abuelo/a" {{ old('tutor_secundario.TipoTutor', $participante->tutorSecundario->TipoTutor ?? '') == 'Abuelo/a' ? 'selected' : '' }}>Abuelo/a</option>
                <option value="Tío/a" {{ old('tutor_secundario.TipoTutor', $participante->tutorSecundario->TipoTutor ?? '') == 'Tío/a' ? 'selected' : '' }}>Tío/a</option>
                <option value="Hermano/a" {{ old('tutor_secundario.TipoTutor', $participante->tutorSecundario->TipoTutor ?? '') == 'Hermano/a' ? 'selected' : '' }}>Hermano/a</option>
                <option value="Otro" {{ old('tutor_secundario.TipoTutor', $participante->tutorSecundario->TipoTutor ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>
        <div>
            <label for="tutorSCedula" class="block text-sm font-medium text-gray-700">Número de Cédula</label>
            <input type="text" id="tutorSCedula" name="tutor_secundario[Tutor_Cedula]" placeholder="Dejar vacío si no aplica" value="{{ old('tutor_secundario.Tutor_Cedula', $participante->tutorSecundario->Tutor_Cedula ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="tutorSNombres" class="block text-sm font-medium text-gray-700">Nombres</label>
            <input type="text" id="tutorSNombres" name="tutor_secundario[Nombres]" value="{{ old('tutor_secundario.Nombres', $participante->tutorSecundario->Nombres ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="tutorSApellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
            <input type="text" id="tutorSApellidos" name="tutor_secundario[Apellidos]" value="{{ old('tutor_secundario.Apellidos', $participante->tutorSecundario->Apellidos ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="tutorSComunidad" class="block text-sm font-medium text-gray-700">Comunidad / Barrio</label>
            <select id="tutorSComunidad" name="tutor_secundario[Comunidad_ID]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Seleccione...</option>
                @foreach ($comunidades as $comunidad)
                    <option value="{{ $comunidad->Comunidad_ID }}" {{ old('tutor_secundario.Comunidad_ID', $participante->tutorSecundario->Comunidad_ID ?? '') == $comunidad->Comunidad_ID ? 'selected' : '' }}>{{ $comunidad->NombreComunidad }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="tutorSTelefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
            <input type="tel" id="tutorSTelefono" name="tutor_secundario[Telefono]" value="{{ old('tutor_secundario.Telefono', $participante->tutorSecundario->Telefono ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>
    </div>
</fieldset>

                <!-- Sección Documentación -->
                <fieldset class="bg-white p-8 rounded-lg shadow-md border border-gray-200">
                    <legend class="text-xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-4">Documentación Requerida</legend>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                        <div>
                            <label for="tieneCedula" class="block text-sm font-medium text-gray-700">¿Tiene Cédula? <span class="text-red-500">*</span></label>
                            <select id="tieneCedula" name="documentacion[TieneCedula]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="1" {{ old('documentacion.TieneCedula', $participante->inscripcion->documentacion->TieneCedula ?? '') == '1' ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ old('documentacion.TieneCedula', $participante->inscripcion->documentacion->TieneCedula ?? '') == '0' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div>
                            <label for="tienePartidaNacimiento" class="block text-sm font-medium text-gray-700">¿Tiene Partida de Nacimiento? <span class="text-red-500">*</span></label>
                            <select id="tienePartidaNacimiento" name="documentacion[TienePartidaNacimiento]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="1" {{ old('documentacion.TienePartidaNacimiento', $participante->inscripcion->documentacion->TienePartidaNacimiento ?? '') == '1' ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ old('documentacion.TienePartidaNacimiento', $participante->inscripcion->documentacion->TienePartidaNacimiento ?? '') == '0' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div>
                            <label for="tieneBoletinDiploma" class="block text-sm font-medium text-gray-700">¿Tiene Boletín o Diploma? <span class="text-red-500">*</span></label>
                            <select id="tieneBoletinDiploma" name="documentacion[TieneBoletinDiploma]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="1" {{ old('documentacion.TieneBoletinDiploma', $participante->inscripcion->documentacion->TieneBoletinDiploma ?? '') == '1' ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ old('documentacion.TieneBoletinDiploma', $participante->inscripcion->documentacion->TieneBoletinDiploma ?? '') == '0' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div>
                            <label for="tieneCopiaCedulaTutor" class="block text-sm font-medium text-gray-700">¿Tiene Copia de Cédula del Tutor? <span class="text-red-500">*</span></label>
                            <select id="tieneCopiaCedulaTutor" name="documentacion[TieneCopiaCedulaTutor]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="1" {{ old('documentacion.TieneCopiaCedulaTutor', $participante->inscripcion->documentacion->TieneCopiaCedulaTutor ?? '') == '1' ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ old('documentacion.TieneCopiaCedulaTutor', $participante->inscripcion->documentacion->TieneCopiaCedulaTutor ?? '') == '0' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                <!-- Botones -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('participante.index') }}"
                       class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        Actualizar Participante
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts para funcionalidad dinámica -->
    <script>
       function calcularEdad() {
            const fechaNacimientoInput = document.getElementById('fechaNacimientoP');
            const edadInput = document.getElementById('edadP');
            const fechaNacimiento = fechaNacimientoInput.value;

            if (fechaNacimiento) {
                const hoy = new Date();
                const nacimientoParts = fechaNacimiento.split('-');
                const nacimiento = new Date(parseInt(nacimientoParts[0]), parseInt(nacimientoParts[1]) - 1, parseInt(nacimientoParts[2]));


                let edad = hoy.getFullYear() - nacimiento.getFullYear();
                const mes = hoy.getMonth() - nacimiento.getMonth();
                if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) { edad--; }

                const edadCalculada = Math.max(0, edad);
                edadInput.value = edadCalculada;
                mostrarCamposAdulto(edadCalculada);
            } else {
                edadInput.value = '';
                mostrarCamposAdulto(null);
            }
        }

        function toggleSubprogramas() {
            const programaId = document.getElementById('programaId').value;
            const subprogramasContainer = document.getElementById('subprogramasContainer');
            const exitoAcademicoSubprogramas = document.getElementById('exitoAcademicoSubprogramas');
            const bibliotecaSubprogramas = document.getElementById('bibliotecaSubprogramas');
            const desarrolloJuvenilSubprogramas = document.getElementById('desarrolloJuvenilSubprogramas');

            subprogramasContainer.classList.add('hidden');
            exitoAcademicoSubprogramas.classList.add('hidden');
            bibliotecaSubprogramas.classList.add('hidden');
            desarrolloJuvenilSubprogramas.classList.add('hidden');

            @foreach ($programas as $programa)
                if (programaId == '{{ $programa->Programa_ID }}') {
                    @if ($programa->NombrePrograma == 'Exito Academico')
                        subprogramasContainer.classList.remove('hidden');
                        exitoAcademicoSubprogramas.classList.remove('hidden');
                    @elseif ($programa->NombrePrograma == 'Biblioteca')
                        subprogramasContainer.classList.remove('hidden');
                        bibliotecaSubprogramas.classList.remove('hidden');
                    @elseif ($programa->NombrePrograma == 'Desarrollo Juvenil')
                        subprogramasContainer.classList.remove('hidden');
                        desarrolloJuvenilSubprogramas.classList.remove('hidden');
                    @endif
                }
            @endforeach
        }

        function toggleOtrosProgramas() {
            const asisteOtrosProg = document.getElementById('asisteOtrosProg').value;
            const descOtrosProgContainer = document.getElementById('descOtrosProgContainer');
            descOtrosProgContainer.classList.toggle('hidden', asisteOtrosProg != '1');
        }

        // Ejecutar al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            calcularEdad();
            toggleSubprogramas();
            toggleOtrosProgramas();
        });
    </script>
</x-app-layout>