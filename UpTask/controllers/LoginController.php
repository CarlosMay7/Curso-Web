<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {

    public static function login(Router $router){

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
        }

        $router->render("auth/login", [
            "titulo" => "Iniciar Sesión"
        ]);
    }

    public static function logout(){
        echo "Logout";
    }

    public static function crear(Router $router){

        $usuario = new Usuario;

        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if(empty($alertas)){
                $existeUsuario = Usuario::where("email", $usuario->email);

                if($existeUsuario){
                    Usuario::setAlerta("error", "El usuario ya existe");
                    $alertas = Usuario::getAlertas();
                } else {
                    //Hash password
                    $usuario->hashPassword();

                    //Eliminar password2
                    unset($usuario->password2);

                    //Generar token
                    $usuario->crearToken();

                    //Crear usuario
                    $resultado = $usuario->guardar();

                    //Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    if($resultado){
                        header("Location: /mensaje");
                    }
                }
            }

        }

        $router->render("auth/crear", [
            "titulo" => "Crea tu cuenta",
            "usuario" => $usuario,
            "alertas" => $alertas
        ]);
    }

    public static function olvide(Router $router){

        if($_SERVER["REQUEST_METHOD"] === "POST"){
        }

        $router->render("auth/olvide", [
            "titulo" => "Olvidé mi password"
        ]);
    }

    public static function reestablecer(Router $router){

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            
        }

        $router->render("auth/reestablecer", [
            "titulo" => "Reestablece tu password"
        ]);
    }

    public static function mensaje(Router $router){

        $router->render("auth/mensaje", [
            "titulo" => "Cuenta Creada Exitosamente"
        ]);
    }

    public static function confirmar(Router $router){

        $token = s($_GET["token"]);

        if(!$token){
            header("Location: /");
        }
        //Encontrar al usuario
        $usuario = Usuario::where("token", $token);

        if(empty($usuario)){
            Usuario::setAlerta("error", "Token no válido");
        } else {
            //Confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = "";
            unset($usuario->password2);

            $usuario->guardar();
            Usuario::setAlerta("exito", "¡Cuenta Confirmada!");
        }

        $alertas = Usuario::getAlertas();
        $router->render("auth/confirmar", [
            "titulo" => "Confirma tu cuenta",
            "alertas" => $alertas
        ]);
    }
}