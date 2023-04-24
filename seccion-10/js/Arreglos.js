
const arreglo1 = [20, 10, 7];

//Se pueden combinar numeros, cadenas, booleanos, objetos, arreglos, ect.
const arregloConstructor = new Array("Hola", "Marzo", 2, {nombre : "carlos", apellido : "May"}, [2,4,5]);
console.table(arregloConstructor); //Crea una tablita en la consola con los indices de valores en las filas y los tipos en las columnas

console.log (arregloConstructor);

//Acceder a un valor del arreglo nombreArreglo[indice]

console.log(arregloConstructor[1]); //Si se quiere acceder a un valor no definido solo devuelve undefined

//Conocer la extension con .lenght

console.log(arreglo1.length);

//Se puede usar el metodo forEach() que utiliza un iterador mientras el arreglo no este vacio

arreglo1.forEach(function(mes){
    console.log(mes)
})