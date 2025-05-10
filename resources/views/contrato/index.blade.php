<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Contratos
        </h2>
        <a href="{{ route('contratos.create') }}" class="btn btn-default">
            + Nuevo Contrato
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="table-auto w-full text-left">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Código</th>
                            <th class="px-4 py-2">Empleado (ID)</th>
                            <th class="px-4 py-2">Área</th>
                            <th class="px-4 py-2">Modalidad</th>
                            
                            <th class="px-4 py-2">Fecha Inicio</th>
                            <th class="px-4 py-2">Fecha Fin</th>
                            <th class="px-4 py-2">Horas</th>
                            <th class="px-4 py-2">Estado</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contratos as $contrato)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $contrato->idContrato }}</td>
                                <td class="px-4 py-2"> {{ $contrato->empleado->dni ?? 'Sin DNI' }} | {{ $contrato->empleado->apePaterno ?? '' }} </td>
                               <td class="px-4 py-2">{{ $contrato->area->nomArea ?? 'Sin área' }}</td> 
                               <td class="px-4 py-2">{{ $contrato->modalidad->nomModalidad ?? 'Sin modalidad' }}</td>
                                
                             
                                <td class="px-4 py-2">{{ $contrato->fechaInicio }}</td>
                                <td class="px-4 py-2">{{ $contrato->fechaFin }}</td>
                                <td class="px-4 py-2">{{ $contrato->horasLaboral }}</td>
                                <td class="px-4 py-2">{{ $contrato->estado->nomEstado ?? 'Sin estado' }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('contratos.edit', $contrato->idContrato) }}" class="text-blue-600 hover:underline">Editar</a> |
                                    <form action="{{ route('contratos.destroy', $contrato->idContrato) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('¿Eliminar este contrato?')" class="text-red-600 hover:underline">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if ($contratos->isEmpty())
                            <tr>
                                <td colspan="10" class="text-center py-4 text-gray-500">No hay contratos registrados.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>