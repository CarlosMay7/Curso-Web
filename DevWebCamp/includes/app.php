<?php 
require __DIR__ . '/../vendor/autoload.php';

// Añadir Dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../"); //Los archivos .env deben estar en la raiz del proyecto
$dotenv->safeLoad();

require 'funciones.php';
require 'database.php';

// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);