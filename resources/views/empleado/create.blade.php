<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($empleado) ? 'Editar Empleado' : 'Crear Empleado' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow rounded-lg">
            <form
                action="{{ isset($empleado) ? route('empleados.update', $empleado->idEmpleado) : route('empleados.store') }}"
                method="POST">
                @csrf
                @if(isset($empleado))
                @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="codEmpleado" class="block font-medium text-sm text-gray-700">Código</label>
                        <input type="text" name="codEmpleado" class="form-input w-full"
                            value="{{ old('codEmpleado', $empleado->codEmpleado ?? '') }}">
                    </div>

                    <div>
                        <label for="dni" class="block font-medium text-sm text-gray-700">DNI</label>
                        <input type="text" name="dni" class="form-input w-full"
                            value="{{ old('dni', $empleado->dni ?? '') }}">
                    </div>

                    <div>
                        <label for="nombres" class="block font-medium text-sm text-gray-700">Nombres</label>
                        <input type="text" name="nombres" class="form-input w-full"
                            value="{{ old('nombres', $empleado->nombres ?? '') }}">
                    </div>

                    <div>
                        <label for="apePaterno" class="block font-medium text-sm text-gray-700">Apellido Paterno</label>
                        <input type="text" name="apePaterno" class="form-input w-full"
                            value="{{ old('apePaterno', $empleado->apePaterno ?? '') }}">
                    </div>

                    <div>
                        <label for="apeMaterno" class="block font-medium text-sm text-gray-700">Apellido Materno</label>
                        <input type="text" name="apeMaterno" class="form-input w-full"
                            value="{{ old('apeMaterno', $empleado->apeMaterno ?? '') }}">
                    </div>

                    <div>
                        <label for="fechaNacimiento" class="block font-medium text-sm text-gray-700">Fecha de
                            Nacimiento</label>
                        <input type="date" name="fechaNacimiento" class="form-input w-full"
                            value="{{ old('fechaNacimiento', $empleado->fechaNacimiento ?? '') }}">
                    </div>

                    <div>
                        <label for="genero" class="block font-medium text-sm text-gray-700">Género</label>
                        <select name="genero" class="form-input w-full">
                            <option value="M" {{ old('genero', $empleado->genero ?? '') == 'M' ? 'selected' : '' }}>
                                Masculino</option>
                            <option value="F" {{ old('genero', $empleado->genero ?? '') == 'F' ? 'selected' : '' }}>
                                Femenino</option>
                        </select>
                    </div>

                    <div>
                        <label for="idEstCivil" class="block font-medium text-sm text-gray-700">Estado Civil</label>
                        <select name="idEstCivil" class="form-input w-full">
                            @foreach($estados_civiles as $obj)
                            <option value="{{ $obj->idEstCivil }}"
                                {{ old('idEstCivil', $empleado->idEstCivil ?? '') == $obj->idEstCivil ? 'selected' : '' }}>
                                {{ $obj->nombreEstado }}
                            </option>
                            @endforeach
                        </select>
                    </div>


                    <div>
                        <label for="direccion" class="block font-medium text-sm text-gray-700">Dirección</label>
                        <input type="text" name="direccion" class="form-input w-full"
                            value="{{ old('direccion', $empleado->direccion ?? '') }}">
                    </div>

                    <div>
                        <label for="numCelular" class="block font-medium text-sm text-gray-700">Celular</label>
                        <input type="text" name="numCelular" class="form-input w-full"
                            value="{{ old('numCelular', $empleado->numCelular ?? '') }}">
                    </div>

                    <div>
                        <label for="correo" class="block font-medium text-sm text-gray-700">Correo</label>
                        <input type="email" name="correo" class="form-input w-full"
                            value="{{ old('correo', $empleado->correo ?? '') }}">
                    </div>

                    <div>
                        <label for="photoUrl" class="block font-medium text-sm text-gray-700">URL de Foto</label>
                        <input type="text" name="photoUrl" class="form-input w-full"
                            value="{{ old('photoUrl', $empleado->photoUrl ?? '') }}">
                    </div>



                  
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
                </div>


                <div class="mt-6">
                    <button type="submit" class="btn btn-default ">
                        {{ isset($empleado) ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>