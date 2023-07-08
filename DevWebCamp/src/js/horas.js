(function(){
    const horas = document.querySelector("#horas");

    if(horas){
        const categoria = document.querySelector('[name="categoria_id"]');
        const dias = document.querySelectorAll('[name="dia"]');
        const inputHiddenDia = document.querySelector('[name="dia_id"]');
        const inputHiddenHora = document.querySelector('[name="hora_id"]');
        categoria.addEventListener("change", terminoBusqueda);
        dias.forEach( dia => dia.addEventListener("change", terminoBusqueda));

        let busqueda = {
            categoria_id : +categoria.value ?? "",
            dia : +inputHiddenDia.value ?? ""
        }

        if(!Object.values(busqueda).includes("")){

            (async () => {
                await buscarEventos(); 
                const id = inputHiddenHora.value;

                //Resaltar la hora actual
                const horaSeleccionada = document.querySelector(`[data-hora-id="${id}"]`);
                horaSeleccionada.classList.remove("horas__hora--deshabilitada"); 
                horaSeleccionada.classList.add("horas__hora--seleccionada");
                
                horaSeleccionada.onclick = seleccionarHora;
            })();

        }

        function terminoBusqueda(e){
            busqueda[e.target.name] = e.target.value; 

            //Reiniciar los campos ocultos y las horas
            inputHiddenHora.value = "";
            inputHiddenDia.value = "";

            const horaPrevia = document.querySelector(".horas__hora--seleccionada");
            if(horaPrevia){
                horaPrevia.classList.remove("horas__hora--seleccionada")
            }

            if(Object.values(busqueda).includes("")){
                return;
            }
            buscarEventos();
        }

        async function buscarEventos(){
            const {dia, categoria_id} = busqueda;
            const url = `/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`;

            resultado = await fetch(url);
            eventos = await resultado.json();

            obtenerHorasDisponibles(eventos);
        }

        function obtenerHorasDisponibles(eventos){
            //Reiniciar las horas
            const listadoHoras = document.querySelectorAll("#horas li");
            listadoHoras.forEach( li => li.classList.add("horas__hora--deshabilitada"));

            //Obtener eventos disponibles y habilitar horas disponibles
            const horasTomadas = eventos.map(evento => evento.hora_id);
            const listadoHorasArray = Array.from(listadoHoras);

            const resultado = listadoHorasArray.filter( hora => !horasTomadas.includes(hora.dataset.horaId));
            resultado.forEach( hora => hora.classList.remove("horas__hora--deshabilitada"));

            const horasDisponibles = document.querySelectorAll("#horas li:not(.horas__hora--deshabilitada)");
            horasDisponibles.forEach(hora => hora.addEventListener("click", seleccionarHora));

        }

        function seleccionarHora(e){
            //Deshabilita la hora previa si hay otro click
            const horaPrevia = document.querySelector(".horas__hora--seleccionada");
            if(horaPrevia){
                horaPrevia.classList.remove("horas__hora--seleccionada")
            }
            //Agregar clase de seleccionado
            e.target.classList.add("horas__hora--seleccionada");
            inputHiddenHora.value = e.target.dataset.horaId;

            //Llenar campo oculto de dia
            inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;
        }
    }
})();