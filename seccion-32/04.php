<?php include 'includes/header.php';

//Herencia
class Transporte {
    public function __construct(protected int $ruedas, protected int $capacidad){
        
    }

    public function getInfo() : string{
        return "El transporte tiene " . $this->ruedas . " ruedas y una capacidad de " . $this->capacidad . " personas";
    }

    public function getRuedas() : int{
        return $this->ruedas;
    }
}

//Esta clase tiene todos los metodos y atributos de la clase que extiende o hereda, en este caso Transporte
class Bicicleta extends Transporte {

    //Si se necesita un metodo muy parecido a uno de la clase padre pero con pequeños cambios se toma el mismo nombre de 
    //la clase padre y se reescribe

    public function getInfo() : string{
        return "El transporte tiene " . $this->ruedas . " ruedas y una capacidad de " . $this->capacidad . " personas Y NO GASTA GASOLINA";
    }
}

class Automovil extends Transporte {
    //Para agregar un atributo o metodo se agrega en la clase a la que se quiere añadir
    public function __construct(protected int $ruedas, protected int $capacidad, public string $transimision){
        
    }

    public function getTransmision(){
        return $this->transimision;
    }
}

$bicicleta = new Bicicleta(2, 1);
echo $bicicleta->getInfo();
echo $bicicleta->getRuedas();

echo "<hr>"; //Hace una linea horizontal

$auto = new Automovil(4, 4, "Manual");
echo $auto->getInfo();
echo $auto->getTransmision();

include 'includes/footer.php';