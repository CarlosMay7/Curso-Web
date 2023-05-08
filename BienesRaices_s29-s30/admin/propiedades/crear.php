<?php
    //Base de datos
    require "../../includes/config/database.php";

    $db = conectarDB();


    //Arreglo mensajes de error
    $errores = [];

    //Ejecuta despues de que el usuario envia el formulario
    if($_SERVER["REQUEST_METHOD"]==="POST") {
        $titulo = $_POST["titulo"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];
        $habitaciones = $_POST["habitaciones"];
        $wc = $_POST["wc"];
        $estacionamiento = $_POST["estacionamiento"];
        $vendedores_id = $_POST["vendedores_id"];

        if(!$titulo){
            $errores[] = "Debe agregar un título";
        }
        if(!$precio){
            $errores[] = "Debe agregar un precio";
        }
        if(strlen($descripcion)<50){
            $errores[] = "Debe agregar una descripción de al menos 50 caracteres";
        }
        if(!$habitaciones){
            $errores[] = "Debe agregar la cantidad de habitaciones";
        }
        if(!$wc){
            $errores[] = "Debe agregar la cantidad de baños";
        }
        if(!$estacionamiento){
            $errores[] = "Debe agregar la cantidad de espacio de estacionamiento";
        }
        if(!$vendedores_id){
            $errores[] = "Debe seleccionar un vendedor";
        }

        //Revisar que no haya errores
        if (empty($errores)){
        
            //Insertar en base de datos

            $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedores_id) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedores_id');";
            $ok = mysqli_query($db, $query);

            if($ok){
                echo "Se insertó correctamente";
            } 
        }


    }


    
    require "../../includes/funciones.php";
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

        <!--El action es para decir a que ubicacion se van a mandar los datos, es bueno usar el mismo archivo,
        aunque se puede crear uno nuevo solo para esta parte-->
        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" placeholder="Propiedad">

                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" placeholder="Precio">

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png"> <!--El accept es para restringir el tipo de archivo a enviar-->

                <label for="descripcion">Descripcion</label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 7" min="1">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 7" min="1">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 7" min="0">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedores_id">
                    <option value="" disabled selected>Seleccione un vendedor</option>
                    <option value="1">Carlos</option>
                    <option value="2">Cristiano</option>
                </select>
            </fieldset>
            <input type="submit" value="Crear Popiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate("footer");
?>