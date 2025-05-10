<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\contrato;
use App\Models\Pago;
use App\Models\Banco;

use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $contratos = Contrato::with('empleado')->get();
    return view('pago.index', compact('contratos'));
}
    public function generatePDF($id)
    {
        // Obtener el pago y el contrato
        $pago = Pago::with('contrato')->find($id);
    
        // Verificar si el pago existe
        if(!$pago) {
            return redirect()->back()->with('error', 'Pago no encontrado');
        }
    
        try {
            $pdf = PDF::loadView('pago.boleta', compact('pago'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }
        

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // En este caso no se necesitan datos relacionados con empleado ni otros
        $contratos=Contrato::all();
        $bancos=Banco::whereIn('idBanco',[1,2])->get();
        return view('pago.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'idContrato' => 'required|exists:contratos,idContrato', // Asegúrate que el contrato exista
            'idBanco' => 'required|exists:bancos,idBanco',  // Verifica que el banco exista
            'numCuenta' => 'required|string', // Verifica que el número de cuenta sea una cadena
            'fechaPago' => 'required|date',  // Verifica que la fecha sea válida
            'estado' => 'required|string', // Verifica que el estado sea una cadena
            'monto' => 'required|numeric|min:0', // Verifica que el monto sea un número y sea mayor o igual a 0
            'gratificacion' => 'nullable|numeric', // Verifica que la gratificación sea opcional y un número
            'fechacreacion' => 'required|date', // Verifica que la fecha de creación sea válida
        ]);
    
        // Crear un nuevo pago con los datos validados
        Pago::create([
            'idContrato' => $request->idContrato,
            'idBanco' => $request->idBanco,
            'numCuenta' => $request->numCuenta,
            'fechaPago' => $request->fechaPago,
            'estado' => $request->estado,
            'monto' => $request->monto,
            'gratificacion' => $request->gratificacion, // Gratificación es opcional
            'fechacreacion' => $request->fechacreacion,
        ]);
    
        // Redirigir a la lista de pagos con un mensaje de éxito
        return redirect()->route('pago.index')->with('success', 'Pago creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        return view('pago.show', compact('pago'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        return view('pago.edit', compact('pago'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {
        // Validar los datos del formulario
        $request->validate([
            'idContrato' => 'required|exists:contratos,idContrato',
            'idBanco' => 'required|exists:bancos,idBanco',
            'numCuenta' => 'required|string',
            'fechaPago' => 'required|date',
            'estado' => 'required|string',
            'monto' => 'required|numeric|min:0',
            'gratificacion' => 'nullable|numeric',
            'fechacreacion' => 'required|date',
        ]);

        // Actualizar el pago con los nuevos datos
        $pago->update([
            'idContrato' => $request->idContrato,
            'idBanco' => $request->idBanco,
            'numCuenta' => $request->numCuenta,
            'fechaPago' => $request->fechaPago,
            'estado' => $request->estado,
            'monto' => $request->monto,
            'gratificacion' => $request->gratificacion,
            'fechacreacion' => $request->fechacreacion,
        ]);

        // Redirigir a la lista de pagos con un mensaje de éxito
        return redirect()->route('pago.index')->with('success', 'Pago actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        // Eliminar el pago
        $pago->delete();

        // Redirigir a la lista de pagos con un mensaje de éxito
        return redirect()->route('pago.index')->with('success', 'Pago eliminado con éxito.');
    }
   public function pagosPorContrato($idContrato)
{
    $contrato = Contrato::with('empleado')->findOrFail($idContrato);

    // Carga todos los pagos del contrato, incluyendo la relación con el banco
    $pagos = Pago::with('banco')
        ->where('idContrato', $idContrato)
        ->get();

    return view('pago.index_por_contrato', compact('contrato', 'pagos'));
}
public function seleccionarContrato()
{
    $contratos = \App\Models\Contrato::with('empleado')->get();
    return view('pago.seleccionar_contrato', compact('contratos'));
}

}
