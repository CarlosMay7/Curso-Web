<?php

namespace Classes;

class Paginacion {
    public $paginaActual;
    public $registrosPagina;
    public $totalRegistros;

    public function __construct($paginaActual = 1, $registrosPagina = 10, $totalRegistros = 0){
        $this->paginaActual = (int) $paginaActual;
        $this->registrosPagina = (int) $registrosPagina;
        $this->totalRegistros = (int) $totalRegistros;
    }
}