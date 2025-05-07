<!-- filepath: c:\laragon\www\isproyempleados\resources\views\empleado\ficha.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ficha del Empleado: {{ $empleado->nombres }} {{ $empleado->apePaterno }} {{ $empleado->apeMaterno }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Información General</h3>
                <p><strong>DNI:</strong> {{ $empleado->dni }}</p>
                <p><strong>Estado Civil:</strong> {{ $empleado->estado_civil->nombreEstado ?? 'Sin estado civil' }}</p>
                <p><strong>Correo:</strong> {{ $empleado->correo }}</p>
                <p><strong>Antigüedad:</strong> {{ $antiguedad }}</p>

                <h3 class="text-lg font-semibold mt-6 mb-4">Beneficios Laborales</h3>
                <table class="table-auto w-full text-left">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2">Beneficio</th>
                            <th class="px-4 py-2">Aplica</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($beneficios as $beneficio => $aplica)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $beneficio }}</td>
                                <td class="px-4 py-2">{{ $aplica }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6">
                    <a href="{{ route('empleados.index') }}" class="btn btn-default">Volver a la lista de empleados</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>