<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Pagos
        </h2>
        <a href="{{ route('pagos.create') }}" class="btn btn-default">
            + Nuevo Pago
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="table-auto w-full text-left">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Código de Pago</th>
                            <th class="px-4 py-2">Empleado</th>
                            <th class="px-4 py-2">Monto</th>
                            <th class="px-4 py-2">Fecha de Pago</th>
                            <th class="px-4 py-2">Tipo de Pago</th>
                            <th class="px-4 py-2">Descripción</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagos as $pago)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $pago->codigo_pago }}</td>
                                <td class="px-4 py-2">{{ $pago->empleado?->nombre ?? 'Sin asignar' }}</td></td>  <!-- Asumiendo que tienes la relación con Empleado -->
                                <td class="px-4 py-2">{{ $pago->monto }}</td>
                                <td class="px-4 py-2">{{ $pago->fechaPago }}</td>
                                <td class="px-4 py-2">{{ $pago->tipoPago }}</td>
                                <td class="px-4 py-2">{{ $pago->descripcion ?? 'N/A' }}</td>
                                <td class="px-4 py-2">
                                <a href="{{ route('pagos.edit', $pago->id ?? 0) }}" class="text-blue-600 hover:underline">Editar</a>                                   
                                <form action="{{ route('pagos.destroy', $pago->id ?? 0) }}" method="POST" class="inline-block">
                                @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Eliminar este pago?')" class="text-red-600 hover:underline">
                                        Eliminar
                                    </button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                        @if ($pagos->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">No hay pagos registrados.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>