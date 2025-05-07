<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use App\Models\Area;
use App\Models\Modalidad;
use App\Models\Jornada;
use App\Models\Estado;
use App\Models\Contrato;
use App\Models\Pago;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contratos = Contrato::all(); // O el método que estés utilizando para obtener los contratos
        return view('contrato.index', compact('contratos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empleados = Empleado::all(); // Obtener todos los empleados
        $areas = Area::all(); // Obtener todas las áreas
        $modalidades = Modalidad::all(); // Obtener todas las modalidades
        $jornadas = Jornada::all(); // Obtener todas las jornadas
        $estados=Estado::whereIn('idEstado',[1,2])->get();
    
        // Pasar estas variables a la vista
        return view('contrato.create', compact('empleados', 'areas', 'modalidades', 'jornadas','estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       /* $request->validate([
            //'codEmpleado' => 'required|unique:empleado',
            'idEmpleado' => 'required',
            'idArea' => 'required',
            'idModalidad' => 'required',
            'idJornada' => 'required',
            'codContrato' => 'required',
            'fechaInicio' => 'required',
            'fechaFin' => 'required',
            'idEstado' => 'required',
            'horasLaboral' => 'required',
            'fechacreacion' => 'required',
            
        ]);*/
        //// Crear un nuevo contrato usando los datos validados
        $contrato= Contrato::create([
            
            'idEmpleado'    => $request->idEmpleado,
            'idArea'        => $request->idArea,
            'idModalidad'   => $request->idModalidad,
            'idJornada'     => $request->idJornada,
            'codContrato'   => $request->codContrato,
            'fechaInicio'   => $request->fechaInicio,
            'fechaFin'      => $request->fechaFin,
            'idEstado'      => $request->idEstado,
            'horasLaboral'  => $request->horasLaboral,
            'fechacreacion' => now(),
        ]);
       
                $inicio = $contrato->fechaInicio->copy()->addMonth(); // comienza 1 mes después
            $fin = $contrato->fechaFin->copy()->startOfMonth();   // asegúrate de que esté al inicio del mes

        $fechas = [];

        for ($fecha = $inicio->copy()->startOfMonth(); $fecha <= $fin; $fecha->addMonth()) {
            $fechas[] = $fecha->copy(); // guardar copia para usarla más adelante
        }

        // Ejemplo: crear registros con esas fechas
        foreach ($fechas as $fecha) {
            Pago::create([
                'idContrato' => $contrato->idContrato,
                'idBanco' => null, // O el valor que necesites
                'numCuenta' => null, // O el valor que necesites
                'fechaPago' => $fecha,
                'estado' => 1, // O el valor que necesites
                'monto' => null, // O el valor que necesites
                'gratificacion' => null, // O el valor que necesites
                'fechacreacion' => now(),
            ]);
        }
        




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
