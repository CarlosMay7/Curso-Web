//Cuenta con el For, while y do while loop

//Misma sintaxis que java

for (let i=0; i<7; i++){
    console.log("Este es un for");
}

let i =0;
while (i<10){
    console.log(`Contador = ${i}`);
    i++; //Igual puede ir hacia atras con i--
}

i=0;

do { //Se ejecuta al menos una vez
    console.log(`Contador do while= ${i}`);
    i++; //Igual puede ir hacia atras con i--
} while (i<10);



//ForEach
//Metodo exclusivo de arreglos
//Itera segun los elementos del arreglo

//Se usa si solo quiero recorrer el arreglo y mostrar en consola o asi

const arregloIterador = [1,2,3];

arregloIterador.forEach(function(/*Aqui iria el elemento actual, por ejemplo un objeto en un arreglo de objetos*/){
    console.log("Se ejecuta una vez por elemento");
});

arregloIterador.forEach(numero => console.log(numero));


//Map
//Se usa si quiero formar un nuevo arreglo

const arregloNuevo = arregloIterador.map(numero => console.log(numero)/*`${)-${) ` Es para dar formato al arreglo*/);
