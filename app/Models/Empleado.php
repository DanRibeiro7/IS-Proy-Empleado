<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleado';
    protected $primaryKey = 'idEmpleado';
    protected $fillable = [
        'codEmpleado',
        'dni',
        'nombres',
        'apePaterno',
        'apeMaterno',
        'fechaNacimiento',
        'genero',
        'idEstCivil',
        'direccion',
        'numCelular',
        'correo',
        'photoUrl',
        'fechacreacion',
        'idEstado',
    ];
    public $timestamps = false;

    public function estado_civil(){
        
                return $this->belongsTo(EstadoCivil::class, 'idEstCivil');
        
        
        }
        public function contratos()
{
    return $this->hasMany(Contrato::class, 'idEmpleado');
}
}
