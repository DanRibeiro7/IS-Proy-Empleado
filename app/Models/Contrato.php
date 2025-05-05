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
}
