//Generar nuevos enlaces, aplica para todas las etiquetas como h1, p y asi
//Cuando se usa createElement se coloca la etiqueta de lo que se quiere crear EN MAYUSCULAS
const nuevoEnlace = document.createElement("A");

//Esta forma de agregar cosas al html le da mas dinamismo y facilidad de juntar con otros sistemas

//Agregar href, es como si fuera un objeto, se le asigna el valor

nuevoEnlace.href="nuevo-enlace.html"; 

//Agregar el texto
nuevoEnlace.textContent= "Enlace creado desde JS";

//Agregar la clase
nuevoEnlace.classList.add("navegacion__enlace");

//Agregar al documento
const navegacion = document.querySelector(".navegacion"); //Aqui toma de referencia al primer enlace de la clase navegacion
navegacion.appendChild(nuevoEnlace); //Aqui agrega como "hijo" a la clase navegacion al nuevoEnlace

console.log(nuevoEnlace);


//Eventos
//Esto es un evento, cuando ocurre entonces se ejecuta la funcion; este proceso de condicionar o esperar a que suceda algo y entonces la ejecucion se llama call back
window.addEventListener("load", function(){ //load espera a que el JS y los archivos que dependen del HTML esten listos, como el css, las imagenes
    console.log("Cargado"); //Podemos llamar una funcion fuera del event listener en lugar de crearla dentro
})

document.addEventListener("DOMContentLoaded", function(){ //Solo espera a que se descargue el HTML, no importa la imagen y css. Es algo mas util y rapido ya que solo modificamos el HTML
    console.log("DOMContent");
})

window.onscroll = function(){
    console.log("Scrolling...");
}


//Seleccionar elementos y asociar un evento

/*
const enviar = document.querySelector(".boton--primario"); //Una vez seleccione el elemento con el querry selector ya me da la oportunidad de usar los event listener

enviar.addEventListener("click", function(eventoPara ver las funciones disponibles le puedo pasar el evento a la funcion y asi ver sus caracteristicas. Disponible en todos los eventos){ //El comportamiento "normal" del submit seria enviar los elementos del input a un archivo o alguna bdd
    evento.preventDefault(); //Este metodo retiene el evento por defecto para que no se ejecute, util para validar entradas

    console.log("Enviando");
})
*/

//Eventos de los inputs y text areas

const nombreInput = document.querySelector("#nombre");
const email = document.querySelector("#email");
const mensajeTextArea = document.querySelector("#mensaje");
const formulario = document.querySelector(".formulario");


const datos = {
    nombre:"",
    email:"",
    mensaje:""
}

nombreInput.addEventListener("change", terminarEscribir);      //Se ejecuta la funcion hasta que sale del espacio de input, ya ocurrio un cambio

nombreInput.addEventListener("input", /*mostrarValores,*/ leerTexto); //Se ejecuta cada que se introduce un caracter en el espacio de input, algo mas en tiempo real

email.addEventListener("input", /*mostrarValores,*/ leerTexto); //Se ejecuta cada que se introduce un caracter en el espacio de input, algo mas en tiempo real

mensajeTextArea.addEventListener("input", /*mostrarValores,*/ leerTexto); //Se ejecuta cada que se introduce un caracter en el espacio de input, algo mas en tiempo real

//Evento submit
formulario.addEventListener("submit", function(evento){ //Ojo, en formularios siempre debe haber al menos un button type submit, sino, ¿Como envias las capturas?
    evento.preventDefault();                            //Ademas es buena practica, en lugar de usar el click, que es para cualquier otro elemento

    //Validar formulario
    //Primero se debe validar antes de enviar

    //Destructuring, generar variables a partir de la estructura de un arreglo u objeto. Debe tener los mismos nombres que en el objeto
    const { nombre, email, mensaje } = datos;

    if (nombre === "" || email==="" || mensaje===""){
        //mostrarError("Llene todos los campos, por favor");
        mostrarAlerta("LLene todos los campos, por favor", true);
        return;
    }
    //Enviar el formulario con la alerta de correcto
    console.log("Enviando formulario");
    mostrarAlerta("Se envió correctamennte", false);
});

//No se tiene que pasar el evento en la llamada ya que se pasa de manera automatica
function mostrarValores(evento){
    console.log("Escrito");
    console.log(evento.target.value); //.target hace referencia al lugar donde se escribe, en este caso la clase y si quiero acceder al valor es.value
}

function terminarEscribir(evento){
    console.log("Escrito");
    console.log(evento.target.value); //.target hace referencia al lugar donde se escribe, en este caso la clase y si quiero acceder al valor es.value
}

function leerTexto (evento) {                      //Para que funcione tiene que ser el mismo nombre de id que de atributo del objeto
    datos[evento.target.id] = evento.target.value; //Esto significa que en el atributo evento.target.id (por ejemplo nombre) tome el valor de evento.target
    //console.log(datos);
}

//Se debe ordenar el codigo, de cualquier manera pero que tenga un orde, por ejemplo variables, eventos y funciones

//Una vez hecho el codigo que funcione y se entienda como funciona, aunque este feo, se puede empezar a ver como se puede maquillar para que quede mas bonito o con menos repetiiones

function mostrarAlerta (mensaje, error= true){
    const alerta = document.createElement("P"); // Linea que reduzco : 1
    alerta.textContent = mensaje; //Linea que reduzco: 2

    if (error ===true ){
        alerta.classList.add("error"); //Linea que cambio: 3
    } else {
        alerta.classList.add("correcto"); //Linea que cambio: 4
    }

    formulario.appendChild(alerta); //Linea que reduzco: 5

    setTimeout(() => { //Funcion que reduzco: 6
        mensajeSucces.remove(); //Hace que desaparezca el mensaje de la pantalla
    }, 4000);
}


/*Muestra el error en pantalla
function mostrarError (mensaje){
    const mensajeError = document.createElement("P"); //1
    mensajeError.textContent = mensaje; //2
    mensajeError.classList.add("error"); //3

    formulario.appendChild(mensajeError); //Agrega el mensaje al formulario.... 5

    //Desaparece despues de 3 segundos

    setTimeout(() => { //6
        mensajeError.remove(); //Hace que desaparezca el mensaje de la pantalla
    }, 3000);
}

function envioCorrecto (mensaje){
    const mensajeSucces = document.createElement("P"); //1
    mensajeSucces.textContent = mensaje; //2
    mensajeSucces.classList.add("correcto"); //4

    formulario.appendChild(mensajeSucces); //Agrega el mensaje al formulario.... 5

    //Desaparece despues de 4 segundos

    setTimeout(() => { //6
        mensajeSucces.remove(); //Hace que desaparezca el mensaje de la pantalla
    }, 4000);
}
*/


//Codigo mas corto mas facil de mantener, entender y mas rapido de cargar

