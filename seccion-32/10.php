<?php 
include 'includes/header.php';

//Conectar a BD con PDO

//Tipo de BD con host, nombre BD, usuario y password

$db = new PDO('mysql:host=localhost; dbname=bienesraices_crud', 'root', 'root');
//Crear query
$query = "SELECT titulo, imagen FROM propiedades;";

// //Consultar BD 
// $propiedades = $db->query($query)->fetch();

//Consultar BD con sentencias preparadas

//Preparar el query
$stmt = $db->prepare($query);

//Ejecutar el query
$stmt ->execute();

//Devuelve todos los resultados en forma de arreglo, pero con el argumento de PDO con el atributo estatico FETCH_ASSOC lo devuelve como asociativo
$resultado = $stmt->fetchAll( PDO::FETCH_ASSOC); 

foreach ($resultado as $propiedad){
    echo $propiedad["titulo"];
    echo "<hr>";
    echo $propiedad["imagen"];
    echo "<hr>";

}

include 'includes/footer.php';