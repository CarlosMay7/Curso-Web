<?php

define("TEMPLATES_URL", __DIR__ . "/templates");
define("FUNCIONES_URL", __DIR__ . "funciones.php");

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