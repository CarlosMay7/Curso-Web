<?php 
declare(strict_types=1);
include 'includes/header.php';

//El type es después de : , se coloca el tipo de dato que devuelve la funcion, mejora el tipado
function autenticado(bool $si) : string{
    if ($si){
        return "Usuario autenticado"; 
    } else {
        return "No autenticado";
    }
}

//El ? en el type es para decir que es un tipo de dato opcional
//Igual puede ser union (string|int) para devolver un string o int
function opcional (bool $verdadero) : ?string{
    if ($verdadero){
        return "Verdadero";
    } else {
        return null;
    }
}

$usuario = autenticado(true);

echo $usuario; 

include 'includes/footer.php';