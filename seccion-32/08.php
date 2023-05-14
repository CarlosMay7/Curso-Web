<?php 
include 'includes/header.php';
require "vendor/autoload.php";


//Se usa para que no se tenga que poner el namespace (App\) al crear objetos
use App\Clientes;
use App\Detalles;
use Firebase\JWT\JWT;

// //Con esto se va buscando las clases segun se vayan necesitando en lugar de tener todos los require
// //Esto se puede omitir gracias al composer
// function miAutoload ($clase){
//     $partes = explode('\\',$clase ); //Divide el string en un arreglo con respecto a \
//     require __DIR__ . "/clases/" . $partes[1] . ".php";
// }

// class Clientes {
//     public function __construct(){
//         echo "Desde el 08 clientes";
//     }
// }

spl_autoload_register('miAutoload');

//Para usar las clases con namespaces se usa la \ entre el namespace y el nombre de la clase
$detalles = new Detalles();
$clientes = new Clientes();

include 'includes/footer.php';