
function tarea(done){
    console.log("Es una tareaa");

    done(); //Callback de finalizacion de la tarea, forma anterior de codigo asincrono
}

exports.primerTarea = tarea; //Nombre que se le asocia al llamar a tarea. parte a llamar = funcion asociada 

//npx permite ejecutar paquetes sin instalarlos globalmente

//npx gulp primerTarea para llamar la funcion