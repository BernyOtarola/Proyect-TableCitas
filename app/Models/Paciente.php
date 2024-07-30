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
        'cedula',
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
        'sucursal',
        'fechaIngreso',
    ];

    // Define a default value for 'fechaIngreso'
    protected $attributes = [
        'fechaIngreso' => null,
    ];

    // Ensure 'fechaIngreso' is always set to the current date
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (is_null($model->fechaIngreso)) {
                $model->fechaIngreso = date('Y-m-d');
            }
        });
    }
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
