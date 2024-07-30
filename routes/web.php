<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;

Route::get('/citas/login', [CitaController::class, 'showLoginForm'])->name('citas.showLoginForm');
Route::post('/citas/checkLogin', [CitaController::class, 'checkLogin'])->name('citas.checkLogin');
Route::get('/citas/register', [CitaController::class, 'showRegistrationForm'])->name('citas.showRegistrationForm');
Route::post('/citas/register', [CitaController::class, 'register'])->name('citas.register');
Route::get('/especialidades/{sucursalId}', [CitaController::class, 'getEspecialidadesBySucursal']);
Route::get('/medicos/{especialidadId}', [CitaController::class, 'getMedicosByEspecialidad']);
Route::get('/fechas/{medicoId}', [CitaController::class, 'getFechasByMedico']);
Route::get('/horas/{medicoId}/{fecha}', [CitaController::class, 'getHorasByMedicoFecha']);

Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
Route::get('/citas/create', [CitaController::class, 'create'])->name('citas.create');
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
Route::get('/citas/{id}/edit', [CitaController::class, 'edit'])->name('citas.edit');
Route::put('/citas/{id}', [CitaController::class, 'update'])->name('citas.update');
Route::delete('/citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');

// Redirigir la ruta raíz a la página principal de citas
Route::redirect('/', '/citas/login');
