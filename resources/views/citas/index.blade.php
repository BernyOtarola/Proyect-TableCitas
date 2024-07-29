@extends('layouts.app')

@section('content')
<h1>Citas</h1>
<a href="{{ route('citas.create') }}" class="btn btn-primary">Crear Cita</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Paciente</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Sucursal</th>
            <th>Especialidad</th>
            <th>Médico</th>
            <th>Motivo</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($citas as $cita)
        <tr>
            <td>{{ $cita->idCitas }}</td>
            <td>{{ $cita->paciente }}</td>
            <td>{{ $cita->fechaCita }}</td>
            <td>{{ $cita->horaCita }}</td>
            <td>{{ $cita->sucursal }}</td>
            <td>{{ $cita->especialidad }}</td>
            <td>{{ $cita->medico }}</td>
            <td>{{ $cita->motivo }}</td>
            <td>{{ $cita->estado }}</td>
            <td>
                <a href="{{ route('citas.edit', $cita->idCitas) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('citas.destroy', $cita->idCitas) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
