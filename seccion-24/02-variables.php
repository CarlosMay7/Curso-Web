<?php include 'includes/header.php';

//Las variables se crean con $ al principio
$nombre = "Carlos";

var_dump($nombre);

$nombre = "Juan"; //Se pueden reasignar estas variables

//En el caso que se necesite fijar el valor

define('Constante', "Valor de la constante");

echo Constante;

//No tan comú
const constante2 ="Segunda constante";
echo constante2;
include 'includes/footer.php';
