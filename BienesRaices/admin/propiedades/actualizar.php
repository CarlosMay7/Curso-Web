<?php
    require "../../includes/app.php";

    //Revisa el login
    autenticado();
    
    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    //Validar url con id
    $id = $_GET["id"];

    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location :/admin");
    }

    //Obtener datos propiedad
    $propiedad = Propiedad::find($id);

    //Obtener vendedores
    $vendedores = Vendedor::all();

    //Arreglo mensajes de error
    $errores = Propiedad::getErrores();

    //Ejecuta despues de que el usuario envia el formulario
    if($_SERVER["REQUEST_METHOD"]==="POST") {

        $args = $_POST["propiedad"]; //Toma el arreglo llamado propiedad que se lleno en el formulario con el name


        $propiedad->sincronizar($args);

        //Validar
        $errores = $propiedad->validar();
        
        //Subir archivos
        $nombreImagen = md5( uniqid( rand(), true)) . ".jpg"; //Generar nombres aleatorios dificiles de repetir

        if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
            $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"]) -> fit(800,600);
            //Asigna la imagen como atributo de la propiedad
            $propiedad->setImagen($nombreImagen);  
        }
    
        //Revisar que no haya errores
        if (empty($errores)){
            //Guardar imagen si existe
            if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }
            
            $propiedad -> guardar();
            
        }
    }

    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h2>Actualizar Propiedad</h2>

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
        aunque se puede crear uno nuevo solo para esta parte, también si no se coloca manda la info al mismo archivo-->
        <!--La parte de enctype es para que pueda aceptar archivos como imagenes-->
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php
                include "../../includes/templates/formulario_propiedades.php";
            ?>
            <input type="submit" value="Actualizar Popiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate("footer");
?>