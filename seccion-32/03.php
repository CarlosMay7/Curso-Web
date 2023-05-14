<?php 
declare(strict_types = 1);
include 'includes/header.php';

//Metodos estaticos

class Producto {

    public $imagen;
    public static $imagenPlaceholder = "imagen.jpg";

    //El modificador hace a los parametros obligatorios
    public function __construct(protected string $nombre, public int $precio, public bool $disponible, string $imagen){

        if($imagen){
            self::$imagenPlaceholder = $imagen;
        }
    }

    public static function obtenerImagenProducto(){ //No requieren instanciarse
        //Para los estaticos se utiliza self
        return self::$imagenPlaceholder;
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

//Asi se llaman a los metodos o atributos estaticos
//Nombre clase::nombreMetodo();

$producto2 = new Producto("Celular", 700, true, "");
echo $producto2->obtenerImagenProducto();


$producto3 = new Producto("Control", 70, true, "control.jpg");
echo $producto3->obtenerImagenProducto();


echo $producto2->getNombre();
$producto2->setNombre("Tablet");
echo $producto2->getNombre();

echo $producto3->getNombre();

include 'includes/footer.php';