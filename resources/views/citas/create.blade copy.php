@extends('layouts.app')

@section('content')
<h1>Crear Cita</h1>
<form action="/citas" method="POST">
    @csrf
    <div class="form-group">
        <label for="paciente">Paciente</label>
        <select name="paciente" class="form-control">
            @foreach($pacientes as $paciente)
            <option value="{{ $paciente->cedula }}">{{ $paciente->nombre }} {{ $paciente->apellido }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="fechaCita">Fecha de la Cita</label>
        <input type="date" name="fechaCita" class="form-control">
    </div>
    <div class="form-group">
        <label for="horaCita">Hora de la Cita</label>
        <input type="time" name="horaCita" class="form-control">
    </div>
    <div class="form-group">
        <label for="sucursal">Sucursal</label>
        <select name="sucursal" class="form-control">
            @foreach($sucursales as $sucursal)
            <option value="{{ $sucursal->idSucursal }}">{{ $sucursal->nombre }}</option>
            @endforeach
        </select>
    </div>
    <h1> test:
        {{ $sucursales->first()->nombre }}
    </h1>

    <div class="form-group">
        <label for="especialidad">Especialidad</label>
        <select name="especialidad" class="form-control">
            @foreach($especialidades as $especialidad)
            <option value="{{ $especialidad->idEspecialidad }}">{{ $especialidad->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="medico">Médico</label>
        <select name="medico" class="form-control">
            @foreach($medicos as $medico)
            <option value="{{ $medico->idMedicos }}">{{ $medico->nombre }} {{ $medico->apellido }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="motivo">Motivo</label>
        <input type="text" name="motivo" class="form-control">
    </div>
    <div class="form-group">
        <label for="estado">Estado</label>
        <input type="text" name="estado" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
@endsection
