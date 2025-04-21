<x-app-layout>
    
    <div class="bg-gray-100 font-sans py-12">
        <div class="max-w-4xl mx-auto p-8 bg-white rounded-xl shadow-xl">
            <h1 class="text-3xl font-semibold text-gray-800 text-center mb-8">Formulario de inscripción CREA</h1>

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

            <form action="{{ route('participante.store') }}" method="POST" class="space-y-8">
                @csrf

               <!-- Sección Inscripción Inicial -->
               <fieldset class="bg-white p-8 rounded-xl shadow-md border border-gray-100">
                <div class="space-y-4">
                    <label for="FechaInscripcion" class="block text-sm font-semibold text-gray-700 tracking-wide mb-2">
                        📅 Fecha de inscripción
                        <span class="text-red-400 ml-1">*</span>
                    </label>
                    
                    <input type="text" 
                           id="FechaInscripcion" 
                           name="inscripcion[FechaInscripcion]" 
                           required 
                           value="{{ old('inscripcion.FechaInscripcion', isset($inscripcion) ? \Carbon\Carbon::parse($inscripcion->fecha_inscripcion)->format('d-m-Y') : '') }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-200 hover:border-gray-300 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 placeholder-gray-400/70 text-gray-600 font-medium transition-all duration-200"
                           placeholder="dd-mm-aaaa"
                           pattern="(0[1-9]|[12][0-9]|3[01])-(0[1-9]|1[012])-\d{4}"
                           title="Por favor ingresa una fecha en formato dd-mm-aaaa">
                    
                    <!-- Mensaje de validación -->
                    @error('inscripcion.FechaInscripcion')
                        <p class="mt-2 text-sm text-rose-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                
            </fieldset>

<!-- Inicialización de Flatpickr -->
<script>
    flatpickr("#FechaInscripcion", {
        locale: "es",
        dateFormat: "d-m-Y", // Muy importante que coincida con lo que espera el backend
        maxDate: "today"
    });
</script>


                 <!-- Sección Documentación Requerida -->
                 <fieldset class="bg-white p-8 rounded-lg shadow-md border border-gray-200">
                    <legend class="text-xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-4">Documentación requerida</legend>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">¿Tiene copia de cédula? <span class="text-red-500">*</span></label>
                            <div class="mt-2 space-x-6">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="documentacion[TieneCedula]" value="1" {{ old('documentacion.TieneCedula', '0') == '1' ? 'checked' : '' }} required
                                           class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-600">Sí</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="documentacion[TieneCedula]" value="0" {{ old('documentacion.TieneCedula', '0') == '0' ? 'checked' : '' }}
                                           class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-600">No</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">¿Tiene copia de partida de nacimiento? <span class="text-red-500">*</span></label>
                            <div class="mt-2 space-x-6">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="documentacion[TienePartidaNacimiento]" value="1" {{ old('documentacion.TienePartidaNacimiento', '0') == '1' ? 'checked' : '' }} required
                                           class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-600">Sí</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="documentacion[TienePartidaNacimiento]" value="0" {{ old('documentacion.TienePartidaNacimiento', '0') == '0' ? 'checked' : '' }}
                                           class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-600">No</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">¿Tiene copia de Boletín/Diploma?<span class="text-red-500">*</span></label>
                            <div class="mt-2 space-x-6">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="documentacion[TieneBoletinDiploma]" value="1" {{ old('documentacion.TieneBoletinDiploma', '0') == '1' ? 'checked' : '' }} required
                                           class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-600">Sí</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="documentacion[TieneBoletinDiploma]" value="0" {{ old('documentacion.TieneBoletinDiploma', '0') == '0' ? 'checked' : '' }}
                                           class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-600">No</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">¿Tiene copia de cédula del tutor? <span class="text-red-500">*</span></label>
                            <div class="mt-2 space-x-6">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="documentacion[TieneCopiaCedulaTutor]" value="1" {{ old('documentacion.TieneCopiaCedulaTutor', '0') == '1' ? 'checked' : '' }} required
                                           class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-600">Sí</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="documentacion[TieneCopiaCedulaTutor]" value="0" {{ old('documentacion.TieneCopiaCedulaTutor', '0') == '0' ? 'checked' : '' }}
                                           class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-600">No</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                
                <!-- Sección Información del Participante -->
                <fieldset class="bg-white p-8 rounded-lg shadow-md border border-gray-200">
                    <legend class="text-xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-4">Información del participante</legend>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6 gap-y-6">
                        <div>
                            <label for="tipoParticipante" class="block text-sm font-medium text-gray-700">Participante <span class="text-red-500">*</span></label>
                            <select id="tipoParticipante" onchange="mostrarCamposAdulto(this.value)" name="participante[TipoParticipante]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="" {{ old('participante.TipoParticipante') == '' ? 'selected' : '' }}>Seleccione...</option>
                                <option value="Preescolar" {{ old('participante.TipoParticipante') == 'Preescolar' ? 'selected' : '' }}>Preescolar (o menos)</option>
                                <option value="Primaria" {{ old('participante.TipoParticipante') == 'Primaria' ? 'selected' : '' }}>Primaria</option>
                                <option value="Secundaria" {{ old('participante.TipoParticipante') == 'Secundaria' ? 'selected' : '' }}>Secundaria</option>
                                <option value="Adulto" {{ old('participante.TipoParticipante') == 'Adulto' ? 'selected' : '' }}>Adulto</option>
                            </select>
                            @error('participante.TipoParticipante')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="primerNombreP" class="block text-sm font-medium text-gray-700">Primer Nombre <span class="text-red-500">*</span></label>
                            <input type="text" id="primerNombreP" name="participante[PrimerNombre]" required value="{{ old('participante.PrimerNombre') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="segundoNombreP" class="block text-sm font-medium text-gray-700">Segundo Nombre</label>
                            <input type="text" id="segundoNombreP" name="participante[SegundoNombre]" value="{{ old('participante.SegundoNombre') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="primerApellidoP" class="block text-sm font-medium text-gray-700">Primer Apellido <span class="text-red-500">*</span></label>
                            <input type="text" id="primerApellidoP" name="participante[PrimerApellido]" required value="{{ old('participante.PrimerApellido') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="segundoApellidoP" class="block text-sm font-medium text-gray-700">Segundo Apellido</label>
                            <input type="text" id="segundoApellidoP" name="participante[SegundoApellido]" value="{{ old('participante.SegundoApellido') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="fechaNacimientoP" class="block text-sm font-medium text-gray-700">Fecha de nacimiento <span class="text-red-500">*</span></label>
                            <input type="date" id="fechaNacimientoP" name="participante[FechaNacimiento]" required oninput="calcularEdad()" value="{{ old('participante.FechaNacimiento') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="edadP" class="block text-sm font-medium text-gray-700">Edad</label>
                            <input type="number" id="edadP" name="participante[Edad]" min="0" readonly value="{{ old('participante.Edad') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-gray-100 cursor-not-allowed">
                        </div>
                        <div>
                            <label for="generoP" class="block text-sm font-medium text-gray-700">Género</label>
                            <select id="generoP" name="participante[Genero]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="" {{ old('participante.Genero') == '' ? 'selected' : '' }}>Seleccione...</option>
                                <option value="Masculino" {{ old('participante.Genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino" {{ old('participante.Genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            </select>
                        </div>
                        <div class="campo-adulto">
                            <label for="cedulaP" class="block text-sm font-medium text-gray-700">Cédula <span class="text-xs text-gray-500" id="labelCedula">(Si aplica / Adulto)</span></label>
                            <input type="text" id="cedulaP" name="participante[CedulaParticipante]" placeholder="Ej: 001-123456-0001A" value="{{ old('participante.CedulaParticipante') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="comunidadP" class="block text-sm font-medium text-gray-700">Comunidad / Barrio</label>
                            <select id="comunidadP" name="participante[Comunidad_ID]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Seleccione...</option>
                                @foreach ($comunidades as $comunidad)
                                    <option value="{{ $comunidad->Comunidad_ID }}" {{ old('participante.Comunidad_ID') == $comunidad->Comunidad_ID ? 'selected' : '' }}>
                                        {{ $comunidad->NombreComunidad }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="ciudadP" class="block text-sm font-medium text-gray-700">Ciudad</label>
                            <input type="text" id="ciudadP" name="participante[Ciudad]" value="{{ old('participante.Ciudad') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="departamentoP" class="block text-sm font-medium text-gray-700">Departamento</label>
                            <input type="text" id="departamentoP" name="participante[Departamento]" value="{{ old('participante.Departamento') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    <!-- Campos para Adultos -->
                    <div class="campo-adulto hidden mt-8 pt-6 border-t border-gray-200">
                        <p class="text-sm font-medium text-gray-500 mb-4">Información adicional</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                            <div>
                                <label for="sectorEconomicoAdulto" class="block text-sm font-medium text-gray-700">Sector económico</label>
                                <input type="text" id="sectorEconomicoAdulto" name="participante[SectorEconomicoAdulto]" value="{{ old('participante.SectorEconomicoAdulto') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="nivelEducacionAdulto" class="block text-sm font-medium text-gray-700">Nivel de educación formal</label>
                                <input type="text" id="nivelEducacionAdulto" name="participante[NivelEducacionAdulto]" value="{{ old('participante.NivelEducacionAdulto') }}"
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
                            <label for="nombreEscuela" class="block text-sm font-medium text-gray-700">Nombre de la escuela <span class="text-red-500">*</span></label>
                            <input type="text" id="nombreEscuela" name="escuela[NombreEscuela]" required value="{{ old('escuela.NombreEscuela') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="comunidadEscuela" class="block text-sm font-medium text-gray-700">Comunidad/Barrio de la escuela</label>
                            
                            <!-- Select para comunidades existentes -->
                            <select id="comunidadEscuela" name="escuela[Comunidad_ID]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" onchange="toggleNuevoCampo()">
                                <option value="">Seleccione...</option>
                                @foreach ($comunidades as $comunidad)
                                    <option value="{{ $comunidad->Comunidad_ID }}" {{ old('escuela.Comunidad_ID') == $comunidad->Comunidad_ID ? 'selected' : '' }}>
                                        {{ $comunidad->NombreComunidad }}
                                    </option>
                                @endforeach
                                <option value="otra">Otra</option> 
                            </select>
                        
                            <!-- Campo para agregar nueva comunidad (oculto por defecto) -->
                            <div id="nuevaComunidadContainer" class="hidden mt-4">
                                <label for="nuevaComunidad" class="block text-sm font-medium text-gray-700">Agregar nueva Comunidad</label>
                                <input type="text" id="nuevaComunidad" name="escuela[NuevaComunidad]" placeholder="Ingrese el nombre de la nueva comunidad" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        
                        <div>
                            <label for="gradoActualP" class="block text-sm font-medium text-gray-700">Grado actual<span class="text-red-500">*</span></label>
                            <select id="gradoActualP" name="participante[GradoActual]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Seleccione...</option>
                                @for ($i = 0; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ old('participante.GradoActual', '') === (string)$i ? 'selected' : '' }}>
                                        {{ $i == 0 ? '0 (Preescolar)' : $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label for="turnoEscolarP" class="block text-sm font-medium text-gray-700">Turno escolar</label>
                            <select id="turnoEscolarP" name="participante[TurnoEscolar]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="" {{ old('participante.TurnoEscolar') == '' ? 'selected' : '' }}>Seleccione...</option>
                                <option value="Matutino" {{ old('participante.TurnoEscolar') == 'Matutino' ? 'selected' : '' }}>Matutino</option>
                                <option value="Vespertino" {{ old('participante.TurnoEscolar') == 'Vespertino' ? 'selected' : '' }}>Vespertino</option>
                                <option value="Sabatino" {{ old('participante.TurnoEscolar') == 'Sabatino' ? 'selected' : '' }}>Sabatino</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="repiteGradoP" class="block text-sm font-medium text-gray-700">¿Repite grado?</label>
                            <select id="repiteGradoP" name="participante[RepiteGrado]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Seleccione...</option>
                                <option value="1" {{ old('participante.RepiteGrado') == '1' ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ old('participante.RepiteGrado', '') === '0' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                <!-- Sección Inscripción al Programa -->
                <fieldset class="bg-white p-8 rounded-lg shadow-md border border-gray-200">
                    <legend class="text-xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-4">Inscripción a programas</legend>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                        <div>
                            <label for="programaId" class="block text-sm font-medium text-gray-700">Programa al que se inscribe <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                @foreach ($programas as $programa)
                                    <div class="flex items-center mb-2">
                                        <input 
                                            type="radio" 
                                            id="programa_{{ $programa->Programa_ID }}" 
                                            name="inscripcion[Programa_ID]" 
                                            value="{{ $programa->Programa_ID }}" 
                                            {{ old('inscripcion.Programa_ID') == $programa->Programa_ID ? 'checked' : '' }} 
                                            onchange="toggleSubprogramas()" 
                                            required 
                                            class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                        >
                                        <label for="programa_{{ $programa->Programa_ID }}" class="ml-2 text-sm text-gray-900">
                                            {{ $programa->NombrePrograma }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Nuevo Campo: Lugar de Encuentro -->
                        <div>
                            <label for="lugarEncuentro" class="block text-sm font-medium text-gray-700">Lugar de encuentro <span class="text-red-500">*</span></label>
                            <select id="lugarEncuentro" name="inscripcion[LugarEncuentro_ID]" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Seleccione un lugar...</option>
                                @foreach ($lugaresEncuentro as $lugar)
                                    <option value="{{ $lugar->LugarEncuentro_ID }}" {{ old('inscripcion.LugarEncuentro_ID') == $lugar->LugarEncuentro_ID ? 'selected' : '' }}>
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
                                <p class="text-sm font-medium text-gray-600 mb-2">Exito Academico</p>
                                <label class="flex items-center text-sm text-gray-600">
                                    <input type="checkbox" name="inscripcion[Subprogramas][RAC]" value="RAC" {{ in_array('RAC', old('inscripcion.Subprogramas', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> RAC
                                </label>
                                <label class="flex items-center text-sm text-gray-600">
                                    <input type="checkbox" name="inscripcion[Subprogramas][RACREA]" value="RACREA" {{ in_array('RACREA', old('inscripcion.Subprogramas', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> RACREA
                                </label>
                            </div>
                            <!-- Biblioteca -->
                            <div id="bibliotecaSubprogramas" class="hidden">
                                <p class="text-sm font-medium text-gray-600 mb-2">Biblioteca</p>
                                <label class="flex items-center text-sm text-gray-600">
                                    <input type="checkbox" name="inscripcion[Subprogramas][CLC]" value="CLC" {{ in_array('CLC', old('inscripcion.Subprogramas', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> CLC
                                </label>
                                <label class="flex items-center text-sm text-gray-600">
                                    <input type="checkbox" name="inscripcion[Subprogramas][CLCREA]" value="CLCREA" {{ in_array('CLCREA', old('inscripcion.Subprogramas', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> CLCREA
                                </label>
                                <label class="flex items-center text-sm text-gray-600">
                                    <input type="checkbox" name="inscripcion[Subprogramas][BM]" value="BM" {{ in_array('BM', old('inscripcion.Subprogramas', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> BM
                                </label>
                                <label class="flex items-center text-sm text-gray-600">
                                    <input type="checkbox" name="inscripcion[Subprogramas][CLM]" value="CLM" {{ in_array('CLM', old('inscripcion.Subprogramas', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> CLM
                                </label>
                            </div>
                            <!-- Desarrollo Juvenil -->
                            <div id="desarrolloJuvenilSubprogramas" class="hidden">
                                <p class="text-sm font-medium text-gray-600 mb-2">Desarrollo Juvenil</p>
                                <label class="flex items-center text-sm text-gray-600">
                                    <input type="checkbox" name="inscripcion[Subprogramas][DJ]" value="DJ" {{ in_array('DJ', old('inscripcion.Subprogramas', [])) ? 'checked' : '' }}
                                           class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> DJ
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Días de asistencia esperados</label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @php $diasSeleccionados = old('inscripcion.DiasAsistenciaEsperados', []); @endphp
                            @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dia)
                                <label class="flex items-center text-sm text-gray-600">
                                    <input type="checkbox" name="inscripcion[DiasAsistenciaEsperados][]" value="{{ $dia }}" @if(in_array($dia, $diasSeleccionados)) checked @endif
                                           class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2"> {{ $dia }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-6">
                        <label for="expectativasTutor" class="block text-sm font-medium text-gray-700">Expectativas del tutor principal sobre el programa</label>
                        <textarea id="expectativasTutor" name="inscripcion[ExpectativasTutorPrincipal]" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('inscripcion.ExpectativasTutorPrincipal') }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6 mt-6">
                        <div>
                            <label for="asisteOtrosProg" class="block text-sm font-medium text-gray-700">¿El participante asiste a otros programas?</label>
                            <select id="asisteOtrosProg" name="participante[AsisteOtrosProgramasComunidad]" onchange="toggleOtrosProgramas()"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="0" {{ old('participante.AsisteOtrosProgramasComunidad', '0') == '0' ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('participante.AsisteOtrosProgramasComunidad') == '1' ? 'selected' : '' }}>Sí</option>
                            </select>
                        </div>
                        <div id="descOtrosProgContainer" class="{{ old('participante.AsisteOtrosProgramasComunidad') == '1' ? '' : 'hidden' }}">
                            <label for="descOtrosProg" class="block text-sm font-medium text-gray-700">Si asiste a otros, ¿cuáles y qué días? <span class="text-xs text-gray-500">(Opcional)</span></label>
                            <textarea id="descOtrosProg" name="participante[DescripcionOtrosProgramas]" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('participante.DescripcionOtrosProgramas') }}</textarea>
                        </div>
                    </div>
                </fieldset>

                <!-- Sección Información del Tutor Principal -->
                <fieldset class="bg-white p-8 rounded-lg shadow-md border border-gray-200">
                    <legend class="text-xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-4">Información del Tutor Principal</legend>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                        <div>
                            <label for="tutorPTipo" class="block text-sm font-medium text-gray-700">Tutor <span class="text-red-500">*</span></label>
                            <select id="tutorPTipo" name="tutor_principal[TipoTutor]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="" {{ old('tutor_principal.TipoTutor') == '' ? 'selected' : '' }}>Seleccione...</option>
                                <option value="Padre" {{ old('tutor_principal.TipoTutor') == 'Padre' ? 'selected' : '' }}>Padre</option>
                                <option value="Madre" {{ old('tutor_principal.TipoTutor') == 'Madre' ? 'selected' : '' }}>Madre</option>
                                <option value="Abuelo/a" {{ old('tutor_principal.TipoTutor') == 'Abuelo/a' ? 'selected' : '' }}>Abuelo/a</option>
                                <option value="Tío/a" {{ old('tutor_principal.TipoTutor') == 'Tío/a' ? 'selected' : '' }}>Tío/a</option>
                                <option value="Hermano/a" {{ old('tutor_principal.TipoTutor') == 'Hermano/a' ? 'selected' : '' }}>Hermano/a</option>
                                <option value="Otro" {{ old('tutor_principal.TipoTutor') == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                        <div>
                            <label for="tutorPCedula" class="block text-sm font-medium text-gray-700">Número de cédula <span class="text-red-500">*</span></label>
                            <input type="text" id="tutorPCedula" name="tutor_principal[Tutor_Cedula]" placeholder="Ej: 001-123456-0002B" required value="{{ old('tutor_principal.Tutor_Cedula') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="tutorPNombres" class="block text-sm font-medium text-gray-700">Nombres <span class="text-red-500">*</span></label>
                            <input type="text" id="tutorPNombres" name="tutor_principal[Nombres]" required value="{{ old('tutor_principal.Nombres') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="tutorPApellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
                            <input type="text" id="tutorPApellidos" name="tutor_principal[Apellidos]" value="{{ old('tutor_principal.Apellidos') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="tutorPComunidad" class="block text-sm font-medium text-gray-700">Comunidad/Barrio</label>
                            <select id="tutorPComunidad" name="tutor_principal[Comunidad_ID]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" onchange="toggleNuevoCampo()">
                                <option value="">Seleccione...</option>
                                @foreach ($comunidades as $comunidad)
                                    <option value="{{ $comunidad->Comunidad_ID }}" {{ old('tutor_principal.Comunidad_ID') == $comunidad->Comunidad_ID ? 'selected' : '' }}>{{ $comunidad->NombreComunidad }}</option>
                                @endforeach
                                <option value="otra">Otra</option> <!-- Opción "Otra" para agregar una nueva comunidad -->
                            </select>
                        
                            <!-- Campo para agregar nueva comunidad (oculto por defecto) -->
                            <div id="nuevaComunidadContainer1" class="hidden mt-4">
                                <label for="nuevaComunidad" class="block text-sm font-medium text-gray-700">Nueva comunidad</label>
                                <input type="text" id="nuevaComunidad" name="tutor_principal[NuevaComunidad]" placeholder="Ingrese el nombre de la nueva comunidad" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        
                        <div>
                            <label for="tutorPTelefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                            <input type="tel" id="tutorPTelefono" name="tutor_principal[Telefono]" value="{{ old('tutor_principal.Telefono') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label for="tutorPDireccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                            <textarea id="tutorPDireccion" name="tutor_principal[Direccion]" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('tutor_principal.Direccion') }}</textarea>
                        </div>
                        <div>
                            <label for="tutorPSector" class="block text-sm font-medium text-gray-700">Sector económico</label>
                            <select id="tutorPSector" name="tutor_principal[SectorEconomico]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="" {{ old('tutor_principal.SectorEconomico') == '' ? 'selected' : '' }}>Seleccione...</option>
                                <option value="Agricultura" {{ old('tutor_principal.SectorEconomico') == 'Agricultura' ? 'selected' : '' }}>Agricultura</option>
                                <option value="Comercio" {{ old('tutor_principal.SectorEconomico') == 'Comercio' ? 'selected' : '' }}>Comercio</option>
                                <option value="Construcción" {{ old('tutor_principal.SectorEconomico') == 'Construcción' ? 'selected' : '' }}>Construcción</option>
                                <option value="Educación" {{ old('tutor_principal.SectorEconomico') == 'Educación' ? 'selected' : '' }}>Educación</option>
                                <option value="Salud" {{ old('tutor_principal.SectorEconomico') == 'Salud' ? 'selected' : '' }}>Salud</option>
                                <option value="Servicios" {{ old('tutor_principal.SectorEconomico') == 'Servicios' ? 'selected' : '' }}>Servicios</option>
                                <option value="Tecnología" {{ old('tutor_principal.SectorEconomico') == 'Tecnología' ? 'selected' : '' }}>Tecnología</option>
                                <option value="Transporte" {{ old('tutor_principal.SectorEconomico') == 'Transporte' ? 'selected' : '' }}>Transporte</option>
                                <option value="Otro" {{ old('tutor_principal.SectorEconomico') == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                        <div>
                            <label for="tutorPNivelEducacion" class="block text-sm font-medium text-gray-700">Nivel de educación formal</label>
                            <select id="tutorPNivelEducacion" name="tutor_principal[NivelEducacionFormal]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="" {{ old('tutor_principal.NivelEducacionFormal') == '' ? 'selected' : '' }}>Seleccione...</option>
                                <option value="Sin educación formal" {{ old('tutor_principal.NivelEducacionFormal') == 'Sin educación formal' ? 'selected' : '' }}>Sin educación formal</option>
                                <option value="Primaria incompleta" {{ old('tutor_principal.NivelEducacionFormal') == 'Primaria incompleta' ? 'selected' : '' }}>Primaria</option>
                                <option value="Secundaria incompleta" {{ old('tutor_principal.NivelEducacionFormal') == 'Secundaria incompleta' ? 'selected' : '' }}>Secundaria</option>
                                <option value="Técnico" {{ old('tutor_principal.NivelEducacionFormal') == 'Técnico' ? 'selected' : '' }}>Técnico</option>
                                <option value="Universitario incompleto" {{ old('tutor_principal.NivelEducacionFormal') == 'Universitario incompleto' ? 'selected' : '' }}>Universitario</option>
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
                                <option value="" {{ old('tutor_secundario.TipoTutor') == '' ? 'selected' : '' }}>Seleccione...</option>
                                <option value="Padre" {{ old('tutor_secundario.TipoTutor') == 'Padre' ? 'selected' : '' }}>Padre</option>
                                <option value="Madre" {{ old('tutor_secundario.TipoTutor') == 'Madre' ? 'selected' : '' }}>Madre</option>
                                <option value="Abuelo/a" {{ old('tutor_secundario.TipoTutor') == 'Abuelo/a' ? 'selected' : '' }}>Abuelo/a</option>
                                <option value="Tío/a" {{ old('tutor_secundario.TipoTutor') == 'Tío/a' ? 'selected' : '' }}>Tío/a</option>
                                <option value="Hermano/a" {{ old('tutor_secundario.TipoTutor') == 'Hermano/a' ? 'selected' : '' }}>Hermano/a</option>
                                <option value="Otro" {{ old('tutor_secundario.TipoTutor') == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                        <div>
                            <label for="tutorSCedula" class="block text-sm font-medium text-gray-700">Número de Cédula</label>
                            <input type="text" id="tutorSCedula" name="tutor_secundario[Tutor_Cedula]" placeholder="Dejar vacío si no aplica" value="{{ old('tutor_secundario.Tutor_Cedula') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="tutorSNombres" class="block text-sm font-medium text-gray-700">Nombres</label>
                            <input type="text" id="tutorSNombres" name="tutor_secundario[Nombres]" value="{{ old('tutor_secundario.Nombres') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="tutorSApellidos" class="block text-sm font-medium text-gray-700">Apellidos</label>
                            <input type="text" id="tutorSApellidos" name="tutor_secundario[Apellidos]" value="{{ old('tutor_secundario.Apellidos') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="tutorSComunidad" class="block text-sm font-medium text-gray-700">Comunidad / Barrio</label>
                            <select id="tutorSComunidad" name="tutor_secundario[Comunidad_ID]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Seleccione...</option>
                                @foreach ($comunidades as $comunidad)
                                    <option value="{{ $comunidad->Comunidad_ID }}" {{ old('tutor_secundario.Comunidad_ID') == $comunidad->Comunidad_ID ? 'selected' : '' }}>{{ $comunidad->NombreComunidad }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="tutorSTelefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                            <input type="tel" id="tutorSTelefono" name="tutor_secundario[Telefono]" value="{{ old('tutor_secundario.Telefono') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    </div>
                </fieldset>

                <x-boton-regresar onclick="window.location.href='{{ route('participante.index') }}'">Volver</x-boton-regresar>


                <!-- Botón de Envío -->
                <x-boton-flotante>
                    Registrar participante
                </x-boton-flotante>
                
            </form>
        </div>
    </div>

    <script>
        // Función para calcular la edad basada en la fecha de nacimiento
        function calcularEdad() {
            const fechaNacimientoInput = document.getElementById('fechaNacimientoP');
            const edadInput = document.getElementById('edadP');
            const fechaNacimiento = fechaNacimientoInput.value;

            if (fechaNacimiento) {
                const hoy = new Date();
                const nacimientoParts = fechaNacimiento.split('-');
                const nacimiento = new Date(parseInt(nacimientoParts[0]), parseInt(nacimientoParts[1]) - 1, parseInt(nacimientoParts[2]));

                if (isNaN(nacimiento.getTime())) {
                    console.error("Fecha inválida");
                    edadInput.value = '';
                    mostrarCamposAdulto(null);
                    return;
                }

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

// Función para mostrar u ocultar campos específicos para adultos
function mostrarCamposAdulto(tipoParticipante) {
    const camposAdultoContainer = document.querySelectorAll('.campo-adulto');
    const cedulaLabelSpan = document.getElementById('labelCedula');

    if (cedulaLabelSpan) {
        if (tipoParticipante === 'Adulto') {
            // Muestra todos los campos relacionados con el adulto
            camposAdultoContainer.forEach(container => {
                container.classList.remove('hidden');
            });
            cedulaLabelSpan.textContent = '(Requerido / Adulto)';
        } else {
            // Oculta todos los campos relacionados con el adulto
            camposAdultoContainer.forEach(container => {
                container.classList.add('hidden');
            });
            cedulaLabelSpan.textContent = '(Si aplica / Adulto)';
        }
    }
}


// Función para mostrar el campo de nueva comunidad si se selecciona "Otra"
function toggleNuevoCampo() {
    const comunidadEscuelaSelect = document.getElementById('comunidadEscuela');
    const comunidadTutorSelect = document.getElementById('tutorPComunidad');
    const nuevaComunidadContainer = document.getElementById('nuevaComunidadContainer');
    const nuevaComunidadContainer1 = document.getElementById('nuevaComunidadContainer1');

    // Si el valor del select de comunidadEscuela es "otra", mostramos el campo para agregar nueva comunidad
    if (comunidadEscuelaSelect.value === "otra") {
        nuevaComunidadContainer.classList.remove('hidden');
    } else {
        nuevaComunidadContainer.classList.add('hidden');
    }

    // Si el valor del select de comunidadTutor es "otra", mostramos el campo para agregar nueva comunidad
    // Si necesitas lógica separada para comunidadTutor, puedes agregarla aquí
    if (comunidadTutorSelect.value === "otra") {
        nuevaComunidadContainer1.classList.remove('hidden');
    } else {
        nuevaComunidadContainer1.classList.add('hidden');
    }
}




        // Función para mostrar/ocultar el textarea de otros programas
        function toggleOtrosProgramas() {
            const asisteOtrosProgSelect = document.getElementById('asisteOtrosProg');
            const descOtrosProgContainer = document.getElementById('descOtrosProgContainer');
            const descOtrosProgTextarea = document.getElementById('descOtrosProg');

            if (asisteOtrosProgSelect && descOtrosProgContainer && descOtrosProgTextarea) {
                if (asisteOtrosProgSelect.value === '1') {
                    descOtrosProgContainer.classList.remove('hidden');
                } else {
                    descOtrosProgContainer.classList.add('hidden');
                    descOtrosProgTextarea.value = '';
                }
            }
        }

        function toggleSubprogramas() {
    // Obtener el radio button seleccionado
    const selectedPrograma = document.querySelector('input[name="inscripcion[Programa_ID]"]:checked');
    const subprogramasContainer = document.getElementById('subprogramasContainer');
    const exitoAcademicoSubprogramas = document.getElementById('exitoAcademicoSubprogramas');
    const bibliotecaSubprogramas = document.getElementById('bibliotecaSubprogramas');
    const desarrolloJuvenilSubprogramas = document.getElementById('desarrolloJuvenilSubprogramas');

    // Ocultar todos los subprogramas por defecto
    subprogramasContainer.classList.add('hidden');
    exitoAcademicoSubprogramas.classList.add('hidden');
    bibliotecaSubprogramas.classList.add('hidden');
    desarrolloJuvenilSubprogramas.classList.add('hidden');

    // Si hay un programa seleccionado, obtener su nombre
    if (selectedPrograma) {
        // Obtener el label asociado al radio button seleccionado
        const label = document.querySelector(`label[for="${selectedPrograma.id}"]`);
        const programaNombre = label ? label.textContent.trim() : '';

        // Mostrar contenedor principal si hay selección válida
        if (programaNombre !== '') {
            subprogramasContainer.classList.remove('hidden');

            // Mostrar el bloque correspondiente según el programa
            if (programaNombre === 'Exito Academico') {
                exitoAcademicoSubprogramas.classList.remove('hidden');
            } else if (programaNombre === 'Biblioteca') {
                bibliotecaSubprogramas.classList.remove('hidden');
            } else if (programaNombre === 'Desarrollo Juvenil') {
                desarrolloJuvenilSubprogramas.classList.remove('hidden');
            }
        }
    }
}

        // Ejecutar al cargar la página para establecer el estado inicial
        document.addEventListener('DOMContentLoaded', function() {
            calcularEdad();
            toggleOtrosProgramas();
            toggleSubprogramas();
        });
    </script>
</x-app-layout>