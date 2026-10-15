<?php
class Nodo
{
    private string $valor;
    private ?Nodo $izquierdo = null;
    private ?Nodo $derecho = null;
    public function __construct(string $valor)
    {
        $this->valor = $valor;
    }
    public function get_valor(): string
    {
        return $this->valor;
    }
    public function get_izquierdo(): ?Nodo
    {
        return $this->izquierdo;
    }
    public function set_izquierdo(?Nodo $nodo): void
    {
        $this->izquierdo = $nodo;
    }
    public function get_derecho(): ?Nodo
    {
        return $this->derecho;
    }
    public function set_derecho(?Nodo $nodo): void
    {
        $this->derecho = $nodo;
    }
}