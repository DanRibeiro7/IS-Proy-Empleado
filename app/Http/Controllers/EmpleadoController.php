<?php

namespace App\Http\Controllers;
use App\Models\Estado;
use App\Models\Empleado;
use App\Models\EstadoCivil;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::with("estado_civil")->get();
        return view('empleado.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estados_civiles=EstadoCivil::all();
        $estados=Estado::whereIn('idEstado',[1,2])->get();
        return view('empleado.create',compact('estados_civiles','estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            //'codEmpleado' => 'required|unique:empleado',
            'dni' => 'required|unique:empleado',
            'nombres' => 'required',
            'apePaterno' => 'required',
            'apeMaterno' => 'required',
            'fechaNacimiento' => 'required|date',
            'genero' => 'required',
            'idEstCivil' => 'required',
            'direccion' => 'required',
            'numCelular' => 'required',
            'correo' => 'required|email',
            'photoUrl' => 'nullable',
            'idEstado' => 'required',
        ]);

        Empleado::create([
            'codEmpleado' => Str::random(10),//$request->codEmpleado,
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
            'fechacreacion' => now(),
        ]);

        return redirect()->route('empleados.index')->with('success', 'Empleado creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        return view('empleado.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        $estados_civiles = EstadoCivil::all(); // Obtener todos los estados civiles
        $estados = Estado::all(); // Obtener todos los estados

        // Pasar los datos a la vista
        return view('empleado.edit', compact('empleado', 'estados_civiles', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'codEmpleado' => 'required|unique:empleado,codEmpleado,' . $empleado->idEmpleado . ',idEmpleado',
            'dni' => 'required|unique:empleado,dni,' . $empleado->idEmpleado . ',idEmpleado',
            'nombres' => 'required',
            'apePaterno' => 'required',
            'apeMaterno' => 'required',
            'fechaNacimiento' => 'required|date',
            'genero' => 'required',
            'idEstCivil' => 'required',
            'direccion' => 'required',
            'numCelular' => 'required',
            'correo' => 'required|email',
            'photoUrl' => 'nullable',
            'idEstado' => 'required',
        ]);

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

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente.');
    }
}
