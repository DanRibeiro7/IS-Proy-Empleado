<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
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
        // Validar los datos del formulario
        $request->validate([
            'codEmpleado' => 'required|unique:empleados',
            'dni' => 'required|unique:empleados',
            'nombres' => 'required',
            'apePaterno' => 'required',
            'apeMaterno' => 'required',
            'fechaNacimiento' => 'required|date',
            'genero' => 'required',
            'idEstCivil' => 'required',
            'direccion' => 'required',
            'numCelular' => 'required',
            'correo' => 'required|email',
            'photoUrl' => 'nullable|url',
            'idEstado' => 'required',
        ]);
    
        // Crear un nuevo empleado usando los datos validados
        Empleado::create([
            'codEmpleado' => $request->codEmpleado,
            'dni' => $request->dni,
            'nombres' => $request->nombres,
            'apePaterno' => $request->apePaterno,
            'apeMaterno' => $request->apeMaterno,
            'fechaNacimiento' => $request->fechaNacimiento,
            'genero' => $request->genero,
            'idEstCivil' => $request->idEstCivil,
            'direccion' => $request->direccion,
            'numCelular' => $request->numCelular,
            'correo' => $request->correo,
            'photoUrl' => $request->photoUrl,
            'idEstado' => $request->idEstado,
            'fechacreacion' => now(), // Puedes almacenar la fecha actual en este campo
        ]);
    
        // Redirigir al listado de empleados con un mensaje de éxito
        return redirect()->route('empleados.index')->with('success', 'Empleado creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
{
    // Validar los datos del formulario
    $request->validate([
        'codEmpleado' => 'required|unique:empleados,codEmpleado,' . $empleado->idEmpleado,
        'dni' => 'required|unique:empleados,dni,' . $empleado->idEmpleado,
        'nombres' => 'required',
        'apePaterno' => 'required',
        'apeMaterno' => 'required',
        'fechaNacimiento' => 'required|date',
        'genero' => 'required',
        'idEstCivil' => 'required',
        'direccion' => 'required',
        'numCelular' => 'required',
        'correo' => 'required|email',
        'photoUrl' => 'nullable|url',
        'idEstado' => 'required',
    ]);

    // Actualizar el empleado
    $empleado->update([
        'codEmpleado' => $request->codEmpleado,
        'dni' => $request->dni,
        'nombres' => $request->nombres,
        'apePaterno' => $request->apePaterno,
        'apeMaterno' => $request->apeMaterno,
        'fechaNacimiento' => $request->fechaNacimiento,
        'genero' => $request->genero,
        'idEstCivil' => $request->idEstCivil,
        'direccion' => $request->direccion,
        'numCelular' => $request->numCelular,
        'correo' => $request->correo,
        'photoUrl' => $request->photoUrl,
        'idEstado' => $request->idEstado,
    ]);

    // Redirigir a la lista con un mensaje de éxito
    return redirect()->route('empleados.index')->with('success', 'Empleado actualizado con éxito.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        //
    }
}
