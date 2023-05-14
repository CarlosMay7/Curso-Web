<?php include 'includes/header.php';

//Interfaces
interface TrnasporteInterfaz {
    //La interfaz es como un plano, muestra como debe ser la clase pues
    //solo denota el comportamiento, no implementa nada
    //Todos los metodos en la intrfaz tienen que ser implementados en las clases que la utilizan
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

include 'includes/footer.php';