<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
     public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
    protected $table = 'pago';
    protected $primaryKey = 'idPago';
    protected $fillable = [
        'idContrato',
        'idBanco',
        'numCuenta',
        'fechaPago',
        'estado',
        'monto',
        'gratificacion',
        'fechacreacion',
    ];
    public $timestamps = false;

}
