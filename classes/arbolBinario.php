<?php
require_once __DIR__ . '/Nodo.php';
class ArbolBinario
{
    private ?Nodo $raiz = null;
    public function get_raiz(): ?Nodo
    {
        return $this->raiz;
    }
    public function insertar(string $valor): void
    {
        $nuevo = new Nodo($valor);
        if ($this->raiz === null) {
            $this->raiz = $nuevo;
        } else {
            $this->insertarEnNodo($this->raiz, $nuevo);
        }
    }
    private function insertarEnNodo(Nodo $actual, Nodo $nuevo): void
    {
        if ($nuevo->get_valor() < $actual->get_valor()) {
            if ($actual->get_izquierdo() === null) {
                $actual->set_izquierdo($nuevo);
            } else {
                $this->insertarEnNodo($actual->get_izquierdo(), $nuevo);
            }
        } else {
            if ($actual->get_derecho() === null) {
                $actual->set_derecho($nuevo);
            } else {
                $this->insertarEnNodo($actual->get_derecho(), $nuevo);
            }
        }
    }
    public function preorden(?Nodo $nodo = null, array &$salida = []): array
    {
        if ($nodo === null && empty($salida)) {
            $nodo = $this->raiz;
        }
        if ($nodo !== null) {
            $salida[] = $nodo->get_valor();
            if ($nodo->get_izquierdo()) {
                $this->preorden($nodo->get_izquierdo(), $salida);
            }
            if ($nodo->get_derecho()) {
                $this->preorden($nodo->get_derecho(), $salida);
            }
        }
        return $salida;
    }
    public function inorden(?Nodo $nodo = null, array &$salida = []): array
    {
        if ($nodo === null && empty($salida)) {
            $nodo = $this->raiz;
        }
        if ($nodo !== null) {
            if ($nodo->get_izquierdo()) {
                $this->inorden($nodo->get_izquierdo(), $salida);
            }
            $salida[] = $nodo->get_valor();
            if ($nodo->get_derecho()) {
                $this->inorden($nodo->get_derecho(), $salida);
            }
        }
        return $salida;
    }
    public function postorden(?Nodo $nodo = null, array &$salida = []): array
    {
        if ($nodo === null && empty($salida)) {
            $nodo = $this->raiz;
        }
        if ($nodo !== null) {
            if ($nodo->get_izquierdo()) {
                $this->postorden($nodo->get_izquierdo(), $salida);
            }
            if ($nodo->get_derecho()) {
                $this->postorden($nodo->get_derecho(), $salida);
            }
            $salida[] = $nodo->get_valor();
        }
        return $salida;
    }
    public function dibujarOrganigrama(?Nodo $nodo = null): string
    {
        if ($nodo === null) {
            $nodo = $this->raiz;
        }
        if ($nodo === null) {
            return '';
        }
        $html = "<div class='organigrama-nodo'>";
        $html .= "<div class='caja-valor'>" . htmlspecialchars($nodo->get_valor()) . "</div>";
        if ($nodo->get_izquierdo() !== null || $nodo->get_derecho() !== null) {
            $html .= "<div class='organigrama-hijos'>";
            // Rama Izquierda
            $html .= "<div class='rama-columna'>";
            $html .= "<span class='rama-tag'>Izq</span>";
            if ($nodo->get_izquierdo() !== null) {
                $html .= $this->dibujarOrganigrama($nodo->get_izquierdo());
            } else {
                $html .= "<div class='caja-vacia'>—</div>";
            }
            $html .= "</div>";
            // Rama Derecha
            $html .= "<div class='rama-columna'>";
            $html .= "<span class='rama-tag'>Der</span>";
            if ($nodo->get_derecho() !== null) {
                $html .= $this->dibujarOrganigrama($nodo->get_derecho());
            } else {
                $html .= "<div class='caja-vacia'>—</div>";
            }
            $html .= "</div>";
            $html .= "</div>";
        }
        $html .= "</div>";
        return $html;
    }
}
