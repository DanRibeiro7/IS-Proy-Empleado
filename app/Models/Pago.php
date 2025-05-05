<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pago';
    protected $primaryKey = 'idPago';
    protected $fillable = [
        'idContrato',
        'idBanco',
        'numCuenta',
        'fechaHora',
        'estado',
        'monto',
        'esgratificacion',
        'fechacreacion',
    ];
    public $timestamps = false;
}
