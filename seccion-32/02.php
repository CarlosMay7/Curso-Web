<?php 
declare(strict_types = 1);
include 'includes/header.php';

//Encapsulación
class Producto {

    //Modificadores de acceso: 
        //Public: Cualquiera puede acceder
        //Protected: Solo en la clase se puede acceder
        //Private: Miembros de la misma clase pueden acceder
    public function __construct(protected string $nombre, public int $precio, public bool $disponible){

    }

    public function mostrarProducto(){
        echo "El producto es: " . $this->nombre . " y su precio es: " . $this->precio;
    }

    public function getNombre() : string{
        return $this->nombre;
    }

    public function setNombre(string $nombre){
        $this->nombre = $nombre;
    }

}

$producto2 = new Producto("Celular", 700, true);

$producto3 = new Producto("Control", 70, true);


echo $producto2->getNombre();
$producto2->setNombre("Tablet");
echo $producto2->getNombre();

echo $producto3->getNombre();

include 'includes/footer.php';