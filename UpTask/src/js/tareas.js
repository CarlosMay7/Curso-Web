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
        });

        document.querySelector("body").appendChild(modal);

    }
})(); //Hace que se ejecute la funcion inmediatamente