<?php
class Binario
{
    private int $numero;
    private array $pasos = [];
    public function __construct(int $numero)
    {
        $this->numero = $numero;
    }
    public function get_binario(): string
    {
        $this->pasos = [];
        if ($this->numero === 0) {
            return '0';
        }
        if ($this->numero < 0) {
            $cociente = -$this->numero;
        } else {
            $cociente = $this->numero;
        }
        $bits = '';
        while ($cociente > 0) {
            $residuo = $cociente % 2;
            $nuevo = intdiv($cociente, 2);
            $this->pasos[] = ['dividendo' => $cociente, 'cociente' => $nuevo, 'residuo' => $residuo];
            $bits = $residuo . $bits;
            $cociente = $nuevo;
        }
        if ($this->numero < 0) {
            return '-' . $bits;
        }
        return $bits;
    }
    public function get_pasos(): array
    {
        return $this->pasos;
    }
}
