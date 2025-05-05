<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'idUsuario';
    protected $fillable = [
        'nomUsuario',
        'nombres',
        'apePaterno',
        'apeMaterno',
        'password',
        'type',
    ];
    public $timestamps = false;
}
