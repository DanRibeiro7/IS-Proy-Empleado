<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle del Área
        </h2>
        <a href="{{ route('areas.index') }}" class="btn btn-default">← Volver a la lista</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <p><strong>ID:</strong> {{ $area->idArea }}</p>
                <p><strong>Nombre del Área:</strong> {{ $area->nomArea }}</p>
                <p><strong>Salario:</strong> S/ {{ number_format($area->salario, 2) }}</p>
                <p><strong>Cantidad de Empleados:</strong> {{ $area->cantEmpleados }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
