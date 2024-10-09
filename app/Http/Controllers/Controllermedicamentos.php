<?php

namespace App\Http\Controllers;

use App\Models\Modelmedicamento;
use Illuminate\Http\Request;

class Controllermedicamentos extends Controller
{
    // Mostrar la vista de administración de medicamentos
    public function index()
    {
        // Obtener los medicamentos paginados
        $medicamentos = Modelmedicamento::paginate(10);
        return view('layouts.medicamentos', compact('medicamentos'));
    }

    // Guardar un nuevo medicamento
    public function store(Request $request)
    {
        // Validación de los campos
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
        ]);

        // Crear el medicamento
        Modelmedicamento::create($validated);

        // Redirigir con mensaje de éxito
        return redirect()->route('medicamentos.index')->with('success', 'Medicamento agregado correctamente.');
    }

    // Editar un medicamento existente
    public function edit($id)
    {
        $medicamento = Modelmedicamento::findOrFail($id);
        return view('layouts.medicamentoEdit', compact('medicamento'));
    }

    // Actualizar un medicamento existente
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
        ]);

        // Actualizar el medicamento
        $medicamento = Modelmedicamento::findOrFail($id);
        $medicamento->update($validated);

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento actualizado correctamente.');
    }

    // Eliminar un medicamento
    public function destroy($id)
    {
        $medicamento = Modelmedicamento::findOrFail($id);
        $medicamento->delete();

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento eliminado correctamente.');
    }

}
