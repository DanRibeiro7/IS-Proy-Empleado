<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Nueva Área
        </h2>
        <a href="{{ route('areas.index') }}" class="btn btn-default">← Volver a la lista</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <form action="{{ route('areas.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700">Nombre del Área</label>
                        <input type="text" name="nomArea" class="w-full border rounded p-2" value="{{ old('nomArea') }}" required>
                        @error('nomArea') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Salario</label>
                        <input type="number" step="0.01" name="salario" class="w-full border rounded p-2" value="{{ old('salario') }}" required>
                        @error('salario') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    

                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
