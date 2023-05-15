<?php
namespace App;

class Propiedad {

    //Base de datos 
    protected static $db;
    //Mapear los atributos del objeto
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
        $this->id = $args["id"] ?? "";        
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

    //Definir la conexion a la DB

    public static function setDb ($db) {
        self::$db = $db;
    }

    public function guardar(){

        //Sanitizar la entrada de datos
        $atributos = $this->sanitizarDatos(); 

        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) VALUES ('$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion', '$this->habitaciones', '$this->wc', '$this->estacionamiento', '$this->creado', '$this->vendedores_id' );";

        $resultado = self::$db->query($query);
    }

    //Identifica y une los atributos de db 
    public function atributos(){
        $atributos = [];

        foreach(self::$columnasDb as $columna){
            if($columna === "id") continue;
            $atributos [$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key =>$value){
            $sanitizado[$key] = self::$db -> escape_string($value); //Es como mysqli_real_escape_string de funciones peroen objetos
        }

        return $sanitizado;
    }
}