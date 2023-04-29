# Comandos utiles

## Crear scripts en .json

- Dentro del package.json ubicar el elemento scripts y agregar la tarea que se desea agregar
-- Ejemplo:  "sass": "sass --watch src/scss:build/css"
    Toma lo que está escrito en el archivo sass de la carpeta scss, lo compila segun vayan habiendo cambios y hace un archivo css en la carpeta build


## Ejecutar scripts con npx

-   npx gulp nombreTareaOScript

    Esto se usa cuando se toma del gulp

## Ejecutar con npm

-   npm run nombreScriptEnJson

    Ejecuta la tarea especificada en el json...
    "tarea": "gulp tarea"
    Llamamos a npm run tarea y esto busca en el gulp la tarea llamada tarea

