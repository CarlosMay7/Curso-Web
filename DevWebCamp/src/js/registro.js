import Swal from "sweetalert2";
(function(){
    let eventos = [];
    const resumen = document.querySelector("#registro-resumen");

    if(resumen){
        const eventosBtn = document.querySelectorAll(".evento__agregar");
        eventosBtn.forEach( boton => boton.addEventListener("click", seleccionarEvento));
        
        const formularioRegistro = document.querySelector("#registro");
        formularioRegistro.addEventListener("submit", submitFormulario);

        mostrarEventos();

        function seleccionarEvento(e){

            if(eventos.length<5){
                //Deshabilitar el evento
                e.target.disabled = true;
                eventos = [...eventos, {
                    id : e.target.dataset.id,
                    titulo: e.target.parentElement.querySelector(".evento__nombre").textContent.trim()
                }];

                mostrarEventos();
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Máximo 5 eventos por registro",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }

        }

        function mostrarEventos(){
            //Limpiar HTML
            limpiarEventos();
            if(eventos.length > 0){
                eventos.forEach(evento => {
                    const eventoDOM = document.createElement("DIV");
                    eventoDOM.classList.add("registro__evento");

                    const titulo = document.createElement("H3");
                    titulo.classList.add("registro__nombre");
                    titulo.textContent = evento.titulo;

                    const botonEliminar = document.createElement("BUTTON");
                    botonEliminar.classList.add("registro__eliminar");
                    botonEliminar.innerHTML = '<i class="fa-solid fa-trash"></i>'

                    botonEliminar.onclick = function(){
                        eliminarEvento(evento.id);
                    };

                    //Renderizar en el HTML
                    eventoDOM.appendChild(titulo);
                    eventoDOM.appendChild(botonEliminar);
                    resumen.appendChild(eventoDOM);
                })
            } else {
                const noRegistro = document.createElement("P");
                noRegistro.textContent = "No hay eventos, elige hasta 5 del lado izquierdo";
                noRegistro.classList.add("registro__texto");
                resumen.appendChild(noRegistro);
            }
        }

        function eliminarEvento(id){
            eventos = eventos.filter( evento => evento.id !== id);
            const botonAgregar = document.querySelector(`[data-id="${id}"]`);
            botonAgregar.disabled = false;
            mostrarEventos();
        }
        
        function limpiarEventos(){
            while(resumen.firstChild){
                resumen.removeChild(resumen.firstChild);
            }
        }

        async function submitFormulario(e){
            e.preventDefault();

            //Obtener el regalo
            const regaloId = document.querySelector("#regalo").value;

            const eventosId = eventos.map(evento => evento.id);

            if(eventosId.length === 0 || regaloId === ""){
                Swal.fire({
                    title: "Error",
                    text: "Elige al menos un evento y un regalo",
                    icon: "error",
                    confirmButtonText: "OK"
                });
                return;
            }

            //Objeto de Form Data
            const datos = new FormData();
            datos.append("eventos", eventosId);
            datos.append("regalo", regaloId);

            const url = "/finalizar-registro/conferencias";

            const respuesta = await fetch(url, {
                method: "POST",
                body: datos
            });
            const resultado = await respuesta.json();

            if(resultado.resultado){
                Swal.fire(
                    "Registro Exitoso",
                    "Tus conferencias se han almacenado, te esperamos en DevWebCamp",
                    "success"
                ).then( () => location.href = `/boleto?id=${resultado.token}`);
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error",
                    icon: "error",
                    confirmButtonText: "OK"
                }).then(() => location.reload());
            }
        }
    }
})();