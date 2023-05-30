<?php

    require "../../includes/app.php";

    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;

    $propiedad = new Propiedad;

    //Revisa el login
    autenticado();

    //Base de datos
    $db = conectarDB();

    $propiedad = new Propiedad;

    //Consultar base de datos
    $query = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $query);

    //Arreglo mensajes de error
    $errores = Propiedad::getErrores();


    //Ejecuta despues de que el usuario envia el formulario
    if($_SERVER["REQUEST_METHOD"]==="POST") {

        //Crea una instancia de la propiedad
        $propiedad = new Propiedad($_POST["propiedad"]);

        //Crear nombre unico de imagen
        $nombreImagen = md5( uniqid( rand(), true)) . ".jpg"; //Generar nombres aleatorios dificiles de repetir

        //Set imagen
        //Resize a la imagen con Intervention
        if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
            $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"]) -> fit(800,600);
            //Asigna la imagen como atributo de la propiedad
            $propiedad->setImagen($nombreImagen);  
        }

        $errores = $propiedad->validar();


        //Sanitizar entradas con mysqli
        //Es como tomar solo lo que necesitamos para evitar fallos o incidencias en la bd

        //filter_var(variable_limpiar, tipo_filtro);
        
        //Validar entradas, devuelve el valor si es valido, falso sino
        //filter_var(variable_validar, tipo_filtro);
    
        //Revisar que no haya errores
        if (empty($errores)){

            if(!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);
            }
            //Guardar la imagen
            $image->save(CARPETA_IMAGENES . $nombreImagen); //Se le ingresa el path a donde guardar la imagen

            //Guarda en bd
            $propiedad->guardar();

        }
    }

    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h2>Crear</h2>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php
            foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach ?>

        <!--SUPER GLOBALES-->

        <!--El server ($_SERVER) sirve para saber datos del servidor como request method, sistema operativo, puerto, entre otros, asi
        que puede ser usado para hacer validaciones con el request method, servidor, etc.-->

        <!--El post ($_POST) es para tomar los datos ingresados pero maneja los valores de manera interna en el archivo. Se usa para
        logins y acciones que necesiten mas seguridad-->

        <!--El get ($_GET) es para tomar los datos ingresados y "crea" variables que se nombran con el name en cada input. También 
        los datos se agregan a la URL asi que se puede usar cuando necesite la URL, se tenga que pasar de una pantalla a otra-->

        <!-- el filea ($_FILES) permite ver la informaion de los archivos-->

        <!--El action es para decir a que ubicacion se van a mandar los datos, es bueno usar el mismo archivo,
        aunque se puede crear uno nuevo solo para esta parte-->
        <!--La parte de enctype es para que pueda aceptar archivos como imagenes-->
        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <?php
                include "../../includes/templates/formulario_propiedades.php";
            ?>
            <input type="submit" value="Crear Popiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate("footer");
?>