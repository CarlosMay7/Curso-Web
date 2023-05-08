<?php include 'includes/header.php';

//--------include----------
//El include permite tomar el contenido del archivo llamado e incluirlo
//En el include se puede configurar para que se siga ejecutando el código si no se encuentra el include o que se pare todo
//Es bueno usarlo para cosas pequeñas como templates


//--------require--------
//Hace lo mismo que el include
//La diferencia es que require no permite ejecutar nada mas si no encuentra lo que necesita
//Es bueno usarlo en funciones criticas de los programas
//Es bueno separar las funciones del programa principal para no sobrecargarlo y tener buena organizacion

//--------require_once------
//Parecido al require, solo que este primero checa si ya fue incluido, si ya, lo ignora, sino lo ejecuta

require ("funciones.php"); //Se usa la ruta relativa
iniciar();




include 'includes/footer.php';