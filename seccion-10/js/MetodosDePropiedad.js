
//Para hacer metodos es como si se declarara una propiedad de un objeto, solo que despues de los : va la funcion declarada
const reproductor = {
    reproducir : function(){
        console.log("Reproduciendo");
    },
    repetir : function(si=true){
        if(si===false){
            console.log("No se repetirá la canción");
        } else {
            console.log("Se repetirá la canción");
        }
    }
}

reproductor.borrarCancion = function(id){
    console.log(`Eliminando la canción ${id}`);
}

reproductor.reproducir();

reproductor.repetir(false);

reproductor.borrarCancion(777);