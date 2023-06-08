let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

document.addEventListener("DOMContentLoaded", function(){
    iniciarApp();
});

function iniciarApp(){
    mostrarSeccion();
    tabs(); //Cambia la seccion cuando se presionan
    botonesPaginador(); //Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();

    consultaAPI(); //Consulta la API en el backend PHP
}

function mostrarSeccion(){

    //Ocultar la seccion que tenga la clase de mostrar
    const seccionAnterior = document.querySelector(".mostrar");
    if(seccionAnterior){
        seccionAnterior.classList.remove("mostrar");
    }

    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add("mostrar");

    //Quita la clase de actual al anterior
    const tabAnterior = document.querySelector(".actual");
    if(tabAnterior){
        tabAnterior.classList.remove("actual");
    }

    //Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add("actual");
}

function tabs(){
    const botones = document.querySelectorAll(".tabs button");

    botones.forEach(boton => {boton.addEventListener("click", function(evento){
        paso = parseInt(evento.target.dataset.paso);
        mostrarSeccion();
        botonesPaginador();
    })
})
}

function botonesPaginador(){
    const anterior = document.querySelector("#anterior");
    const siguiente = document.querySelector("#siguiente");

    if(paso === 1){
        anterior.classList.add("ocultar");
        siguiente.classList.remove("ocultar");
    } else if(paso === 3){
        anterior.classList.remove("ocultar");
        siguiente.classList.add("ocultar");
    } else {
        anterior.classList.remove("ocultar");
        siguiente.classList.remove("ocultar");
    }

    mostrarSeccion();
}

function paginaAnterior(){
    const anterior = document.querySelector("#anterior");

    anterior.addEventListener("click", function(){
        if(paso<=pasoInicial)return;
        paso --;
        botonesPaginador();

    })
}
function paginaSiguiente(){
    const siguiente = document.querySelector("#siguiente");

    siguiente.addEventListener("click", function(){
        if(paso>=pasoFinal)return;
        paso ++;
        botonesPaginador();

    })
}

async function consultaAPI(){

    try {
        const url = "http://localhost:3000/api/servicios";
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    } catch (error) {
        
    }
}

function mostrarServicios(servicios){
    servicios.forEach(servicio => {
        const {id, nombre, precio} = servicio;

        const nombreServicio = document.createElement("P");
        nombreServicio.classList.add("nombre-servicio");
        nombreServicio.textContent= nombre;

        const precioServicio = document.createElement("P");
        precioServicio.classList.add("precio-servicio");
        precioServicio.textContent= `$${precio}`;

        const servicioDiv = document.createElement("DIV");
        servicioDiv.classList.add("servicio");
        servicioDiv.dataset.idServicio = id;

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector("#servicios").appendChild(servicioDiv);
    });
}