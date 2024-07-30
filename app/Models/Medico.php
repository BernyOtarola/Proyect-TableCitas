<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medicos';
    protected $primaryKey = 'idMedicos';
    public $timestamps = false;

    protected $fillable = [
        'cedula',
        'nombre',
        'apellido1',
        'apellido2',
        'telefono',
        'direccion',
        'email',
        'fechaRegistro'
    ];

    public function especialidades()
    {
        return $this->belongsToMany(Especialidad::class, 'especialidadesmedico', 'medico', 'especialidad');
    }

    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class, 'sucursalesmedicos', 'medico', 'sucursal');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function horarios()
    {
        return $this->hasMany(HorarioMedico::class, 'idSucursalMedico', 'idMedicos');
    }
}
