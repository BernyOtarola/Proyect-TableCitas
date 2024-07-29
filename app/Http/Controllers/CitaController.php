<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Sucursal;
use App\Models\Especialidad;
use App\Models\Medico;

class CitaController extends Controller
{
    // Mostrar todas las citas
    public function index()
    {
        $citas = Cita::all();
        return view('citas.index', compact('citas'));
    }

    // Mostrar formulario para crear una nueva cita
    public function create()
    {
        $pacientes = Paciente::all();
        $sucursales = Sucursal::all();
        $especialidades = Especialidad::all();
        $medicos = Medico::all();
        return view('citas.create', compact('pacientes', 'sucursales', 'especialidades', 'medicos'));
    }

    // Almacenar una nueva cita en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'paciente' => 'required|integer',
            'fechaCita' => 'required|date',
            'horaCita' => 'required|date_format:H:i',
            'sucursal' => 'required|integer',
            'especialidad' => 'required|integer',
            'medico' => 'required|integer',
            'motivo' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:255'
        ]);

        $cita = new Cita();
        $cita->paciente = $request->paciente;
        $cita->fechaActual = date('Y-m-d'); 
        $cita->fechaCita = $request->fechaCita;
        $cita->horaCita = $request->horaCita;
        $cita->sucursal = $request->sucursal;
        $cita->especialidad = $request->especialidad;
        $cita->medico = $request->medico;
        $cita->motivo = $request->motivo;
        $cita->estado = $request->estado;
        $cita->save();

        return redirect('/citas')->with('success', 'Cita creada exitosamente');
    }

    // Mostrar formulario para editar una cita existente
    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        $pacientes = Paciente::all();
        $sucursales = Sucursal::all();
        $especialidades = Especialidad::all();
        $medicos = Medico::all();
        return view('citas.edit', compact('cita', 'pacientes', 'sucursales', 'especialidades', 'medicos'));
    }

    // Actualizar una cita existente en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'paciente' => 'required|integer',
            'fechaCita' => 'required|date',
            'horaCita' => 'required|date_format:H:i',
            'sucursal' => 'required|integer',
            'especialidad' => 'required|integer',
            'medico' => 'required|integer',
            'motivo' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:255'
        ]);

        $cita = Cita::findOrFail($id);
        $cita->paciente = $request->paciente;
        $cita->fechaCita = $request->fechaCita;
        $cita->horaCita = $request->horaCita;
        $cita->sucursal = $request->sucursal;
        $cita->especialidad = $request->especialidad;
        $cita->medico = $request->medico;
        $cita->motivo = $request->motivo;
        $cita->estado = $request->estado;
        $cita->save();

        return redirect('/citas')->with('success', 'Cita actualizada exitosamente');
    }

    // Eliminar una cita existente de la base de datos
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect('/citas')->with('success', 'Cita eliminada exitosamente');
    }
}
