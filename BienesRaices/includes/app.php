<?php
require "funciones.php";
require "config/database.php";
require __DIR__ . "/../vendor/autoload.php";

//Conectar a db

$db = conectarDB();

use App\Propiedad;

Propiedad::setDb($db);
