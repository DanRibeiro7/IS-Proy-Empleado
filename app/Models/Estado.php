<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estado';
    protected $primaryKey = 'idEstado';
    protected $fillable = [
        'nomEstado',
    ];
    public $timestamps = false;
}
