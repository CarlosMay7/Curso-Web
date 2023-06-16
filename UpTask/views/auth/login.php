<div class="contenedor login">

<?php include_once __DIR__ . "/../templates/nombre-sitio.php" ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar Sesión</p>

        <form class="formulario" method="POST" action="/">
            <div class="campo">
                <label for="email">E-mail</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email"
                    placeholder="Tu E-mail"
                    >
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password"
                    placeholder="Tu Password"
                    >
            </div>

            <input type="submit" class="boton" value="Iniciar Sesión">
        </form>

        <div class="acciones">
            <a href="/crear">¿Aún no tienes cuenta? Crea una ahora</a>
            <a href="/olvide">¿Olvidaste tu password?</a>
        </div>
    </div> <!--Contenedor sm-->
</div>
