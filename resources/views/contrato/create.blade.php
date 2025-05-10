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
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ isset($contrato) ? 'Editar Contrato' : 'Crear Contrato' }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ isset($contrato) ? route('contratos.update', $contrato->idContrato) : route('contratos.store') }}" method="POST">
                    @csrf
                    @if(isset($contrato))
                        @method('PUT')
                    @endif

                    <!-- Empleado -->
                    <div class="mb-6">
                        <label for="idEmpleado" class="block text-sm font-semibold text-gray-700">Empleado</label>
                        <select name="idEmpleado" id="idEmpleado" class="form-input w-full">
                            @foreach($empleados as $empleado)
                                <option value="{{ $empleado->idEmpleado }}"
                                    {{ old('idEmpleado', $contrato->idEmpleado ?? '') == $empleado->idEmpleado ? 'selected' : '' }}>
                                    {{ $empleado->dni }} - {{ $empleado->apePaterno }} {{ $empleado->apeMaterno }} {{ $empleado->nombres }}
                                </option>
                            @endforeach
                        </select>
                        @error('idEmpleado')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Área -->
                    <div class="mb-6">
                        <label for="idArea" class="block text-sm font-semibold text-gray-700">Área</label>
                        <select name="idArea" id="idArea" class="form-input w-full">
                            <option value="">Seleccione un área</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->idArea }}" data-salario="{{ $area->salario }}">
                                    {{ $area->nomArea }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Salario -->
                    <div class="mt-4">
                        <label for="salario" class="block text-sm font-semibold text-gray-700">Salario</label>
                        <input type="text" name="salario" id="salario" class="mt-2 p-2 border border-gray-300 rounded-lg w-full" readonly>
                    </div>

                    <script>
                        document.getElementById('idArea').addEventListener('change', function() {
                            var selectedOption = this.options[this.selectedIndex];
                            var salario = selectedOption.getAttribute('data-salario');
                            document.getElementById('salario').value = salario ? salario : '';
                        });
                    </script>

                    <!-- Modalidad -->
                    <div class="mb-6">
                        <label for="idModalidad" class="block text-sm font-semibold text-gray-700">Modalidad</label>
                        <select name="idModalidad" id="idModalidad" class="form-input w-full" required>
                            <option value="">Seleccione una modalidad</option>
                            @foreach($modalidades as $modalidad)
                                <option value="{{ $modalidad->idModalidad }}"
                                    {{ old('idModalidad', $contrato->idModalidad ?? '') == $modalidad->idModalidad ? 'selected' : '' }}>
                                    {{ $modalidad->nomModalidad }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                  

                  

                    <!-- Fecha de Inicio -->
                    <div class="mb-6">
                        <label for="fechaInicio" class="block text-sm font-semibold text-gray-700">Fecha de Inicio</label>
                        <input type="date" name="fechaInicio" id="fechaInicio" class="mt-2 p-2 border border-gray-300 rounded-lg w-full" value="{{ old('fechaInicio', $contrato->fechaInicio ?? '') }}" required>
                    </div>

                <!-- Fecha de Fin -->
                <div class="mb-6">
                        <label for="fechaFin" class="block text-sm font-semibold text-gray-700">Fecha de Fin</label>
                        <input type="date" name="fechaFin" id="fechaFin" class="mt-2 p-2 border border-gray-300 rounded-lg w-full"
                            value="{{ old('fechaFin', $contrato->fechaFin ?? '') }}" required>
                    </div>
                    
                      <!-- Jornada -->
                      <div class="mb-6">
                        <label for="idJornada" class="block text-sm font-semibold text-gray-700">Jornada</label>
                        <select name="idJornada" id="idJornada" class="form-input w-full" onchange="actualizarHorasLaborales()">
                            @foreach($jornadas as $jornada)
                                <option value="{{ $jornada->idJornada }}"
                                    {{ old('idJornada', $contrato->idJornada ?? '') == $jornada->idJornada ? 'selected' : '' }}>
                                    {{ $jornada->nomJornada }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Horas Laborales -->
                        <div class="mb-6">
                            <label for="horasLaboral" class="block text-sm font-semibold text-gray-700">Horas Laborales</label>
                            <input type="number" name="horasLaboral" id="horasLaboral" class="form-input w-full bg-gray-100 cursor-not-allowed" readonly>
                        </div>

                    <!-- Banco y Cuenta -->
                    <div class="mb-6">
                        <label for="idBanco" class="block text-sm font-semibold text-gray-700">Banco</label>
                        <select name="idBanco" id="idBanco" class="form-input w-full">
                            <option value="">Selecciona un Banco</option>
                            @foreach($bancos as $banco)
                                <option value="{{ $banco->idBanco }}"
                                    {{ old('idBanco', $contrato->idBanco ?? '') == $banco->idBanco ? 'selected' : '' }}>
                                    {{ $banco->nomBanco }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label for="numCuenta" class="block text-sm font-semibold text-gray-700">Número de Cuenta</label>
                        <input type="text" name="numCuenta" id="numCuenta" class="mt-2 p-2 border border-gray-300 rounded-lg w-full" value="{{ old('numCuenta', $contrato->numCuenta ?? '') }}" required>
                    </div>

                    <!-- Estado -->
                    <div class="mb-6">
                        <label for="idEstado" class="block text-sm font-semibold text-gray-700">Estado</label>
                        <select name="idEstado" class="form-input w-full">
                            @foreach($estados as $estado)
                                <option value="{{ $estado->idEstado }}"
                                    {{ old('idEstado', $contrato->idEstado ?? '') == $estado->idEstado ? 'selected' : '' }}>
                                    {{ $estado->nomEstado }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botón de Submit -->
                    <button type="submit" class="">
                        {{ isset($contrato) ? 'Actualizar' : 'Guardar' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modalidadSelect = document.getElementById('idModalidad');
            const fechaFinInput = document.getElementById('fechaFin');

            function toggleFechaFin() {
                // Verifica si la modalidad seleccionada es "Indeterminado" (ajusta el valor si es necesario)
                if (modalidadSelect.value == '2') {  // Aquí asumimos que "2" corresponde a la modalidad "Indeterminado"
                    fechaFinInput.disabled = true;  // Deshabilita el campo de fecha de fin
                    fechaFinInput.value = '';       // Borra el valor de fecha de fin si está deshabilitado
                } else {
                    fechaFinInput.disabled = false; // Habilita el campo de fecha de fin
                }
            }

            // Ejecuta la función cuando se cambie la modalidad o cuando se cargue la página
            modalidadSelect.addEventListener('change', toggleFechaFin);
            toggleFechaFin(); // Llamamos la función cuando se carga la página (en caso de que ya esté preseleccionada la modalidad)
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const jornadaSelect = document.querySelector('select[name="idJornada"]');
        const horasInput = document.getElementById('horasLaboral');

        function actualizarHoras() {
            const jornada = jornadaSelect.value;
            if (jornada === '1') {
                horasInput.value = 8;
            } else if (jornada === '2') {
                horasInput.value = 4;
            } else {
                horasInput.value = '';
            }
        }

        jornadaSelect.addEventListener('change', actualizarHoras);
        actualizarHoras(); // Ejecuta al cargar la página
    });
</script>
</x-app-layout>
