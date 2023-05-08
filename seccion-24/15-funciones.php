<?php
declare (strict_types=1); //Hacer que el tipado sea mas fuerte, se necesita tener en la primera linea del programa
include 'includes/header.php';


function sumar (){
    echo 2+2;
}

//Se puede tener valores por defecto y se puede declarar el tipo de dato requerido
function sumarParametros(int $valor1, int $valor2 =0){
    echo $valor1 + $valor2;
}

sumar();
sumarParametros(2+3);

//Los parametros nombrados son para poder pasar valores en cualquier orden

sumarParametros(valor1:3, valor2:2);

include 'includes/footer.php';