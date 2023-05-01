document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    navFija();
    crearGaleria();
    scrollNav();
}

function navFija (){
    const header = document.querySelector('.header');
    const sobreFestival = document.querySelector('.sobre-festival');
    const body = document.querySelector('body');

    window.addEventListener('scroll', function(){
        const topSobreFestival = sobreFestival.getBoundingClientRect(); //Saber caracteristicas de los elementos segun esten en la pantalla

        if (topSobreFestival.bottom<0){ //Top es cuando toque la parte de arriba de la ventana, bottom con el final
            header.classList.add('fijo');
            body.classList.add('body-scroll');
        } else {
            header.classList.remove('fijo');
            body.classList.remove('body-scroll');
        }
    });

}

function scrollNav(){
    const enlaces = document.querySelectorAll('.navegacion-principal a');
    enlaces.forEach(enlace => {
        enlace.addEventListener('click', function(evento){
            evento.preventDefault();

            const seccionScroll = evento.target.attributes.href.value;
            const seccion = document.querySelector(seccionScroll);
            seccion.scrollIntoView({ behavior: "smooth"});
        });
    });
}

function crearGaleria(){
    const galeria = document.querySelector('.galeria-imagenes');

    for(let i =1; i<=12; i++){
        const imagen = document.createElement('picture');

        //InnerHTML hace que todo el contenido dentro de las comillas se agregue entre las etiquetas
        imagen.innerHTML =`
        <source srcset="build/img/thumb/${i}.avif" type="image/avif">
        <source srcset="build/img/thumb/${i}.webp" type="image/webp">
        <img loading="lazy" width="200" height="300" src="build/img/thumb/${i}.jpg" alt="Imagen galeria">
        `;

        imagen.onclick = function(){ //Sele asigna un evento y su accion
            mostrarImagen(i); //Como hacer un callbak
        }

        galeria.appendChild(imagen);

        console.log(imagen);
    }
}

function mostrarImagen(id){
    const imagen = document.createElement('picture');

    //InnerHTML hace que todo el contenido dentro de las comillas se agregue entre las etiquetas
    imagen.innerHTML =`
    <source srcset="build/img/grande/${id}.avif" type="image/avif">
    <source srcset="build/img/grande/${id}.webp" type="image/webp">
    <img loading="lazy" width="200" height="300" src="build/img/grande/${id}.jpg" alt="Imagen galeria">
    `;

    //Crea el overlay con imagen
    const overlay = document.createElement('DIV');
    overlay.appendChild(imagen);
    overlay.classList.add('overlay');
    overlay.onclick = function(){
        const body = document.querySelector('body');
        body.classList.remove('no-scroll');
        overlay.remove();
    }

    //Boton para cerrar ventana modal
    const cerrar = document.createElement('P');
    cerrar .textContent= 'X';
    cerrar.classList.add('boton-cerrar');
    cerrar.onclick= function(){
        const body = document.querySelector('body'); 
        body.classList.remove('no-scroll'); //Aqui se elimina la clase de no-scroll para que se pueda hacer scroll otra vez
        overlay.remove();
    };

    overlay.appendChild(cerrar);
    
    //Añade al HTML
    const body = document.querySelector('body');
    body.appendChild(overlay);
    body.classList.add('no-scroll');

}