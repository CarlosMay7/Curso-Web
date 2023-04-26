
async function obtenerEmpleados (){
    
    const archivo = "empleados.json"
/*
    // fetch(url de donde queremos tomar la informacion)
    fetch(archivo) //Usa promises
         Me da el resultado
        .then( resultado =>{
            console.log(resultado);
        }) //Si el status es 200 es que la peticion fue correcta, 404 es not found
        

        .then(resultado => resultado.json()) //Transforma a json o text con .tex. Con el json lo toma como si fuueran objeto de jst
        

        .then (datos => {
            //console.log(datos); Imprime los datos de lo que retorno el resultado

            const {empleados} = datos;
            
            empleados.forEach(empleado => {
                console.log(empleado.nombre)

                //document.querySelector(".contenido").textContent = empleado.nombre; Para imprimir en el html
            });
        })
*/

//Usando async/await 
//Para el uso de promises no es funcion asincrona
const resultado = await fetch(archivo);
const datos = await resultado.json;
console.log(datos);
}

obtenerEmpleados();