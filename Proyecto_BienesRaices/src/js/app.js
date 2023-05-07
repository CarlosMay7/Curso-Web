document.addEventListener("DOMContentLoaded", function(){
    eventListeners();
});

function eventListeners(){
    const mobileMenu = document.querySelector(".mobile-menu");

    mobileMenu.addEventListener("click", navegacionResponsive);
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