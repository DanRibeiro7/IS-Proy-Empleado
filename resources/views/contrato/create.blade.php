@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ isset($contrato) ? 'Editar Contrato' : 'Crear Contrato' }}</h2>

    <form action="{{ isset($contrato) ? route('contratos.update', $contrato->idContrato) : route('contratos.store') }}" method="POST">
        @csrf
        @if(isset($contrato))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="idEmpleado" class="form-label">Empleado (ID)</label>
            <input type="number" name="idEmpleado" class="form-control" value="{{ old('idEmpleado', $contrato->idEmpleado ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="idArea" class="form-label">Área (ID)</label>
            <input type="number" name="idArea" class="form-control" value="{{ old('idArea', $contrato->idArea ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="idModalidad" class="form-label">Modalidad (ID)</label>
            <input type="number" name="idModalidad" class="form-control" value="{{ old('idModalidad', $contrato->idModalidad ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="idJornada" class="form-label">Jornada (ID)</label>
            <input type="number" name="idJornada" class="form-control" value="{{ old('idJornada', $contrato->idJornada ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="codContrato" class="form-label">Código del Contrato</label>
            <input type="text" name="codContrato" class="form-control" value="{{ old('codContrato', $contrato->codContrato ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
            <input type="date" name="fechaInicio" class="form-control" value="{{ old('fechaInicio', $contrato->fechaInicio ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="fechaFin" class="form-label">Fecha de Fin</label>
            <input type="date" name="fechaFin" class="form-control" value="{{ old('fechaFin', $contrato->fechaFin ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="idEstado" class="form-label">Estado (ID)</label>
            <input type="number" name="idEstado" class="form-control" value="{{ old('idEstado', $contrato->idEstado ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="horasLaboral" class="form-label">Horas Laborales</label>
            <input type="number" name="horasLaboral" class="form-control" value="{{ old('horasLaboral', $contrato->horasLaboral ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="fechacreacion" class="form-label">Fecha de Creación</label>
            <input type="date" name="fechacreacion" class="form-control" value="{{ old('fechacreacion', $contrato->fechacreacion ?? '') }}">
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($contrato) ? 'Actualizar' : 'Guardar' }}
        </button>
    </form>
</div>
@endsection