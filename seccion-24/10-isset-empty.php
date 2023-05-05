<?php include 'includes/header.php';


$clientes = [];
$clientes2 = array();
$clientes3 = array("Pedro", "Juan","Karen"); 
$cliente = [
    "nombre" => "Carlos",
    "apellido" => "May"
];

//Empty - Checa si está vacío
var_dump(empty($clientes));
echo "<br>";
var_dump(empty($clientes3));
echo "<br>";

//IsSet - Checa si un arreglo está creado o una propiedad definida

var_dump(isset($clientes4));
echo "<br>";
var_dump(isset($clientes2));
echo "<br>";
var_dump(isset($clientes2));
echo "<br>";

//Propiedad
var_dump(isset($cliente["nombre"]));
echo "<br>";
var_dump(isset($clientes[1]));




include 'includes/footer.php';