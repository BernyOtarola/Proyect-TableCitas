@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Agendar Cita</h1>
    <form action="{{ route('citas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cedula">Número de Identificación</label>
            <input type="text" name="cedula" id="cedula" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="sucursal">Sucursal</label>
            <select name="sucursal" id="sucursal" class="form-control" required>
                <option value="">Seleccione una sucursal...</option>
                @foreach($sucursales as $sucursal)
                <option value="{{ $sucursal->idSucursal }}">{{ $sucursal->nomSucursal }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="especialidad">Especialidad</label>
            <select name="especialidad" id="especialidad" class="form-control" required>
                <option value="">Seleccione una especialidad...</option>
            </select>
        </div>
        <div class="form-group">
            <label for="medico">Médico</label>
            <select name="medico" id="medico" class="form-control" required>
                <option value="">Seleccione un médico...</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <select name="fecha" id="fecha" class="form-control" required>
                <option value="">Seleccione una fecha...</option>
            </select>
        </div>
        <div class="form-group">
            <label for="hora">Hora</label>
            <select name="hora" id="hora" class="form-control" required>
                <option value="">Seleccione una hora...</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Agendar</button>
    </form>
</div>

<script>
    document.getElementById('sucursal').addEventListener('change', function() {
        var sucursalId = this.value;
        var especialidadSelect = document.getElementById('especialidad');
        especialidadSelect.innerHTML = '<option value="">Seleccione una especialidad...</option>';

        if (sucursalId) {
            fetch('/especialidades/' + sucursalId)
                .then(response => response.json())
                .then(data => {
                    data.forEach(especialidad => {
                        var option = document.createElement('option');
                        option.value = especialidad.idEspecialidad;
                        option.textContent = especialidad.nombre;
                        especialidadSelect.appendChild(option);
                    });
                });
        }
    });

    document.getElementById('especialidad').addEventListener('change', function() {
        var especialidadId = this.value;
        var medicoSelect = document.getElementById('medico');
        medicoSelect.innerHTML = '<option value="">Seleccione un médico...</option>';

        if (especialidadId) {
            fetch('/medicos/' + especialidadId)
                .then(response => response.json())
                .then(data => {
                    data.forEach(medico => {
                        var option = document.createElement('option');
                        option.value = medico.idMedicos;
                        option.textContent = medico.nombre + ' ' + medico.apellido1 + ' ' + medico.apellido2;
                        medicoSelect.appendChild(option);
                    });
                });
        }
    });

    document.getElementById('medico').addEventListener('change', function() {
        var medicoId = this.value;
        var fechaSelect = document.getElementById('fecha');
        fechaSelect.innerHTML = '<option value="">Seleccione una fecha...</option>';

        if (medicoId) {
            fetch('/fechas/' + medicoId)
                .then(response => response.json())
                .then(data => {
                    data.forEach(fecha => {
                        var option = document.createElement('option');
                        option.value = fecha;
                        option.textContent = fecha;
                        fechaSelect.appendChild(option);
                    });
                });
        }
    });

    document.getElementById('fecha').addEventListener('change', function() {
        var medicoId = document.getElementById('medico').value;
        var fecha = this.value;
        var horaSelect = document.getElementById('hora');
        horaSelect.innerHTML = '<option value="">Seleccione una hora...</option>';

        if (medicoId && fecha) {
            fetch('/horas/' + medicoId + '/' + fecha)
                .then(response => response.json())
                .then(data => {
                    data.forEach(hora => {
                        var option = document.createElement('option');
                        option.value = hora;
                        option.textContent = hora;
                        horaSelect.appendChild(option);
                    });
                });
        }
    });
</script>
@endsection
