<?php

class Acronimo
{
    private string $cadena;
    public function __construct(string $cadena = '')
    {
        $this->cadena = $cadena;
    }
    public function convertir(): string
    {
        $texto = trim($this->cadena);
        if ($texto === '') {
            return '';
        }
        $limpio = str_replace('-', ' ', $texto);
        $textoLimpio = preg_replace('/[^\w\s]/u', '', $limpio);
        $palabras = explode(' ', $textoLimpio);
        $acronimo = '';
        foreach ($palabras as $palabra) {
            $palabra = trim($palabra);
            if ($palabra !== '') {
                $acronimo .= mb_strtoupper(mb_substr($palabra, 0, 1));
            }
        }
        return $acronimo;
    }
}
