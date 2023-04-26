//QuerrySelector

//Es recomendable usar id JS y no para dar estilos en css
const heading = document.querySelector(".header__texto h2" /*Sintaxis de clases en css o usar id #heading por ejemplo*/); //Retorna 0 o 1 elemento, el primero
heading.textContent ="Se puede cambiar el contenido con JS" //Y muchas cosas mas
console.log(heading);

//QuerrySelectorAll
const enlaces =document.querySelectorAll(".navegacion a"); //Mismas caracteristicas que querry selector, solo que este devuelve todas las coincidencias
console.log(enlaces);

//Se genera un arreglo asi que puede ser tratado como tal
enlaces[0].textContent ="Cambie el enlace jiji";

//En lugar de crear una variable se puede manipular directo
document.querySelectorAll(".navegacion a")[1].textContent = "Otra forma";

//Se puede cambiar la referencia de enlace a donde lleva el enlace
enlaces[0].href="google.com";
//Tambien crear o eliminar clases
enlaces[0].classList.add("clase-nueva"); //Como se le dice que va a ser una clase ya no necesita la sintaxis de clase de css
enlaces[0].classList.remove("navegacion__enlace"); 



//GetElemenByID

//Tiene las mismas opciones que los otros querryselectors
 const heading2 = document.getElementById("heading");
 console.log(heading);