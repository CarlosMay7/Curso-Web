<div class="contenedor crear">

<?php include_once __DIR__ . "/../templates/nombre-sitio.php" ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu cuenta en UpTask</p>

        <?php include_once __DIR__ . "/../templates/alertas.php" ?>

        <form class="formulario" method="POST" action="/crear">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input 
                    type="nombre" 
                    name="nombre" 
                    id="nombre"
                    placeholder="Tu Nombre"
                    value ="<?php echo $usuario->nombre; ?>"
                    >
            </div>
            <div class="campo">
                <label for="email">E-mail</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email"
                    placeholder="Tu E-mail"
                    value ="<?php echo $usuario->email; ?>"
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
            <div class="campo">
                <label for="password2">Repetir Password</label>
                <input 
                    type="password" 
                    name="password2" 
                    id="password2"
                    placeholder="Repite Password"
                    >
            </div>

            <input type="submit" class="boton" value="Crear Cuenta">
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes cuenta? Inicia Sesión</a>
            <a href="/olvide">¿Olvidaste tu cuenta?</a>
        </div>
    </div> <!--Contenedor sm-->
</div>
