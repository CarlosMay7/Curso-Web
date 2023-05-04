<?php include 'includes/header.php';

//Arreglos asociativos
//Es como un objeto
$cliente = [
    "nombre" => "Juan",
    "saldo" => 200,
    "Info" => [
        "Tipo" => "premium"
    ]
    ];

//Se accede por el nombre de la propiedad
echo "<pre>";
//Todo el arreglo
var_dump($cliente);
//Un valor
var_dump($cliente["nombre"]);
//Un valor dentro de otro arreglo
var_dump($cliente["Info"]["Tipo"]);
echo "</pre";

//Agregar un valor al arreglo

$cliente["codigo"] = 12345678900;
echo "<pre>";
var_dump($cliente["codigo"]);
echo "</pre>";

include 'includes/footer.php';