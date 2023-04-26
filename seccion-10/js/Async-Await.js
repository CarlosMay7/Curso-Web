
//Ve que si una tarea tarda mucho, pero otra se puede realizar en un tiempo mas corto, la realiza mientras se termina la tardada

function descargarClientes (){
    return new Promise( resolve => {
        console.log("Descargando clientes...");

        setTimeout(() => {
            resolve("Clientes descargados");
        }, 5000);
    })
}

function descargarPedidos (){
    return new Promise( resolve => {
        console.log("Descargando pedidos...");

        setTimeout(() => {
            resolve("Pedidos descargados");
        }, 3000);
    })
}

/*
setTimeout( function(){
    console.log("Es el timeout")
    //Se ejecuta una vez despues del tiempo definido
    //El tiempo se toma en milisegundos
}, 5000);

setInterval( function(){
    console.log("Es el interval")
    //Se ejecuta varias veces despues del tiempo definido
    //El tiempo se toma en milisegundos
}, 5000);
*/

//Funcion asincrona (Async)

async function appAsync (){
    try {
       /*Sintaxis para una consulta async/await 
       const resultado = await descargarClientes(); //Decir donde esta el promise y colocar el await para que espere al resultado
       console.log(resultado); //Esto depende del resultado de arriba, hasta que no termine su tarea, esto no se ejecuta
       */

       //Sintaxis para 2 o mas consultas async/await

       const resultado = await Promise.all([descargarClientes(), descargarPedidos()]); //Se ejecutan ambos al mismo tiempo
       console.log(resultado[0]);
       console.log(resultado[1]);

       //Si tratara de aplicar la primera forma uno tendría que terminar para que empiece el otro
    } catch (error) {
        console.log("Error, no se descargaron")
    }
}

appAsync();

console.log("El codigo se sigue ejecutando mientras la appAsync espera");


