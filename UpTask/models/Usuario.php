<?php

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = "usuarios";
    protected static $columnasDB = ["id", "nombre", "email", "password", "token", "confirmado"];

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $password2;
    public $password_actual;
    public $password_nuevo;
    public $token;
    public $confirmado;
    
    public function __construct($args= []) {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
        $this->password2 = $args["password2"] ?? "";
        $this->password_actual = $args["password_actual"] ?? "";
        $this->password_nuevo = $args["password_nuevo"] ?? "";
        $this->token = $args["token"] ?? "";
        $this->confirmado = $args["confirmado"] ?? 0;
    }

    public function validarLogin(){
        if(!$this->email){
            self::$alertas["error"][] = "El E-mail es obligatorio";
        }
        if(!$this->password){
            self::$alertas["error"][] = "El password es obligatorio";
        }

        return self::$alertas;

    }

    //Validación cuentas nuevas
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas["error"][] = "El nombre es obligatorio";
        }
        if(!$this->email){
            self::$alertas["error"][] = "El E-mail es obligatorio";
        }
        if(!$this->password){
            self::$alertas["error"][] = "El password es obligatorio";
        }
        if(strlen($this->password)<6){
            self::$alertas["error"][] = "El password debe tener al menos 6 caracteres";
        }
        if($this->password !== $this->password2){
            self::$alertas["error"][] ="Los passwords son diferentes";
        }

        return self::$alertas;
    }

    public function validarEmail(){
        if(!$this->email){
            self::$alertas["error"][] = "El E-mail es obligatorio";
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas["error"][] = "E-mail no válido";
        }

        return self::$alertas;
    }

    public function validarPassword(){
        if(!$this->password){
            self::$alertas["error"][] = "El password es obligatorio";
        }
        if(strlen($this->password)<6){
            self::$alertas["error"][] = "El password debe tener al menos 6 caracteres";
        }

        return self::$alertas;
    }

    public function validarPerfil(){
        if(!$this->nombre){
            self::$alertas["error"][] = "El nombre es obligatorio";
        }
        if(!$this->email){
            self::$alertas["error"][] = "El E-mail es obligatorio";
        }

        return self::$alertas;
    }

    public function nuevoPassword(){
        if(!$this->password_actual){
            self::$alertas["error"][] = "El password actual no puede ir vacío";
        }

        if(!$this->password_nuevo){
            self::$alertas["error"][] = "El password nuevo no puede ir vacío";
        }
        if(strlen($this->password_nuevo)<6){
            self::$alertas["error"][] = "El password debe tener al menos 6 caracteres";
        }

        return self::$alertas;
    }

    public function comprobarPassword(){
        return password_verify($this->password_actual, $this->password);
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = uniqid();
    }
}