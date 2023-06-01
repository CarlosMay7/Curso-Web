<?php
namespace MVC;
class Router {

    public $rutasGET = [];
    public $rutaspost = [];

    public function get($url, $fun){
        $this->rutasGET[$url] = $fun;
    }


    public function comprobarRutas(){
        $urlActual = $_SERVER["PATH_INFO"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];

        if($metodo === "GET"){
            $fun = $this->rutasGET[$urlActual] ?? null;
        }

        if($fun){
            //Existe la URL y tiene una función asociada

            call_user_func($fun, $this); //Permite llamar a una función de la que no se sabe su nombre
        } else {
            echo "Página no encontrada";
        }
    }

    //Muestra una vista

    public function render($view){
        include __DIR__ . "/views/$view.php";
    }
}