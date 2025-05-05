<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //// Crear un nuevo contrato usando los datos validados
Contrato::create([
    'idEmpleado'    => $request->idEmpleado,
    'idArea'        => $request->idArea,
    'idModalidad'   => $request->idModalidad,
    'idJornada'     => $request->idJornada,
    'codContrato'   => $request->codContrato,
    'fechaInicio'   => $request->fechaInicio,
    'fechaFin'      => $request->fechaFin,
    'idEstado'      => $request->idEstado,
    'horasLaboral'  => $request->horasLaboral,
    'fechacreacion' => $request->fechacreacion,
]);

// Redirigir a la lista de contratos con un mensaje de éxito
return redirect()->route('contratos.index')->with('success', 'Contrato creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contrato $contrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrato $contrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contrato $contrato)
    {
        $contrato->update([
            'idEmpleado'    => $request->idEmpleado,
            'idArea'        => $request->idArea,
            'idModalidad'   => $request->idModalidad,
            'idJornada'     => $request->idJornada,
            'codContrato'   => $request->codContrato,
            'fechaInicio'   => $request->fechaInicio,
            'fechaFin'      => $request->fechaFin,
            'idEstado'      => $request->idEstado,
            'horasLaboral'  => $request->horasLaboral,
            'fechacreacion' => $request->fechacreacion,
        ]);
        
        // Redirigir con mensaje de éxito
        return redirect()->route('contratos.index')->with('success', 'Contrato actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrato $contrato)
    {
        //
    }
}
