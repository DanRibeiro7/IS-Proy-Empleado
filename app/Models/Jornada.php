<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    protected $table = 'jornada';
    protected $primaryKey = 'idJornada';
    protected $fillable = [
        'nomJornada',
    ];
    public $timestamps = false;
}
