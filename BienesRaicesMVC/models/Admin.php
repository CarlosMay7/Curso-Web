<?php

namespace Model;

class Admin extends ActiveRecord {
    //Base de datos 
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "email", "password"];

    public $id;
    public $email;
    public $password;

    public function __construct($args = []){
        $this->id = $args["id"] ?? null;
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
    }

    public function validar(){
        if(!$this->email){
            self::$errores[] = "Debe agregar un E-mail";
        }
        if(!$this->password){
            self::$errores[] = "Debe agregar una contraseña";
        }

        return self::$errores;
    }

    public function existe(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";


        $resultado = self::$db->query($query);

        if(!$resultado->num_rows){
            self::$errores[] = "El usuario no existe";
            return;
        }

        return $resultado;
    }

    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object();

        $auth = password_verify($this->password, $usuario->password);

        if(!$auth){
            self::$errores[] = "Contraseña Incorrecta";
        }
        return $auth;
    }

    public function autenticar(){
        session_start();

        //Llenar el arreglo de sesion
        $_SESSION["usuario"] = $this->email;
        $_SESSION["login"] = true;

        header("Location: /admin");
    }
}