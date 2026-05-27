<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;

class PerfilesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perfiles = Perfil::all();
        return view('Perfiles.index', compact('perfiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Perfiles.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validar la información 
        $request->validate([
            'nombre' => ['required', 'string', 'max:255', Rule::unique('perfiles', 'nombre')],
        ]);

        // Guardar la informacion en la tabla perfiles
        $perfil = Perfil::create([
            'nombre' => $request->get('nombre'),
        ]);

        return redirect()->route('perfiles.index')->with('success', 'Perfil creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $perfil = Perfil::findOrFail($id);
        return view('Perfiles.editar', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //Validar la información
        $request->validate([
            'nombre' => ['required', 'string', 'max:255', Rule::unique('perfiles', 'nombre')->ignore($id)]
        ]);

        //Actualizar la informacion
        $perfil = Perfil::findOrFail($id);
        $perfil->nombre = $request->get('nombre');
        $perfil->save();

        return redirect()->route('perfiles.index')->with('success', 'Perfil actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perfil = Perfil::findOrFail($id);
        $perfil->delete();

        return redirect()->route('perfiles.index')->with('success', 'Perfil eliminado exitosamente.');
    }
}
