@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Contratos</h2>

    <a href="{{ route('contratos.create') }}" class="btn btn-success mb-3">Nuevo Contrato</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Empleado (ID)</th>
                <th>Área</th>
                <th>Modalidad</th>
                <th>Jornada</th>
                <th>Código</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Horas</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($contratos as $contrato)
            <tr>
                <td>{{ $contrato->idContrato }}</td>
                <td>{{ $contrato->idEmpleado }}</td>
                <td>{{ $contrato->idArea }}</td>
                <td>{{ $contrato->idModalidad }}</td>
                <td>{{ $contrato->idJornada }}</td>
                <td>{{ $contrato->codContrato }}</td>
                <td>{{ $contrato->fechaInicio }}</td>
                <td>{{ $contrato->fechaFin }}</td>
                <td>{{ $contrato->horasLaboral }}</td>
                <td>{{ $contrato->idEstado }}</td>
                <td>
                    <a href="{{ route('contratos.edit', $contrato->idContrato) }}" class="btn btn-sm btn-warning">Editar</a>

                    <form action="{{ route('contratos.destroy', $contrato->idContrato) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Deseas eliminar este contrato?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="11">No hay contratos registrados.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection