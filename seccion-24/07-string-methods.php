<?php include 'includes/header.php';

$nombre = "Carlos May";

//Conocer extensión con espacios en blanco
echo strlen($nombre);
echo "<br>";
var_dump($nombre);
echo "<br>";

//Eliminar espacios en blanco al inicio y final
$nombreEspacios = "     Carlos May       ";
echo strlen($nombreEspacios);
echo "<br>";
$noEspacios = trim($nombreEspacios); //Útil para formularios
echo $noEspacios;
echo "<br>";
echo strtoupper($noEspacios);
echo "<br>";
echo strtolower($noEspacios); //Util para verificar un estandar correos
echo "<br>";

echo str_replace("Carlos", "C", $noEspacios);
echo "<br>";

//Revisar si string existe
echo strpos($noEspacios, "May");
echo "<br>";

//Concatenar
$cliente ="Premium";

echo "El cliente " . $nombre . " es " . $cliente;
echo "<br>";
//Algo parecido a template string
echo "El cliente {$nombre} es {$cliente}";

include 'includes/footer.php';