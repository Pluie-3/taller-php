<?php
// Guarda las operaciones en la sesión (requiere session_start() antes de crear el objeto)
class Historial
{
    private string $clave = 'historial_calculadora';
    public function __construct()
    {
        if (!isset($_SESSION[$this->clave])) {
            $_SESSION[$this->clave] = [];
        }
    }
    public function agregar(string $registro): void
    {
        $_SESSION[$this->clave][] = $registro;
    }
    public function get_registros(): array
    {
        return $_SESSION[$this->clave];
    }
    public function borrar(): void
    {
        $_SESSION[$this->clave] = [];
    }
}
