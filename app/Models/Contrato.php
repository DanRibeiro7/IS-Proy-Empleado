<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'contrato';
    protected $primaryKey = 'idContrato';
    protected $fillable = [
        'idEmpleado',
        'idArea',
        'idModalidad',
        'idJornada',
        'codContrato',
        'fechaInicio',
        'fechaFin',
        'idEstado',
        'horasLaboral',
        'fechacreacion',
    ];
    public $timestamps = false;
    protected $casts = [
        'fechaInicio' => 'date',
        'fechaFin' => 'date'

    ];
    public function empleado()
{
    return $this->belongsTo(Empleado::class, 'idEmpleado');
}
public function area()
{
    return $this->belongsTo(Area::class, 'idArea');
}

public function modalidad()
{
    return $this->belongsTo(Modalidad::class, 'idModalidad');
}

public function jornada()
{
    return $this->belongsTo(Jornada::class, 'idJornada');
}

public function estado()
{
    return $this->belongsTo(Estado::class, 'idEstado');
}
}
