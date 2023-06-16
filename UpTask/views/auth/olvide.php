<div class="contenedor olvide">

<?php include_once __DIR__ . "/../templates/nombre-sitio.php" ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recupera tu password</p>

        <form class="formulario" method="POST" action="/olvide">
            <div class="campo">
                <label for="email">E-mail</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email"
                    placeholder="Tu E-mail"
                    >
            </div>

            <input type="submit" class="boton" value="Enviar Instrucciones">
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
            <a href="/crear">¿Aún no tienes cuenta? Crea una ahora</a>
        </div>
    </div> <!--Contenedor sm-->
</div>
