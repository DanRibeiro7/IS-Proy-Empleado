<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    protected $table = 'modalidad';
    protected $primaryKey = 'idModalidad';
    protected $fillable = [
        'nomModalidad',  
    ];
    public $timestamps = false;
}
