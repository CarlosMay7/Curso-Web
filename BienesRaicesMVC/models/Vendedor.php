<?php

namespace Model;

class Vendedor extends ActiveRecord {
    protected static $tabla = "vendedores";
    protected static $columnasDb = ["id", "nombre", "apellido", "telefono"];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = []){
        $this->id = $args["id"] ?? null;        
        $this->nombre = $args["nombre"] ?? "";        
        $this->apellido = $args["apellido"] ?? "";        
        $this->telefono = $args["telefono"] ?? "";        
     
    }

    public function validar(){
        if(!$this->nombre){
            self::$errores[] = "Debe agregar un nombre";
        }
        if(!$this->apellido){
            self::$errores[] = "Debe agregar un apellido";
        }
        if(!$this->telefono){
            self::$errores[] = "Debe agregar un teléfono";
        }

        if(!preg_match("/[0-9]{10}/", $this->telefono)) {
            self::$errores[] = "Formato inválido";
        }

        return self::$errores;
    }

}