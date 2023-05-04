<?php include 'includes/header.php';

$numero1 = 20;
$numero2 = 70;
$numero3 = 70;
$numero4 = "70";

var_dump($numero1 > $numero2);
echo "<br>";
var_dump($numero1 < $numero2);
echo "<br>";
var_dump($numero1 >= $numero2);
echo "<br>";
var_dump($numero1 <= $numero2);
echo "<br>";
var_dump($numero2 == $numero3);
echo "<br>";
var_dump($numero2 == $numero4); //Checa valores
echo "<br>";
var_dump($numero1 === $numero2); //Checa valores y tipo de dato
echo "<br>";
var_dump($numero1 <=> $numero2); //Si el número de la izquierda es menor imprime 1, si son iguales 0 y si el de la derecha es mayor -1

include 'includes/footer.php';