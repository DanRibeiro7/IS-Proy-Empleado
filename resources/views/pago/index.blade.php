<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Selecciona un Contrato
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Código</th>
                        <th class="px-4 py-2">Empleado</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contratos as $contrato)
                        <tr>
                            <td class="px-4 py-2">{{ $contrato->idContrato }}</td>
                            <td class="px-4 py-2">
                                {{ $contrato->empleado->dni ?? '' }} - {{ $contrato->empleado->apePaterno ?? '' }} {{ $contrato->empleado->nombres ?? '' }}
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('pagos.porContrato', $contrato->idContrato) }}" class="text-blue-600 hover:underline">
                                    Ver Pagos
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @if ($contratos->isEmpty())
                        <tr><td colspan="3" class="text-center py-4">No hay contratos.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

