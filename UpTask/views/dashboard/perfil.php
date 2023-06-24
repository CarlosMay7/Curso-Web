<?php include_once __DIR__ . "/header-dashboard.php"; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

    <a href="/cambiar-password" class="enlace">Cambiar Password</a>

    <form class="formulario" method="POST" action="/perfil">
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input 
                type="text" 
                name="nombre" 
                placeholder="Tu Nombre"
                value="<?php echo $usuario->nombre; ?>"
            >
        </div>

        <div class="campo">
            <label for="email">E-mail</label>
            <input 
                type="text" 
                name="email" 
                placeholder="Tu E-mail"
                value="<?php echo $usuario->email; ?>"
            >
        </div>

        <input type="submit" value="Guardar Cambios">
    </form>
</div>

<?php include_once __DIR__ . "/footer-dashboard.php"; ?>
