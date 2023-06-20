<div class="contenedor reestablecer">

<?php include_once __DIR__ . "/../templates/nombre-sitio.php" ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Coloca tu nuevo password</p>

        <?php include_once __DIR__ . "/../templates/alertas.php" ?>

        <?php if($mostrar) { ?>
        <form class="formulario" method="POST">
            <div class="campo">
                <label for="password">Nuevo Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password"
                    placeholder="Tu Nuevo Password"
                    >
            </div>

            <input type="submit" class="boton" value="Guardar Password">
        </form>

        <?php } ?>

        <div class="acciones">
            <a href="/crear">¿Aún no tienes cuenta? Crea una ahora</a>
            <a href="/olvide">¿Olvidaste tu password?</a>
        </div>
    </div> <!--Contenedor sm-->
</div>
