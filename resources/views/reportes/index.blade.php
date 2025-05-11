<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            📄 Reporte General del Sistema
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">

            {{-- 1. Contratos Activos --}}
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">1. Contratos Activos por Empleado</h3>
                <table class="table-auto w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">Empleado</th>
                            <th class="px-4 py-2 border">DNI</th>
                            <th class="px-4 py-2 border">Área</th>
                            <th class="px-4 py-2 border">Fecha Inicio</th>
                            <th class="px-4 py-2 border">Fecha Fin</th>
                            <th class="px-4 py-2 border">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empleados as $empleado)
                            @if($empleado->contrato)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $empleado->nombres }} {{ $empleado->apePaterno }}</td>
                                    <td class="px-4 py-2 border">{{ $empleado->dni }}</td>
                                    <td class="px-4 py-2 border">{{ $empleado->contrato->area->nomArea ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 border">{{ $empleado->contrato->fechaInicio }}</td>
                                    <td class="px-4 py-2 border">{{ $empleado->contrato->fechaFin }}</td>
                                    <td class="px-4 py-2 border">{{ $empleado->contrato->estado->nomEstado ?? 'N/A' }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- 2. Pagos --}}
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">2. Pagos por Empleado</h3>
                <table class="table-auto w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">Empleado</th>
                            <th class="px-4 py-2 border">Monto Total</th>
                            <th class="px-4 py-2 border">Gratificación Total</th>
                            <th class="px-4 py-2 border">Número de Pagos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagosPorEmpleado as $pago)
                            <tr>
                                <td class="px-4 py-2 border">{{ $pago->contrato->empleado->nombres ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border">S/. {{ number_format($pago->total_monto, 2) }}</td>
                                <td class="px-4 py-2 border">S/. {{ number_format($pago->total_gratificacion, 2) }}</td>
                                <td class="px-4 py-2 border">{{ $pago->num_pagos }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- 3. Salarios por Área --}}
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">3. Salarios por Área</h3>
                <table class="table-auto w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">Área</th>
                            <th class="px-4 py-2 border">Salario Base</th>
                            <th class="px-4 py-2 border">Empleados Asignados</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salariosPorArea as $area)
                            <tr>
                                <td class="px-4 py-2 border">{{ $area->nomArea }}</td>
                                <td class="px-4 py-2 border">S/. {{ number_format($area->salario, 2) }}</td>
                                <td class="px-4 py-2 border">{{ $area->contratos_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
