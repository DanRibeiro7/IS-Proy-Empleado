<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Nuevo Pago
        </h2>
        <a href="{{ route('pagos.index') }}" class="btn btn-default">
            ← Volver a la lista de pagos
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('pagos.store') }}" method="POST">
                    @csrf
<!-- Selección de Empleado -->
<div class="mb-6">
    <label for="idEmpleado" class="block text-sm font-semibold text-gray-700">Empleado</label>
    <select name="idEmpleado" id="idEmpleado" class="form-input w-full">
        <option value="" disabled selected>Selecciona un empleado</option>
        @foreach ($empleados as $empleado)
            <option value="{{ $empleado->idEmpleado }}">
                {{ $empleado->dni }} - {{ $empleado->apePaterno }}, {{ $empleado->apeMaterno }}, {{ $empleado->nombres }}
            </option>
        @endforeach
    </select>
    @error('idEmpleado')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

                  

                    <!-- Fecha de Pago -->
                    <div class="mb-6">
                        <label for="fechaPago" class="block text-sm font-semibold text-gray-700">Fecha de Pago</label>
                        <input type="date" name="fechaPago" id="fechaPago" class="mt-2 p-2 border border-gray-300 rounded-lg w-full" value="{{ old('fechaPago') }}" required>
                        @error('fechaPago')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tipo de Pago -->
                    <div class="mb-6">
                        <label for="tipoPago" class="block text-sm font-semibold text-gray-700">Tipo de Pago</label>
                        <select name="tipoPago" id="tipoPago" class="form-input w-full">
                            <option value="Efectivo" {{ old('tipoPago') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                            <option value="Transferencia" {{ old('tipoPago') == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                            <option value="Cheque" {{ old('tipoPago') == 'Cheque' ? 'selected' : '' }}>Cheque</option>
                        </select>
                        @error('tipoPago')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción (opcional) -->
                    <div class="mb-6">
                        <label for="descripcion" class="block text-sm font-semibold text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="mt-2 p-2 border border-gray-300 rounded-lg w-full" rows="4">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botón de Enviar -->
                    <button type="submit" class="w-full mt-4 bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300">
                        Guardar Pago
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>