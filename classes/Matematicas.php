<?php

class Matematicas
{
    private int $numero;

    public function __construct(int $numero = 0)
    {
        // Limita a mínimo 1 para evitar secuencias negativas o cero
        $this->numero = max(1, $numero);
    }

    public function obtenerFibonacci(): array
    {
        if ($this->numero === 1) {
            return [0];
        }

        $secuencia = [0, 1];
        for ($i = 2; $i < $this->numero; $i++) {
            $secuencia[] = $secuencia[$i - 1] + $secuencia[$i - 2];
        }

        return $secuencia;
    }

    public function obtenerFactorial(): array
    {
        $pasos = [];
        $acumulado = 1;

        for ($i = 1; $i <= $this->numero; $i++) {
            $acumulado *= $i;
            $pasos[] = "$i! = " . number_format($acumulado, 0, '', '.');
        }

        return $pasos;
    }
}