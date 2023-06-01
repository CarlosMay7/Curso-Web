<?php

namespace Model;

class ActiveRecord{

    //Base de datos 
    protected static $db;
    //Mapear los atributos del objeto
    protected static $columnasDb = [];

    protected static $tabla = "";
    //Errores

    protected static $errores = [];



    //Definir la conexion a la DB

    public static function setDb ($db) {
        self::$db = $db;
    }

    public function guardar(){
        if (!is_null($this->id)){
            //Revisa si hay un id para actualizar 
            $this->actualizar();
        } else {
            //Si no hay, entonces crea
            $this->crear();
        }
    }

    public function crear(){

        //Sanitizar la entrada de datos
        $atributos = $this->sanitizarDatos(); 

        $arregloKeys = array_keys($atributos); //Hace un arreglo con el nombre de las propiedades en el arreglo

        $arregloValues = array_values($atributos); //Hace un arreglo con los valores de un arreglo

        join(", ",$arregloKeys); //Une en un string el contenido del arreglo con el separador que se coloque

        $query = "INSERT INTO " . static::$tabla . " (";

        $query .= join (", ", $arregloKeys);

        $query .= " ) VALUES (' ";

        $query .= join ("', '", $arregloValues);

        $query .= " ');";

        $ok = self::$db->query($query);

        if($ok){
            //Redireccionar al usuario para que no sigan insertanto la misma propiedad
            header("Location: /admin?resultado=1 & ok = ok"); //Lleva al usuario a la direccion colocada, además que se tiene el query string donde se crean variables y se asignan valores que pueden ser leidos de la url
        }     }

    public function actualizar(){
        $atributos = $this->sanitizarDatos(); 

        $valores = [];

        foreach($atributos as $key => $value){
            $valores[] = "$key='$value'";
        }
            
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(", ",$valores); 
        $query .= " WHERE id= '" . self::$db->escape_string( $this->id) ."' ";
        $query .= " LIMIT 1 ";

        $ok = self::$db->query($query);

        if($ok){
            //Redireccionar al usuario para que no sigan insertanto la misma propiedad
            header("location: /admin?resultado=2 & ok = ok"); //Lleva al usuario a la direccion colocada, además que se tiene el query string donde se crean variables y se asignan valores que pueden ser leidos de la url
        } 
    }

    public function eliminar(){
        $query = "DELETE FROM " . static::$tabla . " WHERE id= " . self::$db->escape_string($this->id) . " LIMIT 1";
        
        $ok = self::$db->query($query);

        if($ok){
            $this->borrarImagen();
            header("LOCATION: /admin?resultado=3");
        }
    }

    //Identifica y une los atributos de db 
    public function atributos(){
        $atributos = [];

        foreach(static::$columnasDb as $columna){
            if($columna === "id") continue;
            $atributos [$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function setImagen ($image){
        //Eliminar si hay una imagen previa
        if ( !is_null( $this->id)){
            $this->borrarImagen();
        }
        if ($image){
            $this->imagen = $image;
        }
    }

    public function borrarImagen(){

        //Comprobando si existe el archivo
        $existe = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existe){
            unlink(CARPETA_IMAGENES . $this->imagen);
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

    public function validar(){
        static $errores = [];
         
    }

    public static function getErrores(){
        return static::$errores;
    }

    //Listar propiedades 
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla; //El static, en este caso, busca a partir de la clase heredada el atributo deseado

        $resultado = self::consultarSql($query);

        return $resultado;
    }

    //Obtener n registros

    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad; 
        $resultado = self::consultarSql($query);

        return $resultado;
    }

    //Busca propiedad por id
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id=$id";

        $resultado = self::consultarSql($query);

        return array_shift($resultado);
    }

    public static function consultarSql($query){
        //Consultar la base de datos
        $resultado = self::$db->query($query);
        //Iterar en los resultados
        $array = [];

        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }
        //Liberar la memoria
        $resultado->free();
        //Retornar resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static; //Crea un nuevo objeto de la clase heredada

        foreach ($registro as $key => $value){
            if (property_exists( $objeto, $key)){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    //Sincronizar los datos ingresados con la memoria

    public function sincronizar ($args = []){
        foreach($args as $key =>$value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}