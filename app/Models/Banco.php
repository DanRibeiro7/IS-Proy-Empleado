<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table = 'banco';
    protected $primaryKey = 'idBanco';
    protected $fillable = [
        'nomBanco',     
    ];
    public $timestamps = false;
}

