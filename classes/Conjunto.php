<?php
class Conjunto
{
    private array $conjuntoA = [];
    private array $conjuntoB = [];
    public function __construct(string $cadenaA = '', string $cadenaB = '')
    {
        $this->conjuntoA = $this->limpiarYLimpiarDuplicados($cadenaA);
        $this->conjuntoB = $this->limpiarYLimpiarDuplicados($cadenaB);
    }
    private function limpiarYLimpiarDuplicados(string $cadena): array
    {
        $limpio = str_replace(' ', ',', $cadena);
        $elementos = explode(',', $limpio);
        $resultado = [];
        foreach ($elementos as $elem) {
            $elem = trim($elem);
            if ($elem !== '' && !in_array($elem, $resultado)) {
                $resultado[] = $elem;
            }
        }
        return $resultado;
    }
    public function obtenerConjuntoA(): array
    {
        return $this->conjuntoA;
    }
    public function obtenerConjuntoB(): array
    {
        return $this->conjuntoB;
    }
    public function obtenerUnion(): array
    {
        $union = $this->conjuntoA;
        foreach ($this->conjuntoB as $elem) {
            if (!in_array($elem, $union)) {
                $union[] = $elem;
            }
        }
        return $union;
    }
    public function obtenerInterseccion(): array
    {
        $interseccion = [];
        foreach ($this->conjuntoA as $elem) {
            if (in_array($elem, $this->conjuntoB)) {
                $interseccion[] = $elem;
            }
        }
        return $interseccion;
    }
    public function obtenerDiferenciaAB(): array
    {
        $diferencia = [];
        foreach ($this->conjuntoA as $elem) {
            if (!in_array($elem, $this->conjuntoB)) {
                $diferencia[] = $elem;
            }
        }
        return $diferencia;
    }
    public function obtenerDiferenciaBA(): array
    {
        $diferencia = [];
        foreach ($this->conjuntoB as $elem) {
            if (!in_array($elem, $this->conjuntoA)) {
                $diferencia[] = $elem;
            }
        }
        return $diferencia;
    }
}