//Hace referencia a todo el html, siempre se coloca cuando quiero seleccionar algo de ahi

const boton = document.querySelector("#boton"); //Se hace referencia al boton con el id, algo parecido a css

boton.addEventListener("click", function(){ //Se toma exactamente el evento click para que realice una accion
    Notification.requestPermission() //Como las APIs modernas usan promises, podemos aplicar sus caracteristicas
        .then(resultado => console.log(`El resultado seleccionado es ${resultado}`));
});

if(Notification.permission== "granted"){
    new Notification("Este es el titulo de la notificación", {
        icon: "img/ccj.png",
        body: "Aqui va lo que quiere decir la notificación"
    })
}