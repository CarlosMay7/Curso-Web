<?php
namespace App;

class Propiedad {

    //Base de datos 
    protected static $db;
    //Mapear los atributos del objeto
    protected static $columnasDb = ["id","titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamiento", "creado", "vendedores_id"];

    //Errores

    protected static $errores = [];
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
        $this->vendedores_id = $args["vendedores_id"] ?? 1;        
    }

    //Definir la conexion a la DB

    public static function setDb ($db) {
        self::$db = $db;
    }

    public function guardar(){

        //Sanitizar la entrada de datos
        $atributos = $this->sanitizarDatos(); 

        $arregloKeys = array_keys($atributos); //Hace un arreglo con el nombre de las propiedades en el arreglo

        $arregloValues = array_values($atributos); //Hace un arreglo con los valores de un arreglo

        join(", ",$arregloKeys); //Une en un string el contenido del arreglo con el separador que se coloque

        $query = "INSERT INTO propiedades (";

        $query .= join (", ", $arregloKeys);

        $query .= " ) VALUES (' ";

        $query .= join ("', '", $arregloValues);

        $query .= " ');";

        $resultado = self::$db->query($query);

        return $resultado;
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

    public function setImagen ($image){
        if ($image){
            $this->imagen = $image;
        }
    }

    public function sanitizarDatos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key =>$value){
            $sanitizado[$key] = self::$db -> escape_string($value); //Es como mysqli_real_escape_string de funciones peroen objetos
        }

        return $sanitizado;
    }

    //Validación

    public static function getErrores(){
        return self::$errores;
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

    //Listar propiedades 
    public static function all(){
        $query = "SELECT * FROM propiedades";

        $resultado = self::consultarSql($query);

        return $resultado;
    }

    public static function consultarSql($query){
        //Consultar la base de datos
        $resultado = self::$db->query($query);
        //Iterar en los resultados
        $array = [];

        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjeto($registro);
        }
        //Liberar la memoria
        $resultado->free();
        //Retornar resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new self; //Crea un nuevo objeto de la clase padre

        foreach ($registro as $key => $value){
            if (property_exists( $objeto, $key)){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }
}