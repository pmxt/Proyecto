<?php

namespace App\Livewire;

use Livewire\Component;

class Calculo1 extends Component

{
    public $fechaNacimiento;
    public $edad;

     public function updatedFechaNacimiento($value)
    {
        if ($value) {
            $this->edad = $this->calcularEdad($value);
        } else {
            $this->edad = null; // Resetear la edad si no hay fecha
        }
    }

    public function calcularEdad($fechaNacimiento)
    {
        $fechaNacimiento = new \DateTime($fechaNacimiento);
        $fechaActual = new \DateTime();

        return $fechaActual->diff($fechaNacimiento)->y; // Retorna la edad en años
    }

    public function render()
    {
        return view('livewire.calculo1');
    }
}
