<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    protected $table = 'estado_civil';
    protected $primaryKey = 'idEstCivil';
    protected $fillable = [
        'nombreEstado',   
    ];
    public $timestamps = false;
}
