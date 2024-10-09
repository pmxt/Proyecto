<?php

namespace App\Http\Controllers;

use App\Models\consulta1;
use Illuminate\Http\Request;
use App\Models\ExamenFisico;
use App\Models\Medicamento;
use App\Models\Modelmedicamento;
use App\Models\SuplementoAsignado;

class AsignarMedicamentoController extends Controller
{
    // Muestra la vista para asignar medicamentos a una paciente
    public function obtener($examenFisicoId)
    {
        // Obtener todos los medicamentos disponibles
        $medicamentos = Modelmedicamento::all();

        return view('layouts.asignar_medicamento', compact('medicamentos', 'examenFisicoId'));
    }

    // Guardar los medicamentos asignados a una paciente
    public function guardar(Request $request, $examenFisicoId)
    {
        // Validar que al menos un medicamento haya sido seleccionado y que las cantidades sean válidas
        $validated = $request->validate([
            'medicamentos' => 'required|array',
            'cantidades' => 'required|array',
            'cantidades.*' => 'integer|min:1', // Cada cantidad debe ser un entero mayor que 0
        ]);

        foreach ($validated['medicamentos'] as $key => $medicamentoId) {
            $medicamento = Modelmedicamento::find($medicamentoId);
            $cantidadAsignada = $validated['cantidades'][$key];

            // Verificar si hay suficiente cantidad del medicamento disponible
            if ($medicamento->cantidad >= $cantidadAsignada) {
                SuplementoAsignado::create([
                    'examen_fisico_id' => $examenFisicoId,
                    'medicamento_id' => $medicamentoId,
                    'cantidad_asignada' => $cantidadAsignada,
                ]);

                // Reducir la cantidad del medicamento disponible
                $medicamento->decrement('cantidad', $cantidadAsignada);
            } else {
                return redirect()->back()->withErrors(['No hay suficiente stock de ' . $medicamento->nombre]);
            }
        }
        $this->agendarNuevaCita($examenFisicoId);

        return redirect()->route('pacientes.listar', ['examenFisicoId' => $examenFisicoId])
            ->with('success', 'Suplementos asignados correctamente y nueva cita agendada.');
    }

    // Función para agendar una nueva cita prenatal
    private function agendarNuevaCita($examenFisicoId)
    {
        // Obtener el examen físico y la consulta prenatal relacionada
        $examenFisico = ExamenFisico::findOrFail($examenFisicoId);
        $consultaPrenatal = $examenFisico->consultaPrenatal;

        // Obtener las semanas de embarazo desde el examen físico
        $semanasEmbarazo = $examenFisico->semanas_embarazo;

        // Determinar la fecha de la próxima cita según las semanas de embarazo
        if ($semanasEmbarazo <= 12) {
            // Si la paciente tiene 12 semanas o menos, la próxima cita es a las 26 semanas
            $proximaFechaCita = now()->addWeeks(14); // Próxima cita en 14 semanas (hasta las 26 semanas)
        } elseif ($semanasEmbarazo <= 26) {
            // Si la paciente tiene entre 12 y 26 semanas, la próxima cita es a las 32 semanas
            $proximaFechaCita = now()->addWeeks(6); // Próxima cita en 6 semanas (hasta las 32 semanas)
        } elseif ($semanasEmbarazo <= 32) {
            // Si la paciente tiene entre 26 y 32 semanas, la próxima cita es entre 36-38 semanas
            $proximaFechaCita = now()->addWeeks(4); // Próxima cita en 4 semanas (36-38 semanas)
        } else {
            // Si la paciente tiene más de 32 semanas, no se programan más citas prenatales
            $proximaFechaCita = null;
        }

        // Si hay una próxima cita que programar (es decir, no ha terminado el ciclo prenatal)
        if ($proximaFechaCita) {
            // Crear la nueva consulta prenatal
            consulta1::create([
                'paciente_cui' => $consultaPrenatal->paciente_cui,
                'fecha_consulta' => $proximaFechaCita,
                'tipo_servicio' => $consultaPrenatal->tipo_servicio,
                'area_salud' => $consultaPrenatal->area_salud,
                'nombre_servicio' => $consultaPrenatal->nombre_servicio,
                'motivo_consulta' => 'Control Prenatal',
                'tipo_consulta' => 'Seguimiento',
            ]);
        }

        // Redirigir o retornar
        return redirect()->route('pacientes.listar', ['examenFisicoId' => $examenFisicoId])
            ->with('success', 'Suplementos asignados correctamente y nueva cita agendada.')
            ->with('proximaFechaCita', $proximaFechaCita ? $proximaFechaCita->toDateString() : 'No se programó nueva cita');
    }
}
