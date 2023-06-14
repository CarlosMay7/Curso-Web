document.addEventListener("DOMContentLoaded", function(){
    iniciarApp();
});

function iniciarApp(){
    buscarPorFecha();
}

function buscarPorFecha(){
    const fechaInput = document.querySelector("#fecha");
    fechaInput.addEventListener("input", function(evento){
        fechaSeleccionada = evento.target.value;
        console.log(fechaSeleccionada);

        window.location = `?fecha=${fechaSeleccionada}`;
    });
}