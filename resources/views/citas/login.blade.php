@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-body">
                    <h1 class="mb-4 text-center">Solicitud de citas</h1>
                    <p class="text-center">Ingresa tu número de identificación y fecha de nacimiento. Si eres extranjero ingresa tu número de carné de residente y fecha de nacimiento.</p>
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {!! session('error') !!}
                        </div>
                    @endif
                    <form action="{{ route('citas.checkLogin') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tipoIdentificacion">Tipo de identificación: <span class="text-danger">*</span></label>
                            <select name="tipoIdentificacion" class="form-control" required>
                                <option value="">Seleccione una opción...</option>
                                <option value="nacional">Nacional</option>
                                <option value="extranjero">Extranjero</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cedula">Número de identificación: <span class="text-danger">*</span></label>
                            <input type="text" name="cedula" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fechaNac">Fecha de nacimiento: <span class="text-danger">*</span></label>
                            <input type="date" name="fechaNac" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                    </form>
                    <p class="mt-3 text-center">¿Eres un paciente nuevo? <a href="{{ route('citas.showRegistrationForm') }}">Regístrese aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
