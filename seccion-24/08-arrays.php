<?php include 'includes/header.php';

//Arreglos indexados

$carrito = ["Tablet", "Television", "Computadora"];

$carrito2 = array();

$carrito3 = array("Cosa1", "Cosa2","Cosa3");

//Ver contenido de un array
echo "<pre>"; //Se usa para desglozar mejor el contenido del var dump
var_dump($carrito);
echo "</pre";

//acceder a un elemento del array
echo $carrito[1]; 

//Agregar elementos a un array en posición especifica
$carrito[4] = "Otro elemento";

//Agregar al final
array_push($carrito,"Audifonos");
//Agregar al inicio
array_unshift($carrito, "Reloj");



include 'includes/footer.php';