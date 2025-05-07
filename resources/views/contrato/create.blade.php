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

                    <!-- Área (ID) -->
                    <div>
    <label for="idArea" class="block font-semibold text-sm text-gray-700">Área</label>
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
    // Cuando se cambie la selección del área, actualizamos el salario
    document.getElementById('idArea').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var salario = selectedOption.getAttribute('data-salario');
        document.getElementById('salario').value = salario ? salario : ''; // Si hay salario, lo muestra, si no, lo deja vacío
    });
</script>

                 <!-- Modalidad -->
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
    @error('idModalidad')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

    <!-- Jornada -->
<div class="mb-6">
    <label for="idJornada" class="block text-sm font-semibold text-gray-700">Jornada</label>
    <select name="idJornada" id="idJornada" class="form-input w-full" onchange="actualizarHorasLaborales()">
        @foreach($jornadas as $jornada)
            <option value="{{ $jornada->idJornada }}" 
                {{ old('idJornada', $contrato->idJornada ?? '') == $jornada->idJornada ? 'selected' : '' }}>
                {{ $jornada->nomJornada }} <!-- Aquí se muestra el nombre de la jornada -->
            </option>
        @endforeach
    </select>
    @error('idJornada')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

                    <!-- Código del Contrato -->
                    <div class="mb-6">
                        <label for="codContrato" class="block text-sm font-semibold text-gray-700">Código del Contrato</label>
                        <input type="text" name="codContrato" id="codContrato" class="mt-2 p-2 border border-gray-300 rounded-lg w-full" value="{{ old('codContrato', $contrato->codContrato ?? '') }}" required>
                        @error('codContrato')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha de Inicio -->
                    <div class="mb-6">
                        <label for="fechaInicio" class="block text-sm font-semibold text-gray-700">Fecha de Inicio</label>
                        <input type="date" name="fechaInicio" id="fechaInicio" class="mt-2 p-2 border border-gray-300 rounded-lg w-full" value="{{ old('fechaInicio', $contrato->fechaInicio ?? '') }}" required>
                        @error('fechaInicio')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha de Fin -->
                    <div class="mb-6">
    <label for="fechaFin" class="block text-sm font-semibold text-gray-700">Fecha de Fin</label>
    <input type="date" name="fechaFin" id="fechaFin" class="mt-2 p-2 border border-gray-300 rounded-lg w-full"
           value="{{ old('fechaFin', $contrato->fechaFin ?? '') }}" required>
    @error('fechaFin')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

                    <!-- Estado (ID) -->
                    <div>
                    <label for="idEstado" class="block font-medium text-sm text-gray-700">Estado</label>
                        <select name="idEstado" class="form-input w-full">
                            @foreach($estados as $obj)
                            <option value="{{ $obj->idEstado }}"
                                {{ old('idEstado', $empleado->idEstado ?? '') == $obj->idEstado ? 'selected' : '' }}>
                                {{ $obj->nomEstado }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Horas Laborales -->
<div class="mb-6">
    <label for="horasLaboral" class="block text-sm font-semibold text-gray-700">Horas Laborales</label>
    <input type="number" name="horasLaboral" id="horasLaboral" class="mt-2 p-2 border border-gray-300 rounded-lg w-full" value="{{ old('horasLaboral', $contrato->horasLaboral ?? '') }}" readonly>
    @error('horasLaboral')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<script>
    // Función para actualizar las horas laborales basadas en la jornada seleccionada
    function actualizarHorasLaborales() {
        var jornada = document.getElementById('idJornada').value;
        var horasLaborales = document.getElementById('horasLaboral');
        
        // Verificamos la jornada seleccionada y asignamos las horas
        if (jornada == '1') {
            horasLaborales.value = 8;  // Si selecciona la jornada 1, 8 horas
        } else if (jornada == '2') {
            horasLaborales.value = 6;  // Si selecciona la jornada 2, 6 horas
        }
        
        // Deshabilitamos el campo para que no pueda ser modificado
        horasLaborales.disabled = true;
    }

    // Llamar la función cuando la página se cargue, para que tenga un valor predeterminado si ya está seleccionado
    document.addEventListener('DOMContentLoaded', function() {
        actualizarHorasLaborales();
    });
</script>
                  

                    <!-- Botón de Submit -->
                    <button type="submit" class="">
                        {{ isset($contrato) ? 'Actualizar' : 'Guardar' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalidadSelect = document.getElementById('idModalidad');
        const fechaFinInput = document.getElementById('fechaFin');

        function toggleFechaFin() {
            if (modalidadSelect.value === '2') { // ID de la segunda modalidad
                fechaFinInput.disabled = true;
                fechaFinInput.value = ''; // opcional: limpiar el valor
            } else {
                fechaFinInput.disabled = false;
            }
        }

        // Ejecutar al cargar y al cambiar la selección
        toggleFechaFin();
        modalidadSelect.addEventListener('change', toggleFechaFin);
    });
</script>