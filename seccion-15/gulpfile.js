const {src, dest, watch, parallel} = require("gulp");

//Dependencias CSS
const sass  = require("gulp-sass")(require("sass"));
const plumber = require("gulp-plumber");
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');

//Dependencias imagenes
const cache = require('gulp-cache');
const webp = require('gulp-webp');
const imagemin = require('gulp-imagemin');
const avif = require('gulp-avif');

//Dependencias JavaScript
const terser = require("gulp-terser-js");

function css( callback ){
    //Identificar o ubicar el archivo de sass
    //Compilar el archivo
    //Almacenar en disco duro

    //Los pipes es como hacer que espere a que termine la funcion que esta junto a este para poder ejeutar la syua
    //Puede haber uno o mas


    //src("src/scss/app.scss").pipe( sass()) Ubica la hoja
    src("src/scss/**/*.scss") //Ubica todos los archivos .scss que esten dentro de scss de manera recursiva
        .pipe(sourcemaps.init()) //Inicializa los sourcemaps guardando las referencias
        .pipe(plumber()) //Esto hace que al tener errores no se detenga el trabajo al estar utilizando watch
        .pipe(sass()) //Compila la hoja utilizando el script
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(sourcemaps.write('.')) //Toma como parametro del write la Ubicacion donde se guarda, el . es para que sea la misma hoja de estilos
        .pipe(dest("build/css")); //Dice donde guardar el resultado 

    callback(); //Callback de finalizacion de la tarea, forma anterior de codigo asincrono

}

function imagenes( done ){

    const opciones = {
        optimizationLevel : 3 //Aligera las imagenes
    }

    src('src/img/**/*.{jpg,png}')
    .pipe(cache(imagemin(opciones)))
    .pipe(dest("build/img"));

    done();
}

function versionWebp(done){

    const opciones = {
        quality:50, 
    };

    src('src/img/**/*.{jpg,png}'). //Cuando se busca en mas de un formato se puede colocar en llaves
        pipe(webp(opciones)).
        pipe(dest('build/img'));

        done();
}

function versionAvif(done){

    const opciones = {
        quality:50, 
    };

    src('src/img/**/*.{jpg,png}'). //Cuando se busca en mas de un formato se puede colocar en llaves
        pipe(avif(opciones)).
        pipe(dest('build/img'));

        done();
}

function javaScript(done){
    src("src/js/**/*.js")
        .pipe(sourcemaps.init()) //Crear sourcemaps para guiarnos un poco mejor
        .pipe(terser()) //Mejora el codigo
        .pipe(sourcemaps.write('.'))
        .pipe(dest("build/js"));

    done();
}

function dev ( done) {
    //En este caso esta viendo los cambios en el archivo y cada vez que hay uno compila la pagina
    //watch ("src/scss/app.scss",css); Esto hace que cuando cambie el archivo al que se hace referencia se ejecute la funcion de la derecha
    watch("src/scss/**/*.scss", css); //Hace que este alerta de los cambios en todos los archivos .scss en la carpeta scss
    watch("src/js/**/*.js", javaScript);
    done();
}

exports.css = css;
exports.imagenes = imagenes;
exports.versionWebp = versionWebp;
exports.versionAvif = versionAvif;
exports.javaScript = javaScript;
exports.dev = parallel(imagenes, versionAvif, versionWebp,javaScript, dev); //Parallel ejecuta las tareas al mismo tiempo
