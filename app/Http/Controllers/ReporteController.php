<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Contrato;
use App\Models\Pago;
use App\Models\Area;

class ReporteController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('contrato.area')->get();

        $pagosPorEmpleado = Pago::with('contrato.empleado')
            ->selectRaw('idContrato, SUM(monto) as total_monto, SUM(gratificacion) as total_gratificacion, COUNT(*) as num_pagos')
            ->groupBy('idContrato')
            ->get();

        $salariosPorArea = Area::withCount('contratos')->get();

        return view('reportes.index', compact('empleados', 'pagosPorEmpleado', 'salariosPorArea'));
    }
}

