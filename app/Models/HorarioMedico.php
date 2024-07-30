<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioMedico extends Model
{
    use HasFactory;

    protected $table = 'horariosmedicos';
    protected $primaryKey = 'idHorariosMedicos';
    public $timestamps = false;

    protected $fillable = [
        'idSucursalMedico',
        'dia',
        'horaInicio',
        'horaFin',
    ];

    // Define la relación con el modelo Medico
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'idSucursalMedico', 'idMedicos');
    }

    // Define la relación con el modelo Sucursal
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'idSucursalMedico', 'idSucursal');
    }
}
