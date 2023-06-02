<main class="contenedor seccion">
        <h2>Agregar Vendedor</h2>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php
            foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach ?>

        <form class="formulario" method="POST" action="/vendedores/crear">
            <?php
                include "formulario.php";
            ?>
            <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
        </form>
</main>