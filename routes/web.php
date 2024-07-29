<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;

// Rutas para las operaciones CRUD de las citas
Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
Route::get('/citas/create', [CitaController::class, 'create'])->name('citas.create');
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');
Route::get('/citas/{id}/edit', [CitaController::class, 'edit'])->name('citas.edit');
Route::put('/citas/{id}', [CitaController::class, 'update'])->name('citas.update');
Route::delete('/citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');

// Redirigir la ruta raíz a la página principal de citas
Route::redirect('/', '/citas');
