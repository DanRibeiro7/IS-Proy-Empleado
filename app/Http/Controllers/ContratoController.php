<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use App\Models\Area;
use App\Models\Modalidad;
use App\Models\Jornada;
use App\Models\Estado;
use App\Models\Contrato;
use App\Models\Pago;
use App\Models\Banco;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contratos =  Contrato::with('empleado')->get();;
        $areas = Contrato::with('area')->get();
        $modalidades = Contrato::with('area')->get();
        $estados=Estado::whereIn('idEstado',[1,2])->get(); // O el método que estés utilizando para obtener los contratos
        return view('contrato.index', compact('contratos','areas','modalidades','estados'));
    }
    private function calcularSalario($idContrato, $fechaPago)
    {
        $contrato = \App\Models\Contrato::with('area')->findOrFail($idContrato);
    
        $salarioBase = $contrato->area->salario ?? 0;
        $fecha = \Carbon\Carbon::parse($fechaPago);
        $mes = $fecha->month;
    
        $monto = $salarioBase;
        $gratificacion = 0;
    
        // Si es julio (7) o diciembre (12), aplicar gratificación
        if ($mes === 7 || $mes === 12) {
            $monto += 200;
            $gratificacion = 200;
        }
    
        return [
            'monto' => $monto,
            'gratificacion' => $gratificacion
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empleadosConContrato = Contrato::pluck('idEmpleado')->toArray();
        $empleados = Empleado::whereNotIn('idEmpleado', $empleadosConContrato)->get(); // Obtener todos los empleados
        $areas = Area::all(); // Obtener todas las áreas
        $modalidades = Modalidad::all(); // Obtener todas las modalidades
        $jornadas = Jornada::all(); // Obtener todas las jornadas
        $estados=Estado::whereIn('idEstado',[1,2])->get();
        $bancos=Banco::all(); 
    
        // Pasar estas variables a la vista
        return view('contrato.create', compact('empleados', 'areas', 'modalidades', 'jornadas','estados','bancos'));
    }


    /**
     * Store a newly created resource in storage.
     *ESTE ESTABA COMENTADO 
     */
    public function store(Request $request)
    {
     // Validar los datos del formulario (si es necesario)
     $request->validate([
        'idEmpleado' => 'required',
        'idArea' => 'required',
        'idModalidad' => 'required',
        'idJornada' => 'required',
        //'codContrato' => 'required',
        'fechaInicio' => 'required|date',
        'fechaFin' => 'required|date',
        'idEstado' => 'required',
        'horasLaboral' => 'required',
        'idBanco' => 'required|exists:banco,idBanco',  // Validar que el banco existe
        'numCuenta' => 'required|string|max:50', // Validar que el número de cuenta esté presente
    ]);

    // Crear un nuevo contrato
    $contrato = Contrato::create([
        'idEmpleado' => $request->idEmpleado,
        'idArea' => $request->idArea,
        'idModalidad' => $request->idModalidad,
        'idJornada' => $request->idJornada,
        'codContrato' => Str::random(10),
        'fechaInicio' => $request->fechaInicio,
        'fechaFin' => $request->fechaFin,
        'idEstado' => $request->idEstado,
        'horasLaboral' => $request->horasLaboral,
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
            $salario = app(\App\Http\Controllers\PagoController::class)->calcularSalario($contrato->idContrato, $fecha);

            Pago::create([
                'idContrato' => $contrato->idContrato,
                'idBanco' => $request->idBanco, // O el valor que necesites
                'numCuenta' => $request->numCuenta, // O el valor que necesites
                'fechaPago' => $fecha,
                'estado' => 1, // O el valor que necesites
                'monto' => $salario['monto'], // O el valor que necesites
                'gratificacion' =>  $salario['gratificacion'], // O el valor que necesites
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
        $contrato->delete();

        return redirect()->route('contratos.index')->with('success', 'Contrato eliminado exitosamente.');
    }
   
}
