<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoria_empleado extends Model
{
    protected $table = 'auditoria_empleado';
    protected $primaryKey = 'idAudEmpleado';
    protected $fillable = [
        'columna',
        'fecha',
        'usuario',
        'valorAntes',
        'valorDespues',
    ];
    public $timestamps = false;
}
