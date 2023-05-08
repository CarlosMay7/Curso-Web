<?php include 'includes/header.php';

$productos = [
    [
        "Nombre" => "Tablet",
        "Precio" => 200,
        "Disponible" => true
    ],
    [
        "Nombre" => "Monitor",
        "Precio" => 400,
        "Disponible" => true
    ],
    [
        "Nombre" => "Audifonos",
        "Precio" => 100,
        "Disponible" => false
    ]
];

echo "<pre>";
var_dump($productos);
$json = json_encode($productos); //Convierte un arreglo a string y se pueda consumir como json
var_dump($json);
$json_array = json_decode($json);
var_dump($json_array);

echo "</pre>";



include 'includes/footer.php';