<?php include 'includes/header.php';

//Buscar elementos en un arreglo

$carrito = ["Tablet", "Television", "Computadora"];

var_dump(in_array("Tablet", $carrito));

//Ordenar elementos en un arreglo indexado

$numeros = [1,5,8,4,23];
sort($numeros); //Menor a mayor
rsort($numeros); //Mayor a menor

echo "<pre>";
var_dump($numeros);
echo "</pre";

//Ordenar elementos en arreglo asociativo

$cliente = [
    "saldo" =>200,
    "tipo" => "Premium",
    "nombre" => "Carlos"
];

asort($cliente); //Ordena por valores (Orden alfabetico)
arsort($cliente); //Ordena por valores en orden alfabético al revés
ksort($cliente); //Ordena por llaves (Orden alfabetico) 
krsort($cliente); //Ordena llaves orden alfabético al revés

echo "<pre>";
var_dump($cliente);
echo "</pre";

include 'includes/footer.php';