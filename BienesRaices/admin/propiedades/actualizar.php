<?php
    require "../../includes/funciones.php";

    $auth = autenticado();
    if(!$auth){
        header ("Location: /");
    }

    //Validar url con id
    $id = $_GET["id"];

    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location :/admin");
    }
    //Base de datos
    require "../../includes/config/database.php";

    $db = conectarDB();

    //Obtener datos propiedad
    $queryPropiedades = "SELECT * FROM propiedades where id=$id";
    $resultadoPropiedades = mysqli_query($db, $queryPropiedades);

    $propiedad = mysqli_fetch_assoc($resultadoPropiedades);

    //Consultar base de datos
    $query = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $query);

    //Arreglo mensajes de error
    $errores = [];

    $titulo = $propiedad["titulo"];
    $precio = $propiedad["precio"];
    $descripcion = $propiedad["descripcion"];
    $habitaciones = $propiedad["habitaciones"];
    $wc = $propiedad["wc"];
    $estacionamiento = $propiedad["estacionamiento"];
    $vendedores_id = $propiedad["vendedores_id"];
    $imagenPropiedad = $propiedad["imagen"];



    //Ejecuta despues de que el usuario envia el formulario
    if($_SERVER["REQUEST_METHOD"]==="POST") {

        //Sanitizar entradas
        //Es como tomar solo lo que necesitamos para evitar fallos o incidencias en la bd

        //filter_var(variable_limpiar, tipo_filtro);
        
        //Validar entradas, devuelve el valor si es valido, falso sino
        //filter_var(variable_validar, tipo_filtro);


        //Validan que sean los tipos de datos solicitados
        $titulo =  mysqli_real_escape_string($db,$_POST["titulo"]);
        $precio = mysqli_real_escape_string($db,$_POST["precio"]);
        $descripcion = mysqli_real_escape_string($db,$_POST["descripcion"]);
        $habitaciones = mysqli_real_escape_string($db,$_POST["habitaciones"]);
        $wc = mysqli_real_escape_string($db,$_POST["wc"]);
        $estacionamiento = mysqli_real_escape_string($db,$_POST["estacionamiento"]);
        $vendedores_id = mysqli_real_escape_string($db,$_POST["vendedores_id"]);
        $creacion = date("Y/m/d");

        //Asignar variable a una imagen
        $imagen = $_FILES["imagen"];

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

        //Validar tamaño de la imagen (1mb)

        $medida = 1000 * 1000;
        
        if ($imagen["size"] > $medida ){
            $errores[] = "la imagen es muy pesada";
        }
    
        //Revisar que no haya errores
        if (empty($errores)){
            
            //Subir archivos
            //Crear carpeta
            $carpetaImagenes = "../../imagenes/";
            if(!is_dir($carpetaImagenes)) {
                echo mkdir($carpetaImagenes);
            }

            $nombreImagen ="";

            //Revisar si hay una imagen previa y si es asi, eliminarla 
            if ($imagen ["name"]){
                unlink($carpetaImagenes . $propiedad["imagen"]);

                //Crear nombre unico de imagen

                $nombreImagen = md5( uniqid( rand(), true)) . ".jpg"; //Generar nombres aleatorios dificiles de repetir

                //Subir imagen
                move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . "/" . $nombreImagen);
            } else {
                $nombreImagen = $propiedad["imagen"];
            }



            
            //Insertar en base de datos
            $query = "UPDATE propiedades SET titulo = '$titulo', precio = $precio, imagen = '$nombreImagen' , descripcion = '$descripcion', habitaciones = $habitaciones, wc = $wc, estacionamiento = $estacionamiento, vendedores_id = $vendedores_id WHERE id= $id";
            
            $ok = mysqli_query($db, $query);

            if($ok){
                //Redireccionar al usuario para que no sigan insertanto la misma propiedad
                header("location: /admin?resultado=2 & ok = ok"); //Lleva al usuario a la direccion colocada, además que se tiene el query string donde se crean variables y se asignan valores que pueden ser leidos de la url
            } 
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
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" placeholder="Propiedad" value="<?php echo $titulo; ?>"> <!--El value es para que se guarde el valor una vez se ingrese aunque hayan fallos o no se ingresen los demas inputs-->

                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" placeholder="Precio" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen" > <!--El accept es para restringir el tipo de archivo a enviar-->

                <img class="imagen-peque" src="/imagenes/<?php echo $propiedad["imagen"]; ?>">
                <label for="descripcion">Descripcion</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 7" min="1" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 7" min="1" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 7" min="1" value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedores_id">
                    <option value="" disabled selected>Seleccione un vendedor</option>
                    <?php //Agregando vendedores desde la bd
                    while ($vendedor = mysqli_fetch_assoc($resultado)): ?>
                    
                    <!--Itera sobre la base de datos y revisa que si el atributo seleccionado es igual al que está en la base de datos y si es asi lo conserva
                    y agrega el atributo de selected en html-->
                    <option <?php echo $vendedores_id === $vendedor["id"] ? "selected" : ""; ?> value="<?php echo $vendedor["id"]; ?>"><?php echo $vendedor["nombre"] . " " . $vendedor["apellido"]; ?></option>

                    <?php endwhile ?>
                </select>
            </fieldset>
            <input type="submit" value="Actualizar Popiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate("footer");
?>