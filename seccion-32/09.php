<?php include 'includes/header.php';

//Conectar a bd con POO

$db = new mysqli("localhost", "root", "root", "bienesraices_crud");

//Secuencias preparadas

//Crear el query
$query = "SELECT titulo, imagen FROM propiedades";

//Preparar el query
$stmt = $db->prepare($query);

// $resultado = $db ->query($query);

//Ejecutar
$stmt->execute(); //Ejecuta lo que haya en la variable
//Se crea la variable
$stmt->bind_result($titulo, $imagen); //Crea una variable conlo sresultados de la consult
//Asignamos el reultado
$stmt -> fetch(); //Recupera los datos

//Imprimir uno por uno
var_dump($titulo);
var_dump($imagen);

//Imprimir varios 

while ($stmt->fetch()){
    var_dump($titulo);
}
include 'includes/footer.php';