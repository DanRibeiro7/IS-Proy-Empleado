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
  public function index(Request $request)
{
    $busqueda = $request->input('buscar');

    $contratos = Contrato::with(['empleado', 'area', 'modalidad', 'estado'])
        ->when($busqueda, function ($query, $busqueda) {
            $query->whereHas('empleado', function ($q) use ($busqueda) {
                $q->where('apePaterno', 'like', '%' . $busqueda . '%')
                  ->orWhere('apeMaterno', 'like', '%' . $busqueda . '%')
                  ->orWhere('nombres', 'like', '%' . $busqueda . '%')
                  ->orWhere('dni', 'like', '%' . $busqueda . '%');
            });
        })
        ->get();

    $areas = Area::all();
    $modalidades = Modalidad::all();
    $estados = Estado::whereIn('idEstado', [1, 2])->get();

    return view('contrato.index', compact('contratos', 'areas', 'modalidades', 'estados'));
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
        'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
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
    
        
       
         // Generar pagos mensuales
$inicio = \Carbon\Carbon::parse($contrato->fechaInicio)->copy()->addMonth();

// Si hay fechaFin, generar pagos hasta ese mes
if ($contrato->fechaFin) {
    $fin = \Carbon\Carbon::parse($contrato->fechaFin)->copy()->startOfMonth();

    for ($fecha = $inicio->copy()->startOfMonth(); $fecha <= $fin; $fecha->addMonth()) {
        $this->crearPagoMensual($contrato, $request, $fecha);
    }
} else {
    // Si no hay fechaFin (contrato indefinido), solo generar el primer pago
    $this->crearPagoMensual($contrato, $request, now());
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
         $empleadosConContrato = Contrato::pluck('idEmpleado')->toArray();
        $empleados = Empleado::whereNotIn('idEmpleado', $empleadosConContrato)->get(); // Obtener todos los empleados
        $areas = Area::all(); // Obtener todas las áreas
        $modalidades = Modalidad::all(); // Obtener todas las modalidades
        $jornadas = Jornada::all(); // Obtener todas las jornadas
        $estados=Estado::whereIn('idEstado',[1,2])->get();
        $bancos=Banco::all(); 
    
        // Pasar estas variables a la vista
        return view('contrato.edit', compact('contrato','empleados', 'areas', 'modalidades', 'jornadas','estados','bancos'));
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
    private function crearPagoMensual($contrato, $request, $fecha)
{
    $salario = $this->calcularSalario($contrato->idContrato, $fecha);

    Pago::create([
        'idContrato' => $contrato->idContrato,
        'idBanco' => $request->idBanco,
        'numCuenta' => $request->numCuenta,
        'fechaPago' => $fecha,
        'estado' => 1,
        'monto' => $salario['monto'],
        'gratificacion' => $salario['gratificacion'],
        'fechacreacion' => now(),
    ]);
}
public function generarPagoMensual(Request $request, $idContrato)
{
    $contrato = Contrato::findOrFail($idContrato);
    $fecha = now()->startOfMonth();

    $yaExiste = Pago::where('idContrato', $idContrato)
        ->whereMonth('fechaPago', $fecha->month)
        ->whereYear('fechaPago', $fecha->year)
        ->exists();

    if ($yaExiste) {
        return back()->with('info', 'Ya existe un pago para este contrato este mes.');
    }

    $salario = $this->calcularSalario($idContrato, $fecha);

    Pago::create([
        'idContrato' => $idContrato,
        'idBanco' => $request->idBanco,
        'numCuenta' => $request->numCuenta,
        'fechaPago' => $fecha,
        'estado' => 1,
        'monto' => $salario['monto'],
        'gratificacion' => $salario['gratificacion'],
        'fechacreacion' => now(),
    ]);

    return back()->with('success', 'Pago mensual generado correctamente.');
}


   
}
