@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Registro de Paciente</h1>
    <form action="{{ route('citas.register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cedula">Número de Identificación</label>
            <input type="text" name="cedula" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="genero">Género</label>
            <select name="genero" class="form-control" required>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fechNac">Fecha de Nacimiento</label>
            <input type="date" name="fechNac" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="ocupacion">Ocupación</label>
            <input type="text" name="ocupacion" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="telefono1">Teléfono 1</label>
            <input type="text" name="telefono1" class="form-control" required pattern="[0-9]*" inputmode="numeric">
        </div>
        <div class="form-group">
            <label for="telefono2">Teléfono 2</label>
            <input type="text" name="telefono2" class="form-control" pattern="[0-9]*" inputmode="numeric">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="provincia">Provincia</label>
            <select name="provincia" class="form-control" id="provincia" required>
                <option value="">Seleccione una provincia...</option>
                @foreach($provincias as $provincia)
                <option value="{{ $provincia }}">{{ $provincia }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="canton">Cantón</label>
            <select name="canton" class="form-control" id="canton" required>
                <option value="">Seleccione un cantón...</option>
            </select>
        </div>
        <div class="form-group">
            <label for="sucursal">Sucursal</label>
            <select name="sucursal" class="form-control" required>
                @foreach($sucursales as $sucursal)
                <option value="{{ $sucursal->idSucursal }}">{{ $sucursal->nomSucursal }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
    <p class="mt-3 text-center">¿Ya tienes una cuenta? <a href="{{ route('citas.showLoginForm') }}">Inicia sesión aquí</a></p>
</div>

<script>
    document.getElementById('provincia').addEventListener('change', function() {
        var provincia = this.value;
        var cantonSelect = document.getElementById('canton');
        cantonSelect.innerHTML = '<option value="">Seleccione un cantón...</option>'; // Limpiar los cantones

        if (provincia) {
            fetch('/citas/getCantones/' + encodeURIComponent(provincia))
                .then(response => response.json())
                .then(data => {
                    data.forEach(canton => {
                        var option = document.createElement('option');
                        option.value = canton;
                        option.textContent = canton;
                        cantonSelect.appendChild(option);
                    });
                });
        }
    });
</script>
@endsection
