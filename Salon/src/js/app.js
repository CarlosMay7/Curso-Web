let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    id: "",
    nombre: "",
    fecha: "",
    hora: "",
    servicios: []
}

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

    idCliente();
    nombreCliente();
    seleccionarFecha();
    seleccionarHora();

    mostrarResumen();
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

        mostrarResumen();
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
        servicioDiv.onclick = function(){
            seleccionarServicio(servicio);
        };

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector("#servicios").appendChild(servicioDiv);
    });
}

function seleccionarServicio(servicio){
    const {id} = servicio;
    const {servicios} = cita;

    //Identificar elemento al que se da click
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`)

    //Comprobar si un servicio ya fue agregado
    if(servicios.some(agregado => agregado.id === id)){
        //Eliminar
        cita.servicios.filter(agregado => agregado.id !== id);
        divServicio.classList.remove("seleccionado");
    } else {
        //Agregar
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add("seleccionado");

    }
}

function idCliente(){
    const citaId = document.querySelector("#id").value;

    cita.id = citaId;
}

function nombreCliente(){
    const nombre = document.querySelector("#nombre").value;

    cita.nombre = nombre;
}

function seleccionarFecha(){
    const inputFecha = document.querySelector("#fecha");

    inputFecha.addEventListener("input", function(evento){
        const dia = new Date(evento.target.value).getUTCDay(); //Regresa el valor del dia (0 Domingo, 6 sabado)

        if([6, 0].includes(dia)){
            evento.target.value = "";
            mostrarAlerta("No abrimos fines de semana", "error", ".formulario");
        } else {
            cita.fecha = evento.target.value;
        }
    });
}

function seleccionarHora(){
    const inputHora = document.querySelector("#hora");
    inputHora.addEventListener("input", function(evento){
        const horaCita = evento.target.value;
        const hora = horaCita.split(":")[0];

        if(hora < 10 || hora>18){
            evento.target.value = "";
            mostrarAlerta("Hora no válida", "error", ".formulario");
        } else {
            cita.hora = evento.target.value;
        }
    })
}
function mostrarAlerta(mensaje, tipo, elemento, desaparece = true){

    //Previene que se generen muchas alertas
    const alertaPrevia = document.querySelector(".alerta");
    if (alertaPrevia){
        alertaPrevia.remove();
    }

    //Crear alerta
    const alerta = document.createElement("DIV");
    alerta.textContent = mensaje;

    alerta.classList.add("alerta");
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    //Eliminar la alerta
    if(desaparece){
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }

}

function mostrarResumen(){
    const resumen = document.querySelector(".contenido-resumen");

    //Limpiar contenido resumen
    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild);
    }

    if(Object.values(cita).includes("") || cita.servicios.length === 0){
        mostrarAlerta("Faltan datos o servicios", "error", ".contenido-resumen", false);
        return;
    }

    //Formatear el div de resumen

    const {nombre, fecha, hora, servicios} = cita;

    //Heading Servicios
    const headingServicios = document.createElement("H3");
    headingServicios.textContent="Resumen Servicios";
    resumen.appendChild(headingServicios);

    //Mostrando servicios
    servicios.forEach(servicio => {

        const {id, precio, nombre} = servicio;
        const contenedorServicios = document.createElement("DIV");
        contenedorServicios.classList.add("contenedor-servicio");

        const textoServicio = document.createElement("P");
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement("P");
        precioServicio.innerHTML = `<span>Precio:</span> $${precio}`;

        contenedorServicios.appendChild(textoServicio);
        contenedorServicios.appendChild(precioServicio);
        
        resumen.appendChild(contenedorServicios);
    })

    //Heading Servicios
    const headingCita = document.createElement("H3");
    headingCita.textContent="Resumen Cita";
    resumen.appendChild(headingCita);

    const nombreCliente = document.createElement("P");
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    //Formatear la fecha
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year, mes, dia));

    const opciones = {weekday: "long", year: "numeric", month: "long", day: "numeric"};
    const fechaFormateada = fechaUTC.toLocaleString("es-MX", opciones);

    const fechaCita = document.createElement("P");
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaCita = document.createElement("P");
    horaCita.innerHTML = `<span>Hora:</span> ${hora} Horas`;

    //Boton crear cita
    const botonReservar = document.createElement("BUTTON");
    botonReservar.classList.add("boton");
    botonReservar.textContent = "Reservar Cita";
    botonReservar.onclick = reservarCita;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);

    resumen.appendChild(botonReservar);
}

async function reservarCita(){

    const {nombre, fecha, hora, servicios, id} = cita;

    const servicioId = servicios.map(servicio => servicio.id);

    const datos = new FormData();
    datos.append("fecha", fecha);
    datos.append("hora", hora);
    datos.append("usuarioid", id);
    datos.append("servicios", servicioId);

    try {
        //Peticion a la api
        const url = "http://localhost:3000/api/citas";

        const respuesta = await fetch(url, {
            method: "POST",
            body: datos
        });

        const resultado = await respuesta.json();
        console.log(resultado);

        if(resultado.resultado){
            Swal.fire({
                icon: 'success',
                title: 'Cita Creada',
                text: 'Tu cita fue creada correctamente',
                button: "OK"
            }).then( ()=> {
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            })
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Hubo un error al generar la cita',
          })
    }


    //console.log([...datos]); Ver el contenido del form data
}