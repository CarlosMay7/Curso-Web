<?php 
declare(strict_types = 1);
include 'includes/header.php';

//Definir una clase 

class Producto {
    /*Forma antigua de agregar atributos*/
    // public $nombre;
    // public $precio;
    // public $disponible;

    // Para los métodos es crear una función dentro de la clase
    // Construct es el contructor de una clase
    // Parte de los metodos magicos de php (Inician con __)
    // public function __construct(string $nombre, int $precio, bool $disponible){
    //     $this->nombre = $nombre;
    //     $this->precio = $precio;
    //     $this->disponible = $disponible;
    // }

    //Nueva forma en php8
    //No se asignan los valores en el constructor, lo hace "solo"
    public function __construct(public string $nombre, public int $precio, public bool $disponible){

    }

    public function mostrarProducto(){
        echo "El producto es: " . $this->nombre . " y su precio es: " . $this->precio;
    }

}

// $producto = new Producto();
// //Para acceder a los atributos o metodos de los objetos es con la flecha -> 
// //Para asignar es de la misma manera con -> pero luego un =
// $producto -> nombre ="Tablet";
// $producto -> precio =7;
// $producto -> disponible =true;

$producto2 = new Producto("Celular", 700, true);
$producto2 -> mostrarProducto();

$producto3 = new Producto("Control", 70, true);
$producto3 -> mostrarProducto();


echo "<pre>";
var_dump($producto3);
echo "</pre>";

include 'includes/footer.php';