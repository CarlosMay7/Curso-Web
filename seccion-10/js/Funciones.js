
//Declaracion de funcion

//Diferencia entre declaracion y expresion
/*Por el Hoisting en JavaScript (Primero se leen las funciones, se guardan y luego se ejecutan)
en la declaracion se puede mandar a llamar primero y luego declararla sin problema, en cambio con la expresion, Js no toma 
la funcion como tal, sino que como una variabla y entonces cuando quiere ejecutar antes de expresarla da un error*/
function multiplicar(){
    console.log(10*10);
}

multiplicar();

//Expresion de la funcion

const sumar = function() {
    console.log(2+2);
}

sumar();

//IIFE
//Se llama a ella misma
//Se usa para proteger variables, que no sean visibles para otros archivos y asi evitar problemas de acceso

(function(){
    console.log("Esta es una funcion rara")
})();


//Para las funciones con parametros se pueden inicializar con un valor por default y si no se agrega nada al llamar a la funcion se toman esos valores
function dividir (numerador = 0, divisor = 1){
    console.log(numerador/divisor);
}


//Funciones que retornan valores
//Igual que en java

let resultado =0;

function sumaRetorno(valor1=0, valor2 =0){
    return valor1 + valor2;
}

resultado = sumaRetorno(2,5);

console.log(`El total de la suma es ${resultado}`);

//Soporta el try catch

try {

} catch (error) {

}

//Hace que siga funcionando aun haya errores