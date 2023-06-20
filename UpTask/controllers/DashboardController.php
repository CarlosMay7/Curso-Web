<?php

namespace Controllers;

use Model\Proyecto;
use MVC\Router;

class DashboardController {
    public static function index(Router $router){
        session_start();

        isAuth();

        $router->render("dashboard/index", [
            "titulo" => "Proyectos"
        ]);
    }

    public static function crearProyecto(Router $router){
        session_start();

        isAuth();

        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $proyecto = new Proyecto($_POST);

            //Validar
            $alertas = $proyecto->validarProyecto();

            if(empty($alertas)){
                //Generar url
                $hash = md5(uniqid());
                $proyecto->url = $hash;

                //Almacenar creador de proyecto
                $proyecto->propietarioid = $_SESSION["id"];

                //Guardar proyecto
                $proyecto->guardar();
                Proyecto::setAlerta("exito", "Proyecto Guardado");

                //Redireccionar

                // header("Location: /proyecto?id=" . $proyecto->url);
            }
        }

        $alertas = Proyecto::getAlertas();
        $router->render("dashboard/crear-proyecto", [
            "titulo" => "Crear Proyecto",
            "alertas" => $alertas
        ]);
    }

    public static function perfil(Router $router){
        session_start();

        $router->render("dashboard/perfil", [
            "titulo" => "Perfil"
        ]);
    }
}