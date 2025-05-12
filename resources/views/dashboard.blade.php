<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <p class="text-xl font-semibold mb-2">
                    Bienvenido     {{ Auth::user()->name }}
                </p>
                <p class="text-gray-600 mb-4">
                    Rol: {{ Auth::user()->role }}
                </p>

                {{-- Menú para ADMIN --}}
                @if (Auth::user()->role === 'admin')
                    <div class="space-y-2">
                        <a href="{{ route('usuarios.index') }}" class="block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            👥 Gestión de Usuarios
                        </a>
                        <a href="{{ route('contratos.index') }}" class="block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            📄 Gestión de Contratos
                        </a>
                    </div>
                @endif

                {{-- Menú para EMPLEADO --}}
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('pagos.index') }}" class="block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mt-4">
                        💰 Ver Pagos
                    </a>
                @endif

                {{-- Menú para SUPERVISOR --}}
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('reportes.index') }}" class="block bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 mt-4">
                        📊 Ver Reportes
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("HAS INICIADO SESION") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
