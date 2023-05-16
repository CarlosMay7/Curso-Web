<?php

use Automovil as GlobalAutomovil;
use Transporte as GlobalTransporte;
use TrnasporteInterfaz as GlobalTrnasporteInterfaz;

 include 'includes/header.php';

//Polimorfismo
interface TrnasporteInterfaz {

    public function getInfo() : string;
    public function getRuedas(): int;
} 
abstract class Transporte implements TrnasporteInterfaz {
    public function __construct(protected int $ruedas, protected int $capacidad){
        
    }

    public function getInfo() : string{
        return "El transporte tiene " . $this->ruedas . " ruedas y una capacidad de " . $this->capacidad . " personas";
    }

    public function getRuedas() : int{
        return $this->ruedas;
    }
}

class Automovil extends Transporte implements GlobalTrnasporteInterfaz {
    public function __construct(protected int $ruedas, protected int $capacidad, protected string $color){
        
    }

    public function getInfo() : string{
        return "El transporte AUTO tiene " . $this->ruedas . " ruedas y una capacidad de " . $this->capacidad . " personas y tiene el color " . $this->color;
    }

    public function getColor():string {
        return "El color del auto es " . $this->color;
    }
}

var_dump($auto = new Automovil(4,4, "rojo"));
$auto -> getInfo();
$auto -> getColor();
include 'includes/footer.php';