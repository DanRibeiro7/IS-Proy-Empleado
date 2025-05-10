<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    // Mostrar todas las áreas
    public function index()
    {
        $areas = Area::all();
        return view('area.index', compact('areas'));
    }

    // Mostrar el formulario para crear una nueva área
    public function create()
    {
        return view('area.create');
    }

    // Guardar una nueva área
    public function store(Request $request)
    {
        $request->validate([
            'nomArea' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0',
            
        ]);

        
        Area::create($request->only(['nomArea', 'salario']));

        return redirect()->route('areas.index')
                         ->with('success', 'Área creada correctamente.');
    }

    // Mostrar una sola área
    public function show($id)
    {
        $area = Area::findOrFail($id);
        return view('area.show', compact('area'));
    }

    // Mostrar el formulario para editar un área
    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('area.edit', compact('area'));
    }

    // Actualizar un área existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomArea' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0',
          
        ]);

        $area = Area::findOrFail($id);
        $area->update($request->all());

        return redirect()->route('areas.index')
                         ->with('success', 'Área actualizada correctamente.');
    }

    // Eliminar un área
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return redirect()->route('areas.index')
                         ->with('success', 'Área eliminada correctamente.');
    }
}
