<?php
//Es recomendable tener las credenciales en un archivo para solo incluirlo donde se necesita
//Colocar credenciales de SQL
//Direccion del hosting, usuario, contraseña, base a la cual conectar

$db = mysqli_connect("localhost", "root", "root", "appsalon");

//Es recomendable tener algo asi con un exit para evitar que se ejecute algo más de la aplicacion
if (!$db){
    echo "Error!!";
    exit; 
}