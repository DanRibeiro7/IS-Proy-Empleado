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
            {{ isset($empleado) ? 'Editar Empleado' : 'Crear Empleado' }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form action="{{ isset($empleado) ? route('empleados.update', $empleado->idEmpleado) : route('empleados.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @if(isset($empleado))
                        @method('PUT')
                    @endif

                    <!-- Grid para organizar los campos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Código del Empleado -->
                        <div class="mb-6">
                            <label for="codEmpleado" class="block text-sm font-semibold text-gray-700">Código</label>
                            <input type="text" name="codEmpleado" class="form-input w-full"  maxlength="8" value="{{ old('codEmpleado', $empleado->codEmpleado ?? '') }}" disabled readonly>
                            @error('codEmpleado')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                 <!-- DNI -->
<div class="mb-6">
    <label for="dni" class="block text-sm font-semibold text-gray-700">DNI</label>
    <input
        type="text"
        name="dni"
        class="form-input w-full"
        maxlength="8"
        minlength="8"
        pattern="\d{8}"
        inputmode="numeric"
        oninput="this.value=this.value.replace(/\D/g,'')"
        value="{{ old('dni', $empleado->dni ?? '') }}"
        required
    >
    @error('dni')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

                        <!-- Nombres -->
                        <div class="mb-6">
                            <label for="nombres" class="block text-sm font-semibold text-gray-700">Nombres</label>
                            <input type="text" name="nombres" class="form-input w-full" maxlength="25" value="{{ old('nombres', $empleado->nombres ?? '') }}">
                            @error('nombres')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Apellido Paterno -->
                        <div class="mb-6">
                            <label for="apePaterno" class="block text-sm font-semibold text-gray-700">Apellido Paterno</label>
                            <input type="text" name="apePaterno" class="form-input w-full" maxlength="25" value="{{ old('apePaterno', $empleado->apePaterno ?? '') }}">
                            @error('apePaterno')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Apellido Materno -->
                        <div class="mb-6">
                            <label for="apeMaterno" class="block text-sm font-semibold text-gray-700">Apellido Materno</label>
                            <input type="text" name="apeMaterno" class="form-input w-full" maxlength="25"value="{{ old('apeMaterno', $empleado->apeMaterno ?? '') }}">
                            @error('apeMaterno')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fecha de Nacimiento -->
                        <div class="mb-6">
                            <label for="fechaNacimiento" class="block text-sm font-semibold text-gray-700">Fecha de Nacimiento</label>
                            <input type="date" name="fechaNacimiento" class="form-input w-full" value="{{ old('fechaNacimiento', $empleado->fechaNacimiento ?? '') }}">
                            @error('fechaNacimiento')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Género -->
                        <div class="mb-6">
                            <label for="genero" class="block text-sm font-semibold text-gray-700">Género</label>
                            <select name="genero" class="form-input w-full">
                                <option value="M" {{ old('genero', $empleado->genero ?? '') == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('genero', $empleado->genero ?? '') == 'F' ? 'selected' : '' }}>Femenino</option>
                            </select>
                        </div>

                        <!-- Estado Civil -->
                        <div class="mb-6">
                            <label for="idEstCivil" class="block text-sm font-semibold text-gray-700">Estado Civil</label>
                            <select name="idEstCivil" class="form-input w-full">
                                @foreach($estados_civiles as $obj)
                                    <option value="{{ $obj->idEstCivil }}" {{ old('idEstCivil', $empleado->idEstCivil ?? '') == $obj->idEstCivil ? 'selected' : '' }}>
                                        {{ $obj->nombreEstado }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dirección -->
                        <div class="mb-6">
                            <label for="direccion" class="block text-sm font-semibold text-gray-700">Dirección</label>
                            <input type="text" name="direccion" class="form-input w-full" maxlength="50" value="{{ old('direccion', $empleado->direccion ?? '') }}">
                            @error('direccion')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Celular -->
                        <div class="mb-6">
                            <label for="numCelular" class="block text-sm font-semibold text-gray-700">Celular</label>
                            <input type="text" name="numCelular" class="form-input w-full" maxlength="9" value="{{ old('numCelular', $empleado->numCelular ?? '') }}">
                            @error('numCelular')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Correo -->
                        <div class="mb-6">
                            <label for="correo" class="block text-sm font-semibold text-gray-700">Correo</label>
                            <input type="email" name="correo" class="form-input w-full" maxlength="50" value="{{ old('correo', $empleado->correo ?? '') }}">
                            @error('correo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
           <!-- Foto -->
    <div class="mb-6">
        <label for="photo" class="block text-sm font-semibold text-gray-700">Foto</label>
        <input type="file" name="photo" class="form-input w-full">
        @error('photo')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror

        @if (isset($empleado) && $empleado->photoUrl)
        <img src="{{ asset('storage/' . $empleado->photoUrl) }}" alt="Foto del Empleado" class="mt-2 object-cover rounded" style="width: 50px; height: 50px;">


        @endif
    </div>

                   <!-- Estado -->
<div class="mb-6">
    <label for="idEstado" class="block text-sm font-semibold text-gray-700">Estado</label>
    <select name="idEstado" class="form-input w-full">
        @foreach($estados as $obj)
            @if($loop->iteration <= 2)
                <option value="{{ $obj->idEstado }}"
                    {{ old('idEstado', $empleado->idEstado ?? '') == $obj->idEstado ? 'selected' : '' }}>
                    {{ $obj->nomEstado }}
                </option>
            @endif
        @endforeach
    </select>
</div>

                    

                    <!-- Botón de Enviar -->
                    <div class="mt-6">
 <button type="submit" class="btn btn-default font-bold">
    {{ isset($empleado) ? 'Actualizar' : 'Guardar' }}
</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>