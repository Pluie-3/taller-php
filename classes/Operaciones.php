<?php
abstract class Operacion
{
    protected float $a;
    protected float $b;
    public function __construct(float $a, float $b)
    {
        $this->a = $a;
        $this->b = $b;
    }
    abstract public function calcular(): float;
    abstract public function get_simbolo(): string;
    public function describir(): string
    {
        return $this->a . ' ' . $this->get_simbolo() . ' ' . $this->b . ' = ' . round($this->calcular(), 10);
    }
}
class Suma extends Operacion
{
    public function calcular(): float
    {
        return $this->a + $this->b;
    }
    public function get_simbolo(): string
    {
        return '+';
    }
}
class Resta extends Operacion
{
    public function calcular(): float
    {
        return $this->a - $this->b;
    }
    public function get_simbolo(): string
    {
        return '-';
    }
}
class Multiplicacion extends Operacion
{
    public function calcular(): float
    {
        return $this->a * $this->b;
    }
    public function get_simbolo(): string
    {
        return '×';
    }
}
class Division extends Operacion
{
    public function calcular(): float
    {
        if ($this->b == 0) {
            throw new Exception('No se puede dividir entre cero.');
        }
        return $this->a / $this->b;
    }
    public function get_simbolo(): string
    {
        return '÷';
    }
}
class Porcentaje extends Operacion  // "a % de b": calcula el a por ciento de b
{
    public function calcular(): float
    {
        return $this->a * $this->b / 100;
    }
    public function get_simbolo(): string
    {
        return '%';
    }
    public function describir(): string
    {
        return $this->a . '% de ' . $this->b . ' = ' . round($this->calcular(), 10);
    }
}
