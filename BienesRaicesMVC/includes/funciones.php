<?php

define("TEMPLATES_URL", __DIR__ . "/templates");
define("FUNCIONES_URL", __DIR__ . "funciones.php");
define("CARPETA_IMAGENES", $_SERVER["DOCUMENT_ROOT"] . "/imagenes/");

function incluirTemplate(string $template, bool $inicio=false){
    include TEMPLATES_URL . "/{$template}.php";
}

function autenticado() {
    session_start();

    if (!$_SESSION["login"]){
        header("Location : /");
    }
}

function debug($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapar o sanitizar HTML

function s($html) : string{
    $s = htmlspecialchars($html);
    return $s;
}

//Validar tipo de contenido

function validarContenido($tipo){
    $tipos = ["propiedad", "vendedor"];

    return in_array($tipo, $tipos);
}

//Muestra mensajes

function mostrarNoti($codigo){
    $mensaje = "";

    switch ($codigo){
        case 1:
            $mensaje = "Resgistrado Correctamente";
            break;
        case 2:
            $mensaje = "Actualizado Correctamente";
            break;
        case 3:
            $mensaje = "Eliminado Correctamente";
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}

function validarRedirec (string $url){
    //Validar url con id
    $id = $_GET["id"];

    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: $url");
    }

    return $id;
}