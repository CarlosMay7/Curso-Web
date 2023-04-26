
// Soporta el if

const valor =7;

if (valor ===7){
    console.log("Igual");
} else if (valor<9) {
    console.log("No igual");
} else {
    console.log("Mayor a 9")
}


//Switch

const metodoPago = "tarjeta";

switch(metodoPago){
    case "tarjeta": //Se colocan puntos después del valor del case con el comportamiento deseado
        console.log("Pagaste con tarjeta");
        break; //Siempre va después del comportamiento para decir que ahi acaba
    case "cheque": 
        console.log("Pagaste con cheque");
        break;
    case "bitcoin": //Si es solo una condicion es mejor usar un if, si ya son muchas mejor con switch
        console.log("Pagaste con bitcoin");
        break; 
    default: //Valor que toma si no se cumple ningun case
        console.log("Aun no pagas");
        break;
}