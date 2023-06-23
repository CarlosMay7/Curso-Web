(function(){ //IIFE Immediately invoked function expression. Forma para proteger variables de la lectura en otros archivos

    obtenerTareas();
    let tareas = [];

    //Boton para agregar modal agregar tarea
    const btnNuevaTarea = document.querySelector("#agregar-tarea");

    btnNuevaTarea.addEventListener("click", mostrarFormulario);

    async function obtenerTareas(){
        try {
            const id = obtenerProyecto();
            const url = `/api/tareas?id=${id}`;

            const respuesta = await fetch(url);

            const resultado = await respuesta.json();

            tareas = resultado.tareas;
            mostrarTareas();
        } catch (error) {
            console.log(error);
        }
    }

    function mostrarTareas(){

        limpiarTareas();
        if(tareas.length === 0){
            const contenedorTareas = document.querySelector("#listado-tareas");
            const textoNoTareas = document.createElement("LI");
            textoNoTareas.textContent = "Aún No Hay Tareas";
            textoNoTareas.classList.add("no-tareas");

            contenedorTareas.appendChild(textoNoTareas);
            return;
        }

        const estados = {
            0: "Pendiente",
            1: "Completa"
        }
        tareas.forEach(tarea => {
            const contenedorTarea = document.createElement("LI");
            contenedorTarea.dataset.tareaId = tarea.id;
            contenedorTarea.classList.add("tarea");

            const nombreTarea = document.createElement("P");
            nombreTarea.textContent = tarea.nombre;

            const opcionesDiv = document.createElement("DIV");
            opcionesDiv.classList.add("opciones"); 

            //Botones
            const btnEstado = document.createElement("BUTTON");
            btnEstado.classList.add("estado-tarea");
            btnEstado.classList.add(`${estados[tarea.estado].toLowerCase()}`);
            btnEstado.textContent = estados[tarea.estado];
            btnEstado.dataset.estadoTarea = tarea.estado;

            const btnEliminar = document.createElement("BUTTON");
            btnEliminar.classList.add("eliminar-tarea");
            btnEliminar.dataset.idTarea = tarea.id;
            btnEliminar.textContent = "Eliminar";

            opcionesDiv.appendChild(btnEstado);
            opcionesDiv.appendChild(btnEliminar);

            contenedorTarea.appendChild(nombreTarea);
            contenedorTarea.appendChild(opcionesDiv);

            const listadoTareas = document.querySelector("#listado-tareas");
            listadoTareas.appendChild(contenedorTarea);
        });
    }

    function mostrarFormulario(){
        const modal = document.createElement("DIV");
        modal.classList.add("modal");
        modal.innerHTML = `
            <form class="formulario nueva-tarea">
                <legend>Añade una nueva tarea</legend>
                <div class="campo">
                    <label>Tarea</label>
                    <input
                        type="text"
                        name="tarea"
                        placeholder="Añadir Tarea"
                        id="tarea"
                    />
                </div>
                <div class="opciones">
                    <input
                        type="submit"
                        class="submit-nueva-tarea"
                        value="Agregar Tarea"
                    />
                    <button type="button" class="cerrar-modal">Cancelar</button>
                </div>
            </form>
        `;

        setTimeout(() => {
            const formulario = document.querySelector(".formulario");
            formulario.classList.add("animar");
        }, 10);

        modal.addEventListener("click", function(evento){
            evento.preventDefault();

            if(evento.target.classList.contains("cerrar-modal")){
                const formulario = document.querySelector(".formulario");
                formulario.classList.add("cerrar");
                setTimeout(() => {
                    modal.remove();
                }, 700);
            }

            if(evento.target.classList.contains("submit-nueva-tarea")){
                submitNuevaTarea();
            }
        });

        document.querySelector(".dashboard").appendChild(modal);
    }

    function submitNuevaTarea(){
        const tarea = document.querySelector("#tarea").value.trim();

        if(tarea === ""){
            //Mostrar tarea de error
            mostrarAlerta("La tarea debe tener un nombre", "error", document.querySelector(".formulario legend"));
            return;
        }

        agregarTarea(tarea);

    }

    //Muestra una alerta en la interfaz
    function mostrarAlerta(mensaje, tipo, referencia){
        //Prevenir la creacion de muchas alertas
        const alertaPrevia = document.querySelector(".alerta");
        if(alertaPrevia){
            alertaPrevia.remove();
        }
        const alerta = document.createElement("DIV");
        alerta.classList.add("alerta", tipo);
        alerta.textContent = mensaje;

        //Inserta la alerta despues del elemento seleccionado
        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);

        //Eliminar la alerta después de 5 segundos

        setTimeout(() => {
            alerta.remove();
        }, 2000);
    }


    async function agregarTarea(tarea){
        //Construir la peticion
        const datos = new FormData();
        datos.append("nombre", tarea);
        datos.append("proyectoid", obtenerProyecto());

        try {
            const url = "/api/tarea";
            const respuesta = await fetch(url, {
                method: "POST",
                body: datos
            });

            const resultado = await respuesta.json();

            //Mostrar alerta de error
            mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector(".formulario legend"));

            if(resultado.tipo === "exito"){
                const modal = document.querySelector(".modal");
                setTimeout(() => {
                    modal.remove();
                }, 3000);

                //Agregar el objeto de tarea al global de tareas
                const tareaObj = {
                    id: String(resultado.id),
                    nombre: tarea,
                    estado: 0,
                    proyectoId: resultado.proyectoId
                }

                tareas = [...tareas, tareaObj];
                mostrarTareas();
            }
        } catch (error) {
            console.log(error);
        }
    }

    function obtenerProyecto(){
        const proyectoParams = new URLSearchParams(window.location.search);
        const proyecto = Object.fromEntries(proyectoParams.entries());
        return proyecto.id;
    }

    function limpiarTareas(){
        const listadoTareas = document.querySelector("#listado-tareas");

        while(listadoTareas.firstChild){
            listadoTareas.removeChild(listadoTareas.firstChild);
        }
    }
})(); //Hace que se ejecute la funcion inmediatamente