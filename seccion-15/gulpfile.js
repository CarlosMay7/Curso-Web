const {src, dest, watch} = require("gulp");
const sass  = require("gulp-sass")(require("sass"));
const plumber = require("gulp-plumber");

function css( callback ){
    //Identificar o ubicar el archivo de sass
    //Compilar el archivo
    //Almacenar en disco duro

    //Los pipes es como hacer que espere a que termine la funcion que esta junto a este para poder ejeutar la syua
    //Puede haber uno o mas


    //src("src/scss/app.scss").pipe( sass()) Ubica la hoja
    src("src/scss/**/*.scss") //Ubica todos los archivos .scss que esten dentro de scss de manera recursiva
        .pipe(plumber()) //Esto hace que al tener errores no se detenga el trabajo al estar utilizando watch
        .pipe(sass()) //Compila la hoja utilizando el script
        .pipe(dest("build/css")); //Dice donde guardar el resultado 

    callback();

}

function dev ( done) {
    //En este caso esta viendo los cambios en el archivo y cada vez que hay uno compila la pagina
    //watch ("src/scss/app.scss",css); Esto hace que cuando cambie el archivo al que se hace referencia se ejecute la funcion de la derecha
    watch("src/scss/**/*.scss", css); //Hace que este alerta de los cambios en todos los archivos .scss en la carpeta scss
    done();
}

exports.css = css;
exports.dev = dev;
