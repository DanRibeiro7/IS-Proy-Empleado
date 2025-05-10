@if ($errors->any())
    <div class="text-red-600">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Pagos del Contrato #{{ $contrato->idContrato }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <div class="mb-4 text-gray-600">
                Empleado: DNI:{{ $contrato->empleado->dni }} - {{ $contrato->empleado->apePaterno }} {{ $contrato->empleado->apeMaterno }} {{ $contrato->empleado->nombres }}
            </div>

            {{-- Botón de Regresar --}}
            <div class="mb-4">
                <a href="{{ url()->previous() }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
                    ← Regresar
                </a>
            </div>

            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">ID Pago</th>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Banco</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pagos as $pago)
                        <tr>
                            <td class="px-4 py-2">{{ $pago->idPago }}</td>
                            <td class="px-4 py-2">{{ $pago->fechaPago }}</td>
                           <td class="px-4 py-2">{{ $pago->banco->nomBanco ?? 'Sin banco' }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('pagos.boleta', $pago->idPago) }}" class="text-indigo-600 hover:underline">Boleta PDF</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center py-4">No hay pagos.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
