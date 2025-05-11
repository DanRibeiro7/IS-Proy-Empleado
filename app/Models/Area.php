<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';
    protected $primaryKey = 'idArea';
    protected $fillable = [
        'nomArea',
        'salario',
        'cantEmpleados', 
    ];
    public $timestamps = false;
    public function contratos()
{
    return $this->hasMany(\App\Models\Contrato::class, 'idArea', 'idArea');
}

}

