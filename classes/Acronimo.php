<?php
class Acronimo
{
    private string $frase;
    public function __construct(string $frase = '')
    {
        $this->frase = $frase;
    }
    public function get_frase(): string
    {
        return $this->frase;
    }
    public function get_acronimo(): string
    {
        $texto = preg_replace('/[\s-]+/u', ' ', $this->frase);// 1. Guiones y espacios
        $texto = preg_replace('/[^\p{L}\p{N} ]/u', '', $texto);// 2.eliminacion de cualquier signo que no sea letra, número o espacio
        $palabras = preg_split('/ /', trim($texto), -1, PREG_SPLIT_NO_EMPTY);// 3. Se separa en palabras y se toma la primera letra de cada una
        $acronimo = '';
        foreach ($palabras as $palabra) {
            $acronimo .= mb_strtoupper(mb_substr($palabra, 0, 1));
        }
        return $acronimo;
    }
}
