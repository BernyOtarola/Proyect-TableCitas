<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'especialidades';
    protected $primaryKey = 'idEspecialidad';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'activo',
    ];

    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class, 'especialidadessucursal', 'especialidad', 'sucursal');
    }

    public function medicos()
    {
        return $this->belongsToMany(Medico::class, 'especialidadesmedico', 'especialidad', 'medico');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
