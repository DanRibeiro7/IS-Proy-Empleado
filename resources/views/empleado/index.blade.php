<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Empleados
        </h2>
        <a href="{{ route('empleados.create') }}"
       class="btn btn-default">
        + Nuevo Empleado
    </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="table-auto w-full text-left">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Código</th>
                            <th class="px-4 py-2">DNI</th>
                            <th class="px-4 py-2">Nombres</th>
                            <th class="px-4 py-2">Apellidos</th>
                            <th class="px-4 py-2">Estado Civil</th>
                            <th class="px-4 py-2">Correo</th>
                            <th class="px-4 py-2">foto</th>
                            <th class="px-4 py-2">Antigüedad</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleados as $empleado)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $empleado->codEmpleado }}</td>
                                <td class="px-4 py-2">{{ $empleado->dni }}</td>
                                <td class="px-4 py-2">{{ $empleado->nombres }}</td>
                                <td class="px-4 py-2">{{ $empleado->apePaterno }} {{ $empleado->apeMaterno }}</td>
                                <td class="px-4 py-2">{{ $empleado->estado_civil->nombreEstado ?? 'Sin estado civil' }}</td>
                                <td class="px-4 py-2">{{ $empleado->correo }}</td>
                                <td class="px-4 py-2">
                                @if($empleado->photoUrl)
                                            <img width="100" height="100" src="{{ asset('storage/' . $empleado->photoUrl) }}" alt="Foto del Empleado" class="w-24 h-24 object-cover">
                                        @else
                                            <p>No hay foto</p>
                                        @endif
                                </td>
                                <td class="px-4 py-2">{{ $empleado->antiguedad }}</td> 
                                <td class="px-4 py-2">
                                    <a href="{{ route('empleados.ficha', $empleado->idEmpleado) }}" class="text-blue-600 hover:underline">Ver Ficha</a> |
                                    <a href="{{ route('empleados.edit', $empleado->idEmpleado) }}" class="text-blue-600 hover:underline">Editar</a> |
                                    <form action="{{ route('empleados.destroy', $empleado->idEmpleado) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('¿Eliminar este empleado?')" class="text-red-600 hover:underline">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if ($empleados->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">No hay empleados registrados.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
