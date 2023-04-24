//Metodos de arreglos

//Agregar  elementos 

arreglo1[3] = 15; //Como no existe se agrega en la psicion 3, si existiera se modifica esa posicion

//Funcionan como pilas, tiene el metodo .push() para agregar elementos al final

arreglo1.push(70); //La pisicion 4 ahora es 70 ya que es la ultima

//El metodo .unshift() agrega elementos al principio

arreglo1.unshift(-1); //Ahora la posicion 0 es -1 y los demas indices se recorrieron



//Eliminar elementos

//Como funciona como pila igual tienen el .pop() que elimina el ultimo elemento 
arreglo1.pop();

//Ahora el .shift() elimina el primero
arreglo1.shift();

//Para eliminar un elemento o algunos en particular se usa el .splice(indice elemento, cuantos quiero eliminar a partir de ese indice)

arreglo1.splice(3, 2); //A partir de la posicion 3 quiero eliminar la posicion 3 y 4 (por eso el 2)


//Una buena practica es no modificar los arreglos originales asi que es mejor crear nuevos para ahora si modificarlos

//Se puede usar el rest o spread operator

const nuevoArreglo = [...arreglo1, 256]; //Equivale un push

const otroArreglo = [256, ...arreglo1]; //Equivale a un unshift


//Los arrays tambien soportan el .includes() para arreglos de una dimension

let incluye = otroArreglo.includes(256);

const carrito = [
    {nombre : "Telefono", precio: 2},
    {nombre : "Tablet", precio :3}
]
//Para arregos de objetos se usa el .some

incluye = carrito.some (function(producto){
    return producto.nombre === "Telefono";
})

//Reduce 
//Es para hacer sumas, se le pasa el total y el producto actual, ademas que afuera se coloca el valor inicial del total

let resultado = carrito.reduce(function(total, producto){
    return total + producto.precio;
},0)


//Filter
//Devuelve los objetos que cumplen la condicion
resultado = carrito.filter(function(producto){
    return producto.precio>2;
})