<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'paciente';
    protected $primaryKey = 'cedula';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'direccion',
        'genero',
        'fechNac',
        'ocupacion',
        'telefono1',
        'telefono2',
        'email',
        'provincia',
        'canton',
        'fechaIngreso',
        'sucursal'
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
