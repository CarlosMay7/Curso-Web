<?php

function conectarDB() : mysqli{
    $db = mysqli_connect("localhost", "root", "root", "bienesraices_crud");
    mysqli_set_charset($db, "utf8");

    if(!$db){
        echo "Error! Conexión fallida";
        exit;
    }

    return $db;
}
