<?php
namespace MVC;
class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fun){
        $this->rutasGET[$url] = $fun;
    }

    public function post($url, $fun){
        $this->rutasPOST[$url] = $fun;
    }


    public function comprobarRutas(){

        session_start();

        $auth = $_SESSION["login"] ?? null;
        //Arreglo de rutas protegidas
        $rutasProtegidas = ["/admin", "/propiedades/crear", "/propiedades/actualizar", "/propiedades/eliminar", "/vendedores/crear", "/vendedores/actualizar", "/vendedores/eliminar"];

        $urlActual = $_SERVER["PATH_INFO"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];

        if($metodo === "GET"){
            $fun = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fun = $this->rutasPOST[$urlActual] ?? null;
        }

        //Proteger las rutas

        if(in_array($urlActual, $rutasProtegidas) && !$auth){
            header("Location: /");
        }

        if($fun){
            //Existe la URL y tiene una función asociada

            call_user_func($fun, $this); //Permite llamar a una función de la que no se sabe su nombre
        } else {
            echo "Página no encontrada";
        }
    }

    //Muestra una vista

    public function render($view, $datos = []){

        foreach($datos as $key => $value){
            //Variable de variables
            $$key = $value; //Crea una variable para la variable ya que no tiene o no se sabe la variable cuando se reciben los datos
        }

        ob_start(); //Es para empezar a guardar en memoria
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); //Luego se limpia la memoria

        include __DIR__ . "/views/Layout.php";
    }
}