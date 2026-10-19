<?php
require_once __DIR__ . '/Nodo.php';

class ArbolBinario
{
    private ?Nodo $raiz = null;
    private array $errores = [];
    private string $metodo = '';
    private bool $inconsistente = false;
    public function __construct(string $preorden = '', string $inorden = '', string $postorden = '')
    {
        $pre = $this->separar($preorden);
        $in = $this->separar($inorden);
        $post = $this->separar($postorden);
        // Si llegan los tres recorridos se usa preorden - inorden
        if (count($pre) > 0 && count($in) > 0) {
            $this->metodo = 'preorden - inorden';
            $this->armar($pre, $in, 'pre_in');
        } elseif (count($pre) > 0 && count($post) > 0) {
            $this->metodo = 'preorden - postorden';
            $this->armar($pre, $post, 'pre_post');
        } elseif (count($in) > 0 && count($post) > 0) {
            $this->metodo = 'inorden - postorden';
            $this->armar($in, $post, 'in_post');
        } else {
            $this->errores[] = 'Debes ingresar mínimo dos recorridos.';
        }
    }
    public function get_raiz(): ?Nodo
    {
        return $this->raiz;
    }
    public function get_errores(): array
    {
        return $this->errores;
    }
    public function get_metodo(): string
    {
        return $this->metodo;
    }
    // Acepta "A B C", "A,B,C" o "A → B → C" (también con "->")
    private function separar(string $texto): array
    {
        return preg_split('/\s*(?:→|->|,|;)\s*|\s+/u', trim($texto), -1, PREG_SPLIT_NO_EMPTY);
    }
    // Valida las dos listas, arma el árbol y comprueba que reproduzca los recorridos ingresados
    private function armar(array $primero, array $segundo, string $tipo): void
    {
        if (count($primero) !== count($segundo)) {
            $this->errores[] = 'Los dos recorridos deben tener la misma cantidad de nodos.';
            return;
        }
        if (count(array_unique($primero)) !== count($primero)) {
            $this->errores[] = 'Los nodos no pueden repetirse dentro de un recorrido.';
            return;
        }
        if (count(array_diff($primero, $segundo)) > 0 || count(array_diff($segundo, $primero)) > 0) {
            $this->errores[] = 'Los dos recorridos deben contener los mismos nodos.';
            return;
        }
        switch ($tipo) {
            case 'pre_in':
                $raiz = $this->construir_pre_in($primero, $segundo);
                break;
            case 'pre_post':
                $raiz = $this->construir_pre_post($primero, $segundo);
                break;
            default:
                $raiz = $this->construir_in_post($primero, $segundo);
                break;
        }
        if ($this->inconsistente || $raiz === null) {
            $this->errores[] = 'Los recorridos no corresponden a un mismo árbol binario.';
            return;
        }
        $this->raiz = $raiz;
        if ($tipo === 'pre_in') {
            $ok = $this->preorden() === $primero && $this->inorden() === $segundo;
        } elseif ($tipo === 'pre_post') {
            $ok = $this->preorden() === $primero && $this->postorden() === $segundo;
        } else {
            $ok = $this->inorden() === $primero && $this->postorden() === $segundo;
        }
        if (!$ok) {
            $this->raiz = null;
            $this->errores[] = 'Los recorridos no corresponden a un mismo árbol binario.';
        }
    }
    private function construir_pre_in(array $pre, array $in): ?Nodo // La raíz es el primero del preorden; su posición en el inorden separa izquierda y derecha
    {
        if (count($pre) === 0) {
            return null;
        }
        $pos = array_search($pre[0], $in, true);
        if ($pos === false) {
            $this->inconsistente = true;
            return null;
        }
        $nodo = new Nodo($pre[0]);
        $nodo->set_izquierdo($this->construir_pre_in(array_slice($pre, 1, $pos), array_slice($in, 0, $pos)));
        $nodo->set_derecho($this->construir_pre_in(array_slice($pre, $pos + 1), array_slice($in, $pos + 1)));
        return $nodo;
    }
    private function construir_in_post(array $in, array $post): ?Nodo // La raíz es el último del postorden
    {
        if (count($post) === 0) {
            return null;
        }
        $raiz = $post[count($post) - 1];
        $pos = array_search($raiz, $in, true);
        if ($pos === false) {
            $this->inconsistente = true;
            return null;
        }
        $nodo = new Nodo($raiz);
        $nodo->set_izquierdo($this->construir_in_post(array_slice($in, 0, $pos), array_slice($post, 0, $pos)));
        $nodo->set_derecho($this->construir_in_post(array_slice($in, $pos + 1), array_slice($post, $pos, count($post) - $pos - 1)));
        return $nodo;
    }
    private function construir_pre_post(array $pre, array $post): ?Nodo // Con preorden y postorden el árbol puede no ser único: un hijo único se toma como izquierdo
    {
        if (count($pre) === 0) {
            return null;
        }
        $nodo = new Nodo($pre[0]);
        if (count($pre) === 1) {
            return $nodo;
        }
        $pos = array_search($pre[1], $post, true);
        if ($pos === false) {
            $this->inconsistente = true;
            return null;
        }
        $tamano = $pos + 1;
        $nodo->set_izquierdo($this->construir_pre_post(array_slice($pre, 1, $tamano), array_slice($post, 0, $tamano)));
        $nodo->set_derecho($this->construir_pre_post(array_slice($pre, 1 + $tamano), array_slice($post, $tamano, count($pre) - 1 - $tamano)));
        return $nodo;
    }
    public function preorden(): array
    {
        $salida = [];
        $this->recorrer_pre($this->raiz, $salida);
        return $salida;
    }
    public function inorden(): array
    {
        $salida = [];
        $this->recorrer_in($this->raiz, $salida);
        return $salida;
    }
    public function postorden(): array
    {
        $salida = [];
        $this->recorrer_post($this->raiz, $salida);
        return $salida;
    }
    private function recorrer_pre(?Nodo $nodo, array &$salida): void
    {
        if ($nodo === null) {
            return;
        }
        $salida[] = $nodo->get_valor();
        $this->recorrer_pre($nodo->get_izquierdo(), $salida);
        $this->recorrer_pre($nodo->get_derecho(), $salida);
    }
    private function recorrer_in(?Nodo $nodo, array &$salida): void
    {
        if ($nodo === null) {
            return;
        }
        $this->recorrer_in($nodo->get_izquierdo(), $salida);
        $salida[] = $nodo->get_valor();
        $this->recorrer_in($nodo->get_derecho(), $salida);
    }
    private function recorrer_post(?Nodo $nodo, array &$salida): void
    {
        if ($nodo === null) {
            return;
        }
        $this->recorrer_post($nodo->get_izquierdo(), $salida);
        $this->recorrer_post($nodo->get_derecho(), $salida);
        $salida[] = $nodo->get_valor();
    }
    public function dibujarOrganigrama(?Nodo $nodo = null): string // Dibuja el árbol como organigrama HTML (los estilos están en css/tarjetas.css)
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
            $html .= $this->dibujarRama('Izq', $nodo->get_izquierdo());
            $html .= $this->dibujarRama('Der', $nodo->get_derecho());
            $html .= "</div>";
        }
        $html .= "</div>";
        return $html;
    }
    private function dibujarRama(string $etiqueta, ?Nodo $hijo): string // Una rama = etiqueta + subárbol (o una caja vacía si no hay hijo)
    {
        $html = "<div class='rama-columna'>";
        $html .= "<span class='rama-tag'>" . $etiqueta . "</span>";
        if ($hijo !== null) {
            $html .= $this->dibujarOrganigrama($hijo);
        } else {
            $html .= "<div class='caja-vacia'>—</div>";
        }
        $html .= "</div>";
        return $html;
    }
}
