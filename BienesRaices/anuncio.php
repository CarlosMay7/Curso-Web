<?php

    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("Location: /");
    }
    require "includes/funciones.php";
    incluirTemplate("header");

    //Importar conexion BD

    require "includes/config/database.php";

    $db = conectarDB();

    //Consultar
    $query = "SELECT * FROM propiedades WHERE id=$id";
    //Leer
    $resultado = mysqli_query($db, $query);
    if($resultado->num_rows === 0){ //Valida en el objeto que se ingrese un valor valido, si es asi da 1, de lo contrario es 0
        header("Location: /");
    }
    $propiedad = mysqli_fetch_assoc($resultado);
?>

    <main class="contenedor seccion contenido-centrado">
        <h2><?php echo $propiedad["titulo"]; ?></h2>

        <img loading="lazy" src="/imagenes/<?php echo $propiedad["imagen"]; ?>" alt="Imagen destacada">

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad["precio"]; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="figura" loading="lazy" src="/build/img/icono_wc.svg" alt="WC">
                    <p><?php echo $propiedad["wc"]; ?></p>
                </li>
                <li>
                    <img class="figura" loading="lazy" src="/build/img/icono_estacionamiento.svg" alt="Estacionamiento">
                    <p><?php echo $propiedad["estacionamiento"]; ?></p>
                </li>
                <li>
                    <img class="figura" loading="lazy" src="/build/img/icono_dormitorio.svg" alt="Recamaras">
                    <p><?php echo $propiedad["habitaciones"]; ?></p>
                </li>
            </ul>
            <p><?php echo $propiedad["descripcion"]; ?></p>
        </div>
    </main>

<?php

    //Cerrar db
    mysqli_close($db);
    incluirTemplate("footer");
?>