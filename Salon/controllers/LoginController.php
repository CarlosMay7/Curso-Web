<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router){
        $router->render("auth/login", [] );
    }

    public static function logout(){
        echo "Logout";
    }

    public static function olvide(Router $router){

        $router->render("auth/olvide-password", [

        ]);
    }

    public static function recuperar(){
        echo "Recuperar";
    }

    public static function crear(Router $router){
        $usuario = new Usuario;

        //Alertas
        $alertas = [];
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar que alertas esté vacío
            if(empty($alertas)){
                //Verificar si el usuario esta registrado
                $resultado = $usuario-> existeUsuario();

                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                } else {
                    //Hash password
                    $usuario->hashPassword();

                    //Generar token
                    $usuario-> crearToken();

                    //Enviar email de confirmacion
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    $email->enviarConfirmacion();

                    //Crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header("Location: /mensaje");
                    }
                }

            }
        }

        $router->render("auth/crear-cuenta", [
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }

    public static function mensaje(Router $router){
        $router->render("auth/mensaje");
    }

    public static function confirmar(Router $router){
        $alertas = [];

        $token = s($_GET["token"]);

        $usuario = Usuario::where("token", $token);

        if(empty($usuario)){
            //Mostrar mensaje error
            Usuario::setAlerta("error", "Token No Válido");
        } else {
            //Modificar a confirmado
            $usuario->confirmado = "1";
            $usuario->token = "";
            $usuario->guardar();
            Usuario::setAlerta("exito", "¡Cuenta Confirmada!");
        }

        $alertas = Usuario::getAlertas();
        $router->render("auth/confirmar-cuenta", [
            "alertas" => $alertas
        ]);
    }
}