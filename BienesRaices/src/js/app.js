document.addEventListener("DOMContentLoaded", function(){
    eventListeners();
    darkMode();
});

function eventListeners(){
    const mobileMenu = document.querySelector(".mobile-menu");

    mobileMenu.addEventListener("click", navegacionResponsive);
}

function darkMode(){

    const darkMode = window.matchMedia("(prefers-color-scheme: dark)");

    systemDarkMode(darkMode);

    darkMode.addEventListener("change", systemDarkMode(darkMode));
    const botonDarkMode = document.querySelector(".boton-darkmode");
    botonDarkMode.addEventListener("click", cambiarModo);
}

function systemDarkMode(darkMode){
    if (darkMode.matches){
        document.body.classList.add("darkmode")
    } else {
        document.body.classList.remove("darkmode")
    }
}
function cambiarModo(){
    document.body.classList.toggle("dark-mode");
}

function navegacionResponsive(){
    const navegacion = document.querySelector(".navegacion");

    //Hace lo mismo que el if de abajp
    navegacion.classList.toggle("mostrar");
    /*
    if (navegacion.classList.contains("mostrar")){
        navegacion.classList.remove("nostrar"); 
    } else {
        navegacion.classList.ass("mostrar");
    }*/
}