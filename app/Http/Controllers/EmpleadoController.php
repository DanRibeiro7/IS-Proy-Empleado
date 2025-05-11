<?php

namespace App\Http\Controllers;
use App\Models\Estado;
use App\Models\Empleado;
use App\Models\EstadoCivil;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    public function ficha($id)
{
    $empleado = Empleado::with('estado_civil')->findOrFail($id);

    // Calcular antigüedad
    if ($empleado->fechaCreacion) {
        $fechaCreacion = Carbon::parse($empleado->fechaCreacion);
        $hoy = Carbon::now();
        $antiguedad = $fechaCreacion->diff($hoy)->format('%y años, %m meses, %d días');
    } else {
        $antiguedad = 'Sin fecha de creación';
    }

    // Calcular beneficios laborales
    $beneficios = [];
    if ($empleado->fechaCreacion) {
        $años = $fechaCreacion->diffInYears($hoy);

        // Gratificaciones
        $beneficios['Gratificación de Julio'] = 'Sí';
        $beneficios['Gratificación de Diciembre'] = 'Sí';

        // Vacaciones
        $beneficios['Vacaciones'] = $años >= 1 ? 'Sí' : 'No';

        // CTS (Compensación por Tiempo de Servicios)
        $beneficios['CTS'] = $años >= 1 ? 'Sí' : 'No';
    } else {
        $beneficios['Gratificación de Julio'] = 'No aplica';
        $beneficios['Gratificación de Diciembre'] = 'No aplica';
        $beneficios['Vacaciones'] = 'No aplica';
        $beneficios['CTS'] = 'No aplica';
    }
    // Calcular edad
if ($empleado->fechaNacimiento) {
    $edad = Carbon::parse($empleado->fechaNacimiento)->age;
} else {
    $edad = 'Desconocida';
}

    return view('empleado.fichaemp', compact('empleado', 'antiguedad', 'beneficios','edad'));
}
    public function index()
    {
        $empleados = Empleado::with("estado_civil")->get();
        return view('empleado.index', compact('empleados'));
        foreach ($empleados as $empleado) {
            if ($empleado->fechaCreacion) {
                $fechaCreacion = Carbon::parse($empleado->fechaCreacion);
                $hoy = Carbon::now();
    
                // Calcular la diferencia en años, meses y días
                $empleado->antiguedad = $fechaCreacion->diff($hoy)->format('%y años, %m meses, %d días');
            } else {
                $empleado->antiguedad = 'Sin fecha de creación';
            }
        }
    
    
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
            'idEstado' => 'nullable',
            'photoUrl' => 'nullable',
          
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la foto
        ]);

         // Si hay archivo de foto, manejar la carga
         if ($request->hasFile('photo')) {
            $rutaImagen = $request->file('photo')->store('imagenes', 'public'); // Guarda en storage/app/public/imagenes
        } else {
            $rutaImagen = null; // Si no se sube imagen, se guarda como null
        }

        Empleado::create([
            'codEmpleado' => Str::random(4),//$request->codEmpleado,
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
            'idEstado' => $request->idEstado,
            'photoUrl' => $rutaImagen,
           
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
           // 'codEmpleado' => 'required|unique:empleado,codEmpleado,' . $empleado->idEmpleado . ',idEmpleado',
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
           
        ]);
       
        
    if ($request->hasFile('photo')) {
        $rutaImagen = $request->file('photo')->store('imagenes', 'public'); // Guarda en storage/app/public/imagenes
    } else {
        $rutaImagen = $empleado->photoUrl; // Mantener la foto actual si no se sube una nueva
    }

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
            'photoUrl' => $rutaImagen,

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

    
    public function generarPdf($id)
    {
        $empleado = Empleado::findOrFail($id);
        $pdf = Pdf::loadView('empleado.ficha', ['empleado' => $empleado]);

        return $pdf->download('reporte_empleado.pdf');
    }
}
