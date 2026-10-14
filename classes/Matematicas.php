<?php
class Matematicas
{
    const MAX_FIBONACCI = 90;
    const MAX_FACTORIAL = 20;
    private int $numero;
    private string $aviso = '';
    public function __construct(int $numero)
    {
        $this->numero = max(1, $numero);
    }
    public function get_aviso(): string
    {
        return $this->aviso;
    }
    public function get_fibonacci(): array
    {
        $limite = $this->numero;
        if ($limite > self::MAX_FIBONACCI) {
            $limite = self::MAX_FIBONACCI;
            $this->aviso = 'Se muestran solo los primeros ' . self::MAX_FIBONACCI . ' términos.';
        }
        $serie = [];
        $anterior = 0;
        $actual = 1;
        for ($i = 0; $i < $limite; $i++) {
            $serie[] = $anterior;
            $siguiente = $anterior + $actual;
            $anterior = $actual;
            $actual = $siguiente;
        }
        return $serie;
    }
    public function get_factorial(): array
    {
        $limite = $this->numero;
        if ($limite > self::MAX_FACTORIAL) {
            $limite = self::MAX_FACTORIAL;
            $this->aviso = 'Se calcula hasta ' . self::MAX_FACTORIAL . '! porque después el resultado excede el tamaño de un entero.';
        }
        $pasos = [];
        $producto = 1;
        for ($i = 1; $i <= $limite; $i++) {
            $producto = $producto * $i;
            $pasos[] = $i . '! = ' . number_format($producto, 0, '', '.');
        }
        return $pasos;
    }
}