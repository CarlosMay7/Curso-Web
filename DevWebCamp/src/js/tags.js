(function(){
    const tagsInput = document.querySelector("#tags_input");

    if(tagsInput){
        const tagsDiv = document.querySelector("#tags");
        const tagsInputHidden = document.querySelector('[name="tags"]');
        let tags = [];
        //Escuchar cambios en el input
        tagsInput.addEventListener("keypress", guardarTag);

        function guardarTag(e){
            if(e.keyCode === 44){

                if(e.target.value.trim() === "" || e.target.value < 1 ){
                    return;
                }
                e.preventDefault(); //Hace que no agregue la coma al prevenir la accion por default
                tags= [...tags, e.target.value.trim()];

                tagsInput.value = "";

                mostrarTags();
            }
        }

        function mostrarTags(){
            tagsDiv.textContent = "";

            tags.forEach(tag => {
                const etiqueta = document.createElement("LI");
                etiqueta.classList.add("formulario__tag");
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminartag;
                tagsDiv.appendChild(etiqueta);
            });

            actualizarInputHidden();
        }

        function eliminartag(e){
            e.target.remove();
            tags = tags.filter(tag => tag !== e.target.textContent);
            actualizarInputHidden();
        }

        function actualizarInputHidden(){
            tagsInputHidden.value = tags.toString();
        }
    }
})()
