<?php

namespace App\Http\Controllers;

use App\Models\Modelmedicamento;
use Illuminate\Http\Request;

class Controllermedicamentos extends Controller
{
   
    public function index()
    {
      
        $medicamentos = Modelmedicamento::paginate(10);
        return view('layouts.medicamentos', compact('medicamentos'));
    }

    
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
        ]);

       
        Modelmedicamento::create($validated);

        
        return redirect()->route('medicamentos.index')->with('success', 'Medicamento agregado correctamente.');
    }

   
    public function edit($id)
    {
        $medicamento = Modelmedicamento::findOrFail($id);
        return view('layouts.medicamentoEdit', compact('medicamento'));
    }

    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'cantidad' => 'required|integer|min:1',
        ]);

      
        $medicamento = Modelmedicamento::findOrFail($id);
        $medicamento->update($validated);

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento actualizado correctamente.');
    }

   
    public function destroy($id)
    {
        $medicamento = Modelmedicamento::findOrFail($id);
        $medicamento->delete();

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento eliminado correctamente.');
    }

}
