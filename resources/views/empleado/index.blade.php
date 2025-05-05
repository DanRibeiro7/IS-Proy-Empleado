@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Empleados</h2>

    <a href="{{ route('empleados.create') }}" class="btn btn-success mb-3">Nuevo Empleado</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>DNI</th>
                <th>Nombre Completo</th>
                <th>Género</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($empleados as $empleado)
            <tr>
                <td>{{ $empleado->idEmpleado }}</td>
                <td>{{ $empleado->dni }}</td>
                <td>{{ $empleado->nombres }} {{ $empleado->apePaterno }} {{ $empleado->apeMaterno }}</td>
                <td>{{ $empleado->genero }}</td>
                <td>{{ $empleado->numCelular }}</td>
                <td>{{ $empleado->correo }}</td>
                <td>{{ $empleado->idEstado }}</td>
                <td>
                    <a href="{{ route('empleados.edit', $empleado->idEmpleado) }}" class="btn btn-sm btn-warning">Editar</a>

                    <form action="{{ route('empleados.destroy', $empleado->idEmpleado) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Deseas eliminar este empleado?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">No hay empleados registrados.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection