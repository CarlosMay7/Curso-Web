<?php include 'includes/header.php';

//Tiene los loops while, do while, for y for each

$contador = 0;

while ($contador<7){
    echo "Soy menor";
    echo "<br>";
    $contador++;
}

//Forma alternativa

while ($contador<7):
    echo "Soy menor";
    echo "<br>";
    $contador++;
endwhile;

$contador = 0;

do {
    echo "Soy mayor?";
    echo "<br>";
    $contador++;
} while ($contador<7);


for ($contador=0; $contador<7; $contador++){
    echo "Estoy en el for";
    echo "<br>";
}

//Forma alternativa
for ($contador=0; $contador<7; $contador++):
    echo "Estoy en el for";
    echo "<br>";
endfor;


$clientes = ["Pedro", "Juan", "Carlos"];

foreach($clientes as $cliente ){
    echo $cliente . "<br>";
}

//Forma alternativa
foreach($clientes as $cliente ):
    echo $cliente . "<br>";
endforeach;

$cliente = [
    "nombre" => "Juan",
    "saldo" => 200,
    "Tipo" => "premium"
];

//Valores en arreglo asociativo
foreach($cliente as $valor ){
    echo $valor . "<br>";
}

//Valores y llaves en asociativo
foreach($cliente as $Key => $valor ){
    echo $Key . " - " . $valor . "<br>";
}

include 'includes/footer.php';