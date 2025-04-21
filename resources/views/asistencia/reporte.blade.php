<x-app-layout>
    <div class="container mx-auto p-6">
        <!-- Encabezado -->
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Reporte de Asistencia</h1>

        <!-- Formulario para seleccionar programa y fechas -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-6">
            <form method="GET" action="{{ route('asistencia.reporte') }}">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6 gap-y-6">
                    <div>
                        <label for="programa_id" class="block text-sm font-medium text-gray-700">Programa <span class="text-red-500">*</span></label>
                        <select name="programa_id" id="programa_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" onchange="this.form.submit()">
                            <option value="">Seleccione un programa...</option>
                            @foreach ($programas as $programa)
                                <option value="{{ $programa->Programa_ID }}" {{ $programa_id == $programa->Programa_ID ? 'selected' : '' }}>{{ $programa->NombrePrograma }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha Inicio <span class="text-red-500">*</span></label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ $fecha_inicio }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha Fin <span class="text-red-500">*</span></label>
                        <input type="date" name="fecha_fin" id="fecha_fin" value="{{ $fecha_fin }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Generar Reporte
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabla de reporte -->
        @if (!empty($reporte))
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-4">Resultados del Reporte</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombres y Apellidos</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Género</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comunidad</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Programa</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total Asistido</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total Días</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">%</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($reporte as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item['participante']->PrimerNombre }} {{ $item['participante']->SegundoNombre }} {{ $item['participante']->PrimerApellido }} {{ $item['participante']->SegundoApellido }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item['participante']->Genero }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item['participante']->GradoActual ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item['participante']->comunidad->NombreComunidad ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item['participante']->inscripcion->programa->NombrePrograma ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $item['totalAsistido'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $item['totalDias'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">{{ $item['porcentaje'] }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif ($programa_id)
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <p class="text-sm text-gray-500">No hay datos de asistencia para el rango seleccionado.</p>
            </div>
        @endif
    </div>
</x-app-layout>