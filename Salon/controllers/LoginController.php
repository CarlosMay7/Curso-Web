<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router){

        $alertas = [];
        $auth = new Usuario;
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $auth = new Usuario($_POST);

            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                //Comprobar que existe el usuario
                $usuario = Usuario::where("email", $auth->email);

                if($usuario){
                    //Checar password
                    if($usuario->comprobarPasswordVerificado($auth->password)){
                        //Autenticar
                        $_SESSION["id"] = $usuario->id;
                        $_SESSION["nombre"] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION["email"] = $usuario->email;
                        $_SESSION["login"] = true;

                        //Redireccion
                        if($usuario->admin === "1"){
                            $_SESSION["admin"] = $usuario->admin ?? null;

                            header("Location: /admin");
                        } else {
                            header("Location: /cita");
                        }
                    }
                } else {
                    Usuario::setAlerta("error", "El usuario no existe");
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render("auth/login", [
            "alertas" => $alertas,
            "auth" => $auth
        ] );
    }

    public static function logout(){

        $_SESSION = [];

        header("Location: /");
    }

    public static function olvide(Router $router){

        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)){
                $usuario = Usuario::where("email", $auth->email);

                if($usuario && $usuario->confirmado === "1"){
                    //Generar token
                    $usuario->crearToken();
                    $usuario->guardar();

                    //Enviar email

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    Usuario::setAlerta("exito", "Revisa tu E-mail");
                    $alertas = Usuario::getAlertas();
                } else {
                    Usuario::setAlerta("error", "Usuario no existe o no confirmado");
                    $alertas = Usuario::getAlertas();
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render("auth/olvide-password", [
            "alertas" => $alertas
        ]);
    }

    public static function recuperar(Router $router){

        $alertas = [];
        $error = false;

        $token = s($_GET["token"]);
        
        //Buscar usuario
        $usuario = Usuario::where("token", $token);

        if(empty($usuario)){
            Usuario::setAlerta("error", "Token no válido");
            $error = true;
        }

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if(empty($alertas)){
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = "";
                $resultado = $usuario->guardar();

                if($resultado){
                    header("Location: /");
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render("auth/recuperar-password", [
            "alertas" => $alertas,
            "error" => $error
        ]);
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