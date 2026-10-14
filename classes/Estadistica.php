<?php
class Estadistica
{
    private array $numeros = [];
    private array $invalidos = [];
    public function __construct(string $cadena = '')
    {
        $partes = preg_split('/[\s,;]+/', trim($cadena), -1, PREG_SPLIT_NO_EMPTY);
        foreach ($partes as $parte) {
            if (is_numeric($parte)) {
                $this->numeros[] = (float) $parte;
            } else {
                $this->invalidos[] = $parte;
            }
        }
    }
    public function get_cantidad(): int
    {
        return count($this->numeros);
    }
    public function get_invalidos(): array
    {
        return $this->invalidos;
    }
    public function get_promedio(): float
    {
        if ($this->get_cantidad() === 0) {
            return 0;
        }
        return array_sum($this->numeros) / $this->get_cantidad();
    }
    public function get_mediana(): float
    {
        $total = $this->get_cantidad();
        if ($total === 0) {
            return 0;
        }
        $ordenados = $this->numeros;
        sort($ordenados);
        $centro = intdiv($total, 2);
        if ($total % 2 === 0) {
            return ($ordenados[$centro - 1] + $ordenados[$centro]) / 2;
        }
        return $ordenados[$centro];
    }
    public function get_moda(): string
    {
        if ($this->get_cantidad() === 0) {
            return 'N/A';
        }
        $repeticiones = array_count_values(array_map('strval', $this->numeros));// cantidad de veces de cada valor
        $mayor = max($repeticiones);
        if ($mayor === 1 && $this->get_cantidad() > 1) {
            return 'No hay moda';
        }
        return implode(', ', array_keys($repeticiones, $mayor));
    }
}
