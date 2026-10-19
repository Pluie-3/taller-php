<?php
require_once __DIR__ . '/Operaciones.php';

class Calculadora
{
    public function ejecutar(string $tipo, float $a, float $b): Operacion
    {
        switch ($tipo) {
            case 'suma':
                return new Suma($a, $b);
            case 'resta':
                return new Resta($a, $b);
            case 'multiplicacion':
                return new Multiplicacion($a, $b);
            case 'division':
                return new Division($a, $b);
            case 'porcentaje':
                return new Porcentaje($a, $b);
            default:
                throw new Exception('Operación no válida.');
        }
    }
}
