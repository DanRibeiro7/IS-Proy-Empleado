@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($empleado) ? 'Editar Empleado' : 'Crear Empleado' }}</h2>

    <form action="{{ isset($empleado) ? route('empleados.update', $empleado->idEmpleado) : route('empleados.store') }}" method="POST">
        @csrf
        @if(isset($empleado))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="codEmpleado" class="form-label">Código</label>
            <input type="text" name="codEmpleado" class="form-control" value="{{ old('codEmpleado', $empleado->codEmpleado ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" name="dni" class="form-control" value="{{ old('dni', $empleado->dni ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" name="nombres" class="form-control" value="{{ old('nombres', $empleado->nombres ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="apePaterno" class="form-label">Apellido Paterno</label>
            <input type="text" name="apePaterno" class="form-control" value="{{ old('apePaterno', $empleado->apePaterno ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="apeMaterno" class="form-label">Apellido Materno</label>
            <input type="text" name="apeMaterno" class="form-control" value="{{ old('apeMaterno', $empleado->apeMaterno ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" name="fechaNacimiento" class="form-control" value="{{ old('fechaNacimiento', $empleado->fechaNacimiento ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <select name="genero" class="form-control">
                <option value="M" {{ (old('genero', $empleado->genero ?? '') == 'M') ? 'selected' : '' }}>Masculino</option>
                <option value="F" {{ (old('genero', $empleado->genero ?? '') == 'F') ? 'selected' : '' }}>Femenino</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="idEstCivil" class="form-label">Estado Civil</label>
            <input type="number" name="idEstCivil" class="form-control" value="{{ old('idEstCivil', $empleado->idEstCivil ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $empleado->direccion ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="numCelular" class="form-label">Celular</label>
            <input type="text" name="numCelular" class="form-control" value="{{ old('numCelular', $empleado->numCelular ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" name="correo" class="form-control" value="{{ old('correo', $empleado->correo ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="photoUrl" class="form-label">URL de Foto</label>
            <input type="text" name="photoUrl" class="form-control" value="{{ old('photoUrl', $empleado->photoUrl ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="fechacreacion" class="form-label">Fecha de Creación</label>
            <input type="date" name="fechacreacion" class="form-control" value="{{ old('fechacreacion', $empleado->fechacreacion ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="idEstado" class="form-label">Estado</label>
            <input type="number" name="idEstado" class="form-control" value="{{ old('idEstado', $empleado->idEstado ?? '') }}">
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($empleado) ? 'Actualizar' : 'Guardar' }}
        </button>
    </form>
</div>
@endsection