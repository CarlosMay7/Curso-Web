<?php
    $resultado = $_GET["resultado"] ?? null; //El ?? es como un placeholder, si no encuentra el valor de resultado con el get lo toma como null

    require "/includes/funciones.php";
    incluirTemplate("header");
?>

    <main class="contenedor seccion">
        <h2>Administrador Bienes Raices</h2>

        <?php if ($resultado == 1):?>
            <p class="alerta exito">Propiedad registrada correctamente</p>
        <?php endif?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    </main>

<?php
    incluirTemplate("footer");
?>