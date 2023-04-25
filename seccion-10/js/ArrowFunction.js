
/* Forma "normal"
const sumar = function(numero1, numero2){
    console.log(numero1+numero2);
}*/

//Arrow Function
const sumar = (numero1, numero2) =>{
    console.log(numero1+numero2);
}

sumar(7,8); 

//Las tres formas de usar arrow function
//Cuando solo es un parametro puede ir sin parentesis y cuando solo es una linea la funcion puede no llevar llaves
const aprendiendo = (tecnologia) => {
    console.log(`Aprendiendo la tecnologia ${tecnologia} `);
}
const aprendiendo2 = tecnologia => {
    console.log(`Aprendiendo la tecnologia ${tecnologia} `);
}
const aprendiendo3 = tecnologia => console.log(`Aprendiendo la tecnologia ${tecnologia} `);

aprendiendo3("JavaScript");


//Arrow functions que devuelven valores
//No necesita el return 

function sumaRetorno(valor1=0, valor2 =0){
    return valor1 + valor2;
}

const sumaRetorno2 = (valor1=0, valor2 =0) => valor1 + valor2;

