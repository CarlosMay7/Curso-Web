<?php

namespace Controllers;

use Model\Proyecto;
use Model\Usuario;
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
        isAuth();

        $alertas = [];

        $usuario = Usuario::find($_SESSION["id"]);

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $usuario->sincronizar($_POST);

            $alertas = $usuario->validarPerfil();

            if(empty($alertas)){

                //Verificar que el email no exista
                $existeUsuario = Usuario::where("email", $usuario->email);

                if($existeUsuario && $existeUsuario->id !== $usuario->id){
                    //Mostrar mensaje de error
                    Usuario::setAlerta("error", "E-Mail no válido");
                } else {
                    //Guardar
                    $usuario->guardar();
                    Usuario::setAlerta("exito", "Guardado Correctamente");
                    $alertas = Usuario::getAlertas();
    
                    $_SESSION["nombre"] = $usuario->nombre;
                }
            }
        }

        $router->render("dashboard/perfil", [
            "titulo" => "Perfil",
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }

    public static function cambiarPassword(Router $router){
        session_start();
        isAuth();

        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $usuario = Usuario::find($_SESSION["id"]);
            $usuario->sincronizar($_POST);

            $alertas = $usuario->nuevoPassword();

            if(empty($alertas)){
                $resultado = $usuario->comprobarPassword();
                if($resultado){
                    $usuario->password = $usuario->password_nuevo;

                    //Eliminar datos de apoyo
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);

                    //Hashear nuevo password
                    $usuario->hashPassword();

                    //Actualizar
                    $resultado = $usuario->guardar();

                    if($resultado){
                        Usuario::setAlerta("exito", "Password Guardado Correctamente");
                        $alertas = Usuario::getAlertas();
                    }
                } else {
                    Usuario::setAlerta("error", "Password Incorrecto");
                    $alertas = Usuario::getAlertas();
                }
            }
        }

        $router->render("dashboard/cambiar-password", [
            "titulo" => "Cambiar Password",
            "alertas" => $alertas
        ]);
    }
}