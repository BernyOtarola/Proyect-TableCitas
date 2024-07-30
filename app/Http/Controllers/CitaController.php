<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Sucursal;
use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\HorarioMedico;
use Carbon\Carbon;

class CitaController extends Controller
{
    private $provincias = [
        'San José', 'Alajuela', 'Cartago', 'Heredia', 'Guanacaste', 'Puntarenas', 'Limón'
    ];

    private $cantones = [
        'San José' => ['San José', 'Escazú', 'Desamparados', 'Puriscal', 'Tarrazú', 'Aserrí', 'Mora', 'Goicoechea', 'Santa Ana', 'Alajuelita', 'Vázquez de Coronado', 'Acosta', 'Tibás', 'Moravia', 'Montes de Oca', 'Turrubares', 'Dota', 'Curridabat', 'Pérez Zeledón', 'León Cortés'],
        'Alajuela' => ['Alajuela', 'San Ramón', 'Grecia', 'San Mateo', 'Atenas', 'Naranjo', 'Palmares', 'Poás', 'Orotina', 'San Carlos', 'Zarcero', 'Valverde Vega', 'Upala', 'Los Chiles', 'Guatuso'],
        'Cartago' => ['Cartago', 'Paraíso', 'La Unión', 'Jiménez', 'Turrialba', 'Alvarado', 'Oreamuno', 'El Guarco'],
        'Heredia' => ['Heredia', 'Barva', 'Santo Domingo', 'Santa Bárbara', 'San Rafael', 'San Isidro', 'Belén', 'Flores', 'San Pablo', 'Sarapiquí'],
        'Guanacaste' => ['Liberia', 'Nicoya', 'Santa Cruz', 'Bagaces', 'Carrillo', 'Cañas', 'Abangares', 'Tilarán', 'Nandayure', 'La Cruz', 'Hojancha'],
        'Puntarenas' => ['Puntarenas', 'Esparza', 'Buenos Aires', 'Montes de Oro', 'Osa', 'Quepos', 'Golfito', 'Coto Brus', 'Parrita', 'Corredores', 'Garabito'],
        'Limón' => ['Limón', 'Pococí', 'Siquirres', 'Talamanca', 'Matina', 'Guácimo']
    ];

    // Mostrar todas las citas
    public function index()
    {
        $citas = Cita::all();
        return view('citas.index', compact('citas'));
    }

    // Mostrar formulario de login para agendar cita
    public function showLoginForm()
    {
        return view('citas.login');
    }

    // Verificar el login del paciente
    public function checkLogin(Request $request)
    {
        $request->validate([
            'tipoIdentificacion' => 'required|string',
            'cedula' => 'required|string',
            'fechaNac' => 'required|date',
        ]);

        $paciente = Paciente::where('cedula', $request->cedula)
            ->where('fechNac', $request->fechaNac)
            ->first();

        if ($paciente) {
            // Guardar el ID del paciente en la sesión para usarlo más adelante
            session(['paciente_id' => $paciente->cedula]);
            return redirect()->route('citas.create');
        } else {
            return redirect()->route('citas.showLoginForm')->with('error', 'No estás registrado. Por favor, <a href="' . route('citas.showRegistrationForm') . '">regístrate aquí</a>.');
        }
    }

    // Mostrar formulario para registrar un nuevo paciente
    public function showRegistrationForm()
    {
        $sucursales = Sucursal::all();
        $provincias = $this->provincias;
        return view('citas.register', compact('sucursales', 'provincias'));
    }

    // Registrar un nuevo paciente en la base de datos
    public function register(Request $request)
    {
        $request->validate([
            'cedula' => 'required|string|unique:paciente',
            'nombre' => 'required|string',
            'direccion' => 'required|string',
            'genero' => 'required|string',
            'fechNac' => 'required|date',
            'ocupacion' => 'required|string',
            'telefono1' => 'required|numeric', // Validar que sea numérico
            'telefono2' => 'nullable|numeric', // Validar que sea numérico si está presente
            'email' => 'required|email',
            'provincia' => 'required|string',
            'canton' => 'required|string',
            'sucursal' => 'required|integer',
        ]);

        $data = $request->all();
        $data['fechaIngreso'] = date('Y-m-d'); // Agregar la fecha actual como fecha de ingreso

        $paciente = new Paciente($data);
        $paciente->save();

        // Guardar el ID del paciente en la sesión para usarlo más adelante
        session(['paciente_id' => $paciente->cedula]);

        return redirect()->route('citas.create')->with('success', 'Paciente registrado exitosamente. Ahora puede agendar su cita.');
    }

    // Obtener especialidades por sucursal
    public function getEspecialidadesBySucursal($sucursalId)
    {
        $especialidades = Especialidad::whereHas('sucursales', function ($query) use ($sucursalId) {
            $query->where('sucursales.idSucursal', $sucursalId);
        })->get();

        return response()->json($especialidades);
    }

    // Obtener médicos por especialidad
    public function getMedicosByEspecialidad($especialidadId)
    {
        $medicos = Medico::whereHas('especialidades', function ($query) use ($especialidadId) {
            $query->where('especialidades.idEspecialidad', $especialidadId);
        })->get();

        return response()->json($medicos);
    }

    // Obtener fechas disponibles por médico
    public function getFechasByMedico($medicoId)
    {
        $fechas = HorarioMedico::where('idSucursalMedico', $medicoId)
            ->groupBy('dia')
            ->pluck('dia');

        return response()->json($fechas);
    }

    // Obtener horas disponibles por médico y fecha
    public function getHorasByMedicoFecha($medicoId, $fecha)
    {
        $horas = HorarioMedico::where('idSucursalMedico', $medicoId)
            ->where('dia', $fecha)
            ->pluck('horaInicio', 'horaFin');

        return response()->json($horas);
    }

    // Mostrar formulario para crear una nueva cita
    public function create()
    {
        $paciente_id = session('paciente_id');
        if (!$paciente_id) {
            return redirect()->route('citas.showLoginForm');
        }

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
