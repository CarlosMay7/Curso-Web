const btnMobileMenu = document.querySelector("#mobile-menu");
const btnCerrarMenu = document.querySelector("#cerrar-menu")
const sidebar = document.querySelector(".sidebar");
if(btnMobileMenu){
    btnMobileMenu.addEventListener("click", function(){
        sidebar.classList.add("mostrar");
    });
}

if((btnCerrarMenu)){
    btnCerrarMenu.addEventListener("click", function(){
        sidebar.classList.add("ocultar");

        setTimeout(() => {
            sidebar.classList.remove("mostrar");
            sidebar.classList.remove("ocultar");
        }, 500);
    })
}

//Elimina la clase de mostrar a partir del tamaño tablet
window.addEventListener("resize", function(){
    const anchoPantalla = document.body.clientWidth; //Saber el ancho de la pantalla
    if(anchoPantalla>=768){
        sidebar.classList.remove("mostrar");
    }
})