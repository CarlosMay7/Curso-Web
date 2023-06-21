(function(){ //IIFE Immediately invoked function expression. Forma para proteger variables de la lectura en otros archivos
    //Boton para agregar modal agregar tarea
    const btnNuevaTarea = document.querySelector("#agregar-tarea");

    btnNuevaTarea.addEventListener("click", mostrarFormulario);

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
        const host = "uptask.cm"; //Dejo esta variable en lo que busco como usar variables de entorno en JJS
        //Construir la peticion
        const datos = new FormData();
        datos.append("nombre", tarea);
        datos.append("proyectoid", obtenerProyecto());

        try {
            const url = "http://"+ host +"/api/tarea";
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
})(); //Hace que se ejecute la funcion inmediatamente