<?php

namespace Controllers;

use Model\Proyecto;
use MVC\Router;

class DashboardController {
    public static function index(Router $router){
        session_start();
        isAuth();

        $id = $_SESSION["id"];

        $proyectos = Proyecto::belongsTo("propietarioid", $id);

        $router->render("dashboard/index", [
            "titulo" => "Proyectos",
            "proyectos" => $proyectos
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

                header("Location: /proyecto?id=" . $proyecto->url);
            }
        }

        $alertas = Proyecto::getAlertas();
        $router->render("dashboard/crear-proyecto", [
            "titulo" => "Crear Proyecto",
            "alertas" => $alertas
        ]);
    }

    public static function proyecto(Router $router){
        session_start();
        isAuth();
        $alertas = [];

        //Validar que la persona que quiere ver el proyecto es quien la creo
        $token = $_GET["id"];
        if(!$token){
            header("Location: /dashboard");
        }

        $proyecto = Proyecto::where("url", $token);
        if($proyecto->propietarioid !== $_SESSION["id"]){
            header("Location: /dashboard");
        }
        $router->render("dashboard/proyecto", [
            "titulo" => $proyecto->proyecto,
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