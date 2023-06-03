<?php
namespace Model;

class Propiedad extends ActiveRecord{

    protected static $tabla = "propiedades";
    protected static $columnasDb = ["id","titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamiento", "creado", "vendedores_id"];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    public function __construct($args = []){
        $this->id = $args["id"] ?? null;        
        $this->titulo = $args["titulo"] ?? "";        
        $this->precio = $args["precio"] ?? "";        
        $this->imagen = $args["imagen"] ?? "";        
        $this->descripcion = $args["descripcion"] ?? "";        
        $this->habitaciones = $args["habitaciones"] ?? "";        
        $this->wc = $args["wc"] ?? "";        
        $this->estacionamiento = $args["estacionamiento"] ?? "";        
        $this->creado = date("Y/m/d");        
        $this->vendedores_id = $args["vendedores_id"] ?? "";        
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = "Debe agregar un título";
        }
        if(!$this->precio){
            self::$errores[] = "Debe agregar un precio";
        }
        if(strlen($this->descripcion)<50){
            self::$errores[] = "Debe agregar una descripción de al menos 50 caracteres";
        }
        if(!$this->habitaciones){
            self::$errores[] = "Debe agregar la cantidad de habitaciones";
        }
        if(!$this->wc){
            self::$errores[] = "Debe agregar la cantidad de baños";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "Debe agregar la cantidad de espacio de estacionamiento";
        }
        if(!$this->vendedores_id){
            self::$errores[] = "Debe seleccionar un vendedor";
        }

         if(!$this->imagen){
            self::$errores[] ="Es necesario tener una imagen de la propiedad";
         }

        return self::$errores;
    }
}