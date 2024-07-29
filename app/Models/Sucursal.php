<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursal';
    protected $primaryKey = 'idSucursal';
    public $timestamps = false;
    protected $fillable = [
        'nomSucursal',
        'lugar',
        'direccion',
        'email',
        'encargado',
        'telefono',
        'whatsApp',
        'horaApertura',
        'horaCierre'

    ];

    public function especialidades()
    {
        return $this->belongsToMany(Especialidad::class, 'especialidadessucursal');
    }

    public function medicos()
    {
        return $this->belongsToMany(Medico::class, 'sucursalesmedicos');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
