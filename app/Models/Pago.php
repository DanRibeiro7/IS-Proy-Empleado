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
        'fechaPago',
        'estado',
        'monto',
        'gratificacion',
        'fechacreacion',
    ];
    public $timestamps = false;

    public function contrato()
{
    return $this->belongsTo(Contrato::class, 'idContrato');
}
public function banco()
{
    return $this->belongsTo(\App\Models\Banco::class, 'idBanco');
}
}
