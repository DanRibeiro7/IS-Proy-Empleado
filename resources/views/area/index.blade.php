<!-- resources/views/areas/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Áreas
        </h2>
        <a href="{{ route('areas.create') }}" class="btn btn-default">
            + Nueva Área
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="table-auto w-full text-left">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Nombre del Área</th>
                            <th class="px-4 py-2">Salario</th>
                           
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($areas as $area)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $area->idArea }}</td>
                                <td class="px-4 py-2">{{ $area->nomArea }}</td>
                                <td class="px-4 py-2">S/ {{ number_format($area->salario, 2) }}</td>
                                
                                <td class="px-4 py-2">
                                    <a href="{{ route('areas.show', $area->idArea) }}" class="text-blue-600 hover:underline">Ver</a> |
                                    <a href="{{ route('areas.edit', $area->idArea) }}" class="text-blue-600 hover:underline">Editar</a> |
                                    <form action="{{ route('areas.destroy', $area->idArea) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('¿Eliminar esta área?')" class="text-red-600 hover:underline">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if ($areas->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">No hay áreas registradas.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
