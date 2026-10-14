<?php

class Estadistica
{
private array $numeros = [];
public function __construct(string $cadenaNumeros = '')
    {
        $limpio = str_replace(' ', ',', $cadenaNumeros);
        $partes = explode(',', $limpio);
        foreach ($partes as $item) {
            $item = trim($item);
            if ($item !== '' && is_numeric($item)) {
                $this->numeros[] = (float)$item;
            }
        }
    }
     public function calcularPromedio(): float
    {
        $total = count($this->numeros);
        if ($total === 0) {
            return 0;
        }
        $suma = 0;
        foreach ($this->numeros as $num) {
            $suma += $num;
        }
        return $suma / $total;
    }
    public function calcularMediana(): float
    {
        $cantidad = count($this->numeros);
        if ($cantidad === 0) {
            return 0;
        }
        $datos = $this->numeros;
        sort($datos);
        $mitad = (int)($cantidad / 2);
        if ($cantidad % 2 === 0) {
            return ($datos[$mitad - 1] + $datos[$mitad]) / 2;
        }
        return $datos[$mitad];
    }
    public function calcularModa(): string
    {
        if (empty($this->numeros)) {
            return 'N/A';
        }
        $conteo = [];
        foreach ($this->numeros as $num) {
            $clave = (string)$num;
            if (isset($conteo[$clave])) {
                $conteo[$clave]++;
            } else {
                $conteo[$clave] = 1;
            }
        }
        $maxRepeticiones = 0;
        foreach ($conteo as $cant) {
            if ($cant > $maxRepeticiones) {
                $maxRepeticiones = $cant;
            }
        }
        if ($maxRepeticiones === 1 && count($this->numeros) > 1) {
            return 'No hay moda';
        }
        $modas = [];
        foreach ($conteo as $num => $cant) {
            if ($cant === $maxRepeticiones) {
                $modas[] = $num;
            }
        }
        return implode(', ', $modas);
    }
}