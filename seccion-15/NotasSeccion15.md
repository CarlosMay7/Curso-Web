# Utilidades

## Gulp automatiza tareas "aburridas"



## Crear scripts en .json

- Dentro del package.json ubicar el elemento scripts y agregar la tarea que se desea agregar
-- Ejemplo:  "sass": "sass --watch src/scss:build/css"
    Toma lo que está escrito en el archivo sass de la carpeta scss, lo compila segun vayan habiendo cambios y hace un archivo css en la carpeta build

## Instalar dependencias via npm

#### Forma "normal"
-   npm install nombreDependencia
#### Forma de desarrollador
-   npm install --save-dev nombreDependencia


## Ejecutar scripts con npx

#### npx permite ejecutar paquetes sin instalarlos globalmente

-   npx gulp nombreTareaOScript

    Esto se usa cuando se toma del gulp

## Ejecutar con npm

-   npm run nombreScriptEnJson

    Ejecuta la tarea especificada en el json...
    "tarea": "gulp tarea"
    Llamamos a npm run tarea y esto busca en el gulp la tarea llamada tarea

## Dependencia gulp-webp

-   npm install --save-dev gulp-webp


## Gulp

-   Cuenta con ejecucion de manera paralela (Se ejecutan varios procesos al mismo tiempo) "importando" parallel
-   Cuenta con ejecucion serial (Se ejecuta una después de otra) "importando serial

#### Plugins gulp

-   gulp-sass, se comunica con sass
-   gulp-plumber, permite no detener la ejecucion con los errores
-   gulp-imagemin, permite reducir el tamaño de las imagenes
-   gulp-cache, permite mantener elementos en cache
-   gulp-imagemin@7.1.0, modifica a formato webp las imagenes (Versión 7.1.0 porque la más actual no me funcionó)
-   gulp-avif, cambiar imagenes a formato avif
-   gulp-postcss, optimizar css
cssnano autoprefixer postcss 
## SASS

-   Para usar mixins y variables se tienen que exportar en todos los archivos que los necesiten

## Videos en HTML

-  Con la llegada de los dispositivos apple arruinaron a adobe flash y HTML5 tuvo que soportar videos nativamente

-  Hay que tener 3 formatos de video para aumentar el soporte de los mismos. Formatos .mp4, .ogg y .webm

## Plugins para mejorar performance css con postcss

-   postcss, hace las transformaciones usando las siguientes herramientas
-   cssnano, "comprime" el css
-   autoprefixer, se asegura que pueda utilizar el css en el navegador

#### Los sourcemaps crean código que ayuda al navegador a decirnos la dirección exacta de qué archivo está la parte que seleccionamos en la página

## Terser para mejorar código de JavaScript

-   npm install --save-dev gulp-terser-js