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
        return $this->belongsToMany(Especialidad::class, 'especidadesmedico');
    }

    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class, 'sucursalesmedicos');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

}
