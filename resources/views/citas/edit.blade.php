@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Cita</h1>
    <form action="{{ route('citas.update', $cita->idCitas) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="paciente">Paciente</label>
            <select name="paciente" class="form-control">
                @foreach($pacientes as $paciente)
                <option value="{{ $paciente->cedula }}" {{ $cita->paciente == $paciente->cedula ? 'selected' : '' }}>
                    {{ $paciente->nombre }} {{ $paciente->apellido1 }} {{ $paciente->apellido2 }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fechaCita">Fecha de la Cita</label>
            <input type="date" name="fechaCita" class="form-control" value="{{ $cita->fechaCita }}">
        </div>
        <div class="form-group">
            <label for="horaCita">Hora de la Cita</label>
            <input type="time" name="horaCita" class="form-control" value="{{ $cita->horaCita }}">
        </div>
        <div class="form-group">
            <label for="sucursal">Sucursal</label>
            <select name="sucursal" class="form-control">
                @foreach($sucursales as $sucursal)
                <option value="{{ $sucursal->idSucursal }}" {{ $cita->sucursal == $sucursal->idSucursal ? 'selected' : '' }}>
                    {{ $sucursal->nomSucursal }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="especialidad">Especialidad</label>
            <select name="especialidad" class="form-control">
                @foreach($especialidades as $especialidad)
                <option value="{{ $especialidad->idEspecialidad }}" {{ $cita->especialidad == $especialidad->idEspecialidad ? 'selected' : '' }}>
                    {{ $especialidad->nombre }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="medico">Médico</label>
            <select name="medico" class="form-control">
                @foreach($medicos as $medico)
                <option value="{{ $medico->idMedicos }}" {{ $cita->medico == $medico->idMedicos ? 'selected' : '' }}>
                    {{ $medico->nombre }} {{ $medico->apellido1 }} {{ $medico->apellido2 }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="motivo">Motivo</label>
            <input type="text" name="motivo" class="form-control" value="{{ $cita->motivo }}">
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <input type="text" name="estado" class="form-control" value="{{ $cita->estado }}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
