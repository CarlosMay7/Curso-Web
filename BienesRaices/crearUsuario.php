<?php

//Importar BD

require "includes/config/database.php";
$db = conectarDB();

//Crear emali y password
$email = "usuario@correo.com";
$password ="12345678";
$passHash = password_hash($password, PASSWORD_DEFAULT); //Igual puede ser PASSWORD_BCRYPT


//Query para crear usuario
$query =  "INSERT INTO usuarios (email, password) VALUES ( '$email', '$passHash');";

//Agregarlo a BD

mysqli_query($db, $query);