<?php include 'includes/header.php';

$autenticado = true;
$admin = false;

//Se usan los operadores && y ||

if ($autenticado && $admin){
    echo "Usuario autenticado";
    echo "<br>";
} else {
    echo "Usuario no autenticado";
    echo "<br>";

}

//If anidados

$cliente = [
    "nombre" => "Juan",
    "saldo" => 200,
    "Info" => [
        "Tipo" => "premium"
    ]
];

//También se usa el ! para negar
if (!empty($cliente)){
    echo "Arreglo no vacío";
    echo "<br>";
    if ($cliente["saldo"] > 0){
        echo "Cliente con saldo";
        echo "<br>";
    } else if ($cliente["Info"]["Tipo"] === "premium"){
    
    }
} else {
    echo "Arreglo vacío";
}


//Switch

$tec = "php";

switch ($tec){
    case "php":
        echo "Es php";
        break;
    case "java":
        echo "Es java";
        break;
    default : 
        echo "No es alguno";
        break;
}

include 'includes/footer.php';