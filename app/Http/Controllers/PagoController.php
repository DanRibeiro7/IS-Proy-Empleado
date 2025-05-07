<?php

namespace App\Http\Controllers;
use App\Models\contrato;
use App\Models\Empleado;
use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos = Pago::with('empleado')->get(); // Esto carga los pagos y los empleados relacionados

        // Retornar la vista pasando los pagos obtenidos
        return view('pagos.index', compact('pagos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empleados = Empleado::all(); // Recupera solo los empleados

        // Retornar la vista de creación pasando los empleados
        return view('pagos.create', compact('empleados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'idEmpleado' => 'required|exists:empleados,idEmpleado',  // Verifica que el idEmpleado exista en la tabla empleados
            'monto' => 'required|numeric|min:0', // Verifica que el monto sea un número y sea mayor o igual a 0
            'fechaPago' => 'required|date',  // Verifica que la fecha sea válida
            'tipoPago' => 'required|string', // Verifica que tipoPago sea una cadena de texto
            'descripcion' => 'nullable|string', // Descripción es opcional, si está presente debe ser texto
        ]);
    
        // Crear un nuevo pago usando los datos validados
        Pago::create([
            'idEmpleado' => $request->idEmpleado,
            'monto' => $request->monto,
            'fechaPago' => $request->fechaPago,
            'tipoPago' => $request->tipoPago,
            'descripcion' => $request->descripcion, // Descripción es opcional, por lo tanto no es obligatorio
        ]);
    
        // Redirigir a la lista de pagos con un mensaje de éxito
        return redirect()->route('pagos.index')->with('success', 'Pago creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        return view('pagos.show', compact('pago'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
{
    // Validar los datos del formulario
    $request->validate([
        'idEmpleado' => 'required|exists:empleados,idEmpleado',  // Verifica que el idEmpleado exista en la tabla empleados
        'monto' => 'required|numeric|min:0', // Verifica que el monto sea un número y sea mayor o igual a 0
        'fechaPago' => 'required|date',  // Verifica que la fecha sea válida
        'tipoPago' => 'required|string', // Verifica que tipoPago sea una cadena de texto
        'descripcion' => 'nullable|string', // Descripción es opcional, si está presente debe ser texto
    ]);

    // Actualizar el pago con los nuevos datos
    $pago->update([
        'idEmpleado' => $request->idEmpleado,
        'monto' => $request->monto,
        'fechaPago' => $request->fechaPago,
        'tipoPago' => $request->tipoPago,
        'descripcion' => $request->descripcion, // Descripción es opcional, por lo tanto no es obligatorio
    ]);

    // Redirigir a la lista de pagos con un mensaje de éxito
    return redirect()->route('pagos.index')->with('success', 'Pago actualizado con éxito.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
