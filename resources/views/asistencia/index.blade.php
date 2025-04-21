<x-app-layout>
    <div class="container mx-auto p-6">
        <!-- Encabezado -->
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Registro de Asistencia</h1>

        <!-- Formulario para seleccionar programa y semana -->
        <div class="bg-white p-6 mb-6">
            <form method="GET" action="{{ route('asistencia.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6 gap-y-6">
                    <div>
                        <label for="programa_id" class="block text-sm font-medium text-gray-700">Programa <span class="text-red-500">*</span></label>
                        <select name="programa_id" id="programa_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" onchange="this.form.submit()">
                            <option value="">Seleccione un programa...</option>
                            @foreach ($programas as $programa)
                                <option value="{{ $programa->Programa_ID }}" {{ $programa_id == $programa->Programa_ID ? 'selected' : '' }}>{{ $programa->NombrePrograma }}</option>
                            @endforeach
                        </select>
                        @if ($programa_id)
                            <div class="mt-2 text-sm text-gray-900">
                                <span class="font-medium">Lugar de Encuentro:</span>
                                {{ $programas->firstWhere('Programa_ID', $programa_id)->LugarEncuentro ?? 'No especificado' }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Semana (Lunes) <span class="text-red-500">*</span></label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ $fecha_inicio }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" onchange="this.form.submit()">
                    </div>
                </div>
            </form>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Tabla de asistencia -->
        @if ($programa_id && $participantes->isNotEmpty())
            <div class="bg-white p-6">
                <form method="POST" action="{{ route('asistencia.store') }}">
                    @csrf
                    <input type="hidden" name="programa_id" value="{{ $programa_id }}">
                    <input type="hidden" name="fecha_inicio" value="{{ $fecha_inicio }}">

                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 uppercase text-xs font-medium">
                                    <th class="px-4 py-2 text-left">Nombres y Apellidos</th>
                                    <th class="px-4 py-2 text-left">Género</th>
                                    <th class="px-4 py-2 text-left">Grado</th>
                                    <th class="px-4 py-2 text-left">Comunidad</th>
                                    <th class="px-4 py-2 text-left">Programa</th>
                                    @foreach ($diasSemana as $dia => $fecha)
                                        <th class="w-20 text-center text-xs font-medium text-gray-600 uppercase">
                                            {{ $dia }}<br>
                                            <span class="text-xs">{{ $fecha }}</span>
                                        </th>
                                    @endforeach
                                    <th class="w-20 text-center text-xs font-medium text-gray-600 uppercase">Total Asistido</th>
                                    <th class="w-16 text-center text-xs font-medium text-gray-600 uppercase">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($participantes as $participante)
                                    <tr class="border-b border-gray-200">
                                        <td class="px-4 py-2 text-sm text-gray-900">
                                            {{ $participante->PrimerNombre }} {{ $participante->SegundoNombre }} {{ $participante->PrimerApellido }} {{ $participante->SegundoApellido }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-900">{{ $participante->Genero }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-900">{{ $participante->GradoActual ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-900">{{ $participante->comunidad->NombreComunidad ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-900">{{ $participante->inscripcion->programa->NombrePrograma ?? 'N/A' }}</td>
                                        @foreach ($diasSemana as $dia => $fecha)
                                            <td class="w-20 text-center">
                                                <select name="asistencias[{{ $participante->Participante_ID }}][{{ $dia }}]" class="w-12 p-1 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                    <option value="Presente" {{ $asistencias[$participante->Participante_ID][$dia] == 'Presente' ? 'selected' : '' }}>P</option>
                                                    <option value="Ausente" {{ $asistencias[$participante->Participante_ID][$dia] == 'Ausente' ? 'selected' : '' }}>A</option>
                                                    <option value="Justificado" {{ $asistencias[$participante->Participante_ID][$dia] == 'Justificado' ? 'selected' : '' }}>J</option>
                                                </select>
                                            </td>
                                        @endforeach
                                        <td class="w-20 text-center text-sm text-gray-900">{{ $participante->totalAsistido }}</td>
                                        <td class="w-16 text-center text-sm text-gray-900">{{ $participante->porcentajeAsistencia }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        <x-boton-guardar>Guardar</x-boton-guardar>
                    </div>
                </form>
            </div>
        @elseif ($programa_id)
            <div class="bg-white p-6">
                <p class="text-sm text-gray-500">No hay participantes inscritos en este programa para registrar asistencia.</p>
            </div>
        @endif
    </div>
</x-app-layout>