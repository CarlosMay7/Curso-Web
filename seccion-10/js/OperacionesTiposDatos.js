//Strings

const cadena1 ="Hola que tal";
const cadena2 ="Muy bien";

console.log(cadena1.length); //Propiedad exclusiva de las cadenas (Es parecido a un metodo por el . pero no lleva parentesis

//IndexOf
//Dice la posicion en donde inicia la subcadena
//Cuando devuelve -1 es que la subcadena no se encuentra
console.log(cadena2.indexOf("bien"));

//Includes
//Devuelve true o false dependiendo si se encuentra la subcadena
console.log(cadena2.includes("bien"));

//Soporta la concatenacion con + o ,

let cadena3 = cadena1 + cadena2;

//Template Strings - String Literals
//Se usan las comillas invertidas `` y para seleccionar que trate una variable como tal se usa ${} alrededor del nombre de la variable

const valorNumerico =7;
let cadenaTemplate = `Cadena con template strings y muestro una variable ${valorNumerico}`;
console.log(cadenaTemplate);




//Numeros

//Operaciones normales de los numeros como suma +, multiplicacion *, modulo %, etc.
//Un error que puede saltas es NaN que significa Not a Number

//Incrementos 
let puntaje = 10;

puntaje++; //Aumenta en 1 al puntaje, seria 11

console.log(puntaje); //Primero imprime el puntaje guardado y luego lo incrementa, seria 11 y luego lo actualiza a 12
console.log(++puntaje); //Primero incrementa el puntaje y luego lo imprime, seria 12

//Funciona de la misma manera con el - 

//Igual funciona el += o -=

puntaje-=2;
puntaje +=2;


//Objeto Math

//Se pueden ver las funciones que trae Math en la consola del navegador

let prueba;

prueba = Math.random();
console.log(prueba);

prueba = Math.PI;
console.log(prueba);

prueba = Math.round(2.2); //A partir de 2.5 redondea hacia arriba
//Estan las funciones floor y ceil para redondear
console.log(prueba);

prueba = Math.sqrt(2);
prueba = Math.abs(-7); //Toma el valor absoluto del numero
prueba = Math.min(2,4,8,5,6); //Toma el valor minimo de la lista
prueba = Math.max(2,4,8,5,6); //Toma el valor maximo de la lista




//Soporta booleanos tambien

//Tiene su constructor tambien
const booleano = new Boolean(true);



//Objetos

const productoPrueba = {
    nombreProducto : "Control", //Se usan los : para asignar valores y la , para dividir las propiedades
    precio : 300,
    disponible : true
}


//Freeze
//Los objetos se pueden modificar, asi que se usa el metodo freeze para "congelar" o evitar que se pueda modificar (Agregar, eliminar o cambiar propiedades)
Object.freeze(productoPrueba);

productoPrueba.imagen("Imagen"); //Ya no aparece

//Pero si se ca,bia a modo estricto con "use strict" al principio del archivo da un error ya que no se debe modificar si tiene el freeze
//Ademas es mala practica

//Para saber si esta congelado es el isFrozen()

Object.isFrozen(productoPrueba); //Devuelve un booleano

const productoPruebaSeal = {
    medida :20, //Se usan los : para asignar valores y la , para dividir las propiedades
    codigo : 154258,
    rojo : true
}

//Seal
//Es parecido a freeze, solo que seal si deja cambiar los valores de las propiedades del objeto
Object.seal(productoPruebaSeal)


//Unir dos objetos (sirve para arreglos tambien)
//Se usa el rest operator para unir los valores de objetos, sirve para mas de 2
const nuevoProducto = { ...productoPrueba, ...productoPruebaSeal, ...cadena1};
